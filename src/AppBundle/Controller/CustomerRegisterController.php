<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType ;
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
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('password', PasswordType::class ,array('label' => 'Mot de passe','required' => true,'attr' => array('class'=>'form-control')))
            ->add('connect', SubmitType::class, array('label' => 'Se Connecter','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();
        $register = $this->createFormBuilder()
            ->add('nom', TextType::class,array('label' => 'Nom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('prenom', TextType::class,array('label' => 'Prénom','required' => true,'attr' => array('class'=>'form-control')))
            ->add('login', TextType::class,array('label' => 'Choose a login','required' => true,'attr' => array('class'=>'form-control')))
            ->add('dateNaissance', BirthdayType::class,array('label' => 'Date de naissance','required' => true))
            ->add('password', PasswordType::class,array('label' => 'Mot de passe','required' => true,'attr' => array('class'=>'form-control')))
            ->add('password2', PasswordType::class,array('label' => 'Retapez votre mot de passe','required' => true,'attr' => array('class'=>'form-control')))
            ->add('email', EmailType::class ,array('label' => 'Email','required' => true,'attr' => array('class'=>'form-control')))
            ->add('regist', SubmitType::class, array('label' => 'S\'enregistrer','attr' => array('class'=>'btn btn-template-main')))
            ->getForm();

        $form->handleRequest($request);
        $register->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userToLog = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneByEmail($form->getData()->getEmail());
            if($userToLog){
                //ENCODE DES PASSWORD
    //            if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    //                $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
    //                $code = crypt($form->getData()->getPassword(), $salt);
    //            }
                if(crypt($form->getData()->getPassword(), $userToLog->getPassword()) == $userToLog->getPassword()){
                    //route a definir
                    $session = new Session();
                    $session->start();
                    $session->set('user',$userToLog);
                    return $this->redirectToRoute('contact');
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
        ));
    }

}
