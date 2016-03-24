<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType ;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication;

class CustomerRegisterController extends Controller
{
    /**
     * @Route("/customer-register",name="customer-register")
     */
    public function CustomerRegisterAction(Request $request)
    {
        $userConnect = $request->getSession()->get('user');
        $bdd = $this->getDoctrine();
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('password', PasswordType::class ,array('label' => 'Mot de passe','required' => true,'attr' => array('class'=>'form-control')))
            ->add('connect', SubmitType::class, array('label' => 'Se Connecter','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();
        $register = $this->createFormBuilder($user)
            ->add('nom', TextType::class,array('label' => 'Nom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('prenom', TextType::class,array('label' => 'Prénom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('login', TextType::class,array('label' => 'Choose a login','required' => true,'attr' => array('class'=>'form-control')))
            ->add('dateNaissance', BirthdayType::class,array('label' => 'Date de naissance','required' => true,'years'=>range(1900,1998),'format' => 'ddMMyyyy'))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux champs doivent correspondre.',
                'options' => array('attr' => array('class' => 'form-control')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repetez le  Password'),
            ))
            ->add('email', EmailType::class ,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('charte', CheckboxType::class ,array('label' => 'J\'ai lu et j\'accepte les conditions de la charte de bonne conduite.','required' => true,'attr' => array('class'=>'checkbox-inline')))
            ->add('regist', SubmitType::class, array('label' => 'S\'enregistrer','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();

        $form->handleRequest($request);
        $register->handleRequest($request);
        if ($register->isSubmitted() && $register->isValid()) {
            if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
                $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
                $user->setPassword(crypt($register->getData()->getPassword(), $salt));
            }
            $role = $bdd
                ->getRepository('AppBundle:Role')
                ->findOneById(2);
            $user->setRole($role);
            $em =$bdd->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash(
                'success',
                'Votre inscription a bien été prise en compte.'
            );
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $userToLog = $bdd
                ->getRepository('AppBundle:User')
                ->findOneByEmail($form->getData()->getEmail());
            if($userToLog){
                if(crypt($form->getData()->getPassword(), $userToLog->getPassword()) == $userToLog->getPassword()) {
                    //route a definir
                    $session = new Session();
                    $session->clear();
                    $session->start();
                    $session->set('user', $userToLog);
//                    var_dump($userToLog->getRoles()->getId());
                    if($userToLog->getRoles()->getId()==1){
                        return $this->redirectToRoute('dashboard');
                    }else{
                        return $this->redirectToRoute('homepage');
                    }
                }else{
                    $form->get('password')->addError(new FormError('Le mot de passe est incorrect.'));
                }
            }else{
                $form->get('email')->addError(new FormError('Email inconnu'));
            }

        }
//
        return $this->render('@App/front/customer-register.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'connexion',
            'form' => $form->createView(),
            'register' => $register->createView(),
            'user' =>$userConnect,
        ));
    }
    /**
     * @Route("/logout",name="logout")
     */
    public function LogOut(Request $request)
    {
        $request->getSession()->clear();
        $userConnect = $request->getSession()->get('user');
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('customer-register'))
            ->add('email', EmailType::class,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('password', PasswordType::class ,array('label' => 'Mot de passe','required' => true,'attr' => array('class'=>'form-control')))
            ->add('connect', SubmitType::class, array('label' => 'Se Connecter','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();
        $register = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('customer-register'))
            ->add('nom', TextType::class,array('label' => 'Nom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('prenom', TextType::class,array('label' => 'Prénom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('login', TextType::class,array('label' => 'Choose a login','required' => true,'attr' => array('class'=>'form-control')))
            ->add('dateNaissance', BirthdayType::class,array('label' => 'Date de naissance','required' => true,'years'=>range(1900,1998),'format' => 'ddMMyyyy'))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux champs doivent correspondre.',
                'options' => array('attr' => array('class' => 'form-control')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repetez le  Password'),
            ))
            ->add('email', EmailType::class ,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('charte', CheckboxType::class ,array('label' => 'J\'ai lu et j\'accepte les conditions de la charte de bonne conduite.','required' => true,'attr' => array('class'=>'checkbox-inline')))
            ->add('regist', SubmitType::class, array('label' => 'S\'enregistrer','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();
        return $this->render('@App/front/customer-register.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'connexion',
            'form' => $form->createView(),
            'register' => $register->createView(),
            'user' =>$userConnect,
        ));
    }

}
