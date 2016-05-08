<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\AccountType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/account",name="account")
     */
    public function indexAction(Request $request)
    {

        $user = $request->getSession()->get('user');
        $form = $this->createForm(AccountType::class,$user);

        if($form->handleRequest($request)->isValid()){
            $update = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($update);
//            $em->flush();
            $user =$update;
        }
        return $this->render('@App/front/account.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'nav_active' => 'connexion',
            'form' => $form->createView(),
//            'register' => $register->createView(),
            'user' =>$user,
        ));
    }
}
