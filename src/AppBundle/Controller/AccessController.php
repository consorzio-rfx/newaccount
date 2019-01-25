<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccessController extends Controller
{
   /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {

        $authenticationUtils = $this->get('security.authentication_utils');

    	// get the login error if there is one
    	$error = $authenticationUtils->getLastAuthenticationError();

    	// last username entered by the user
    	$lastUsername = $authenticationUtils->getLastUsername();

//  	$this->get('applog')->info('loginAction: IN - lastUsername: "' . $lastUsername . '"');	

//	$securityContext = $this->container->get('security.authorization_checker');
//	if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//	    exit;
//	}

    	return $this->render('default/login.html.twig', array(
           'last_username' => $lastUsername,
           'error'         => $error,
       ));
    }


   /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request) {
        return $this->redirect($this->generateUrl('homepage'));
    }
}