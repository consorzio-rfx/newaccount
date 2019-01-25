<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\AccountRequest;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
	$ar = new AccountRequest();
	$ar->setGroupHead($this->getUser()->getUsername());
	$ar->setRequestDate(new \DateTime(date('Y-m-d H:i:s')));

	$form = $this->createFormBuilder($ar)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('isRenew', ChoiceType::class, array(
	    			 'expanded' => true,
	    			 'multiple' => false,
    	    			 'choices'  => array(
        			 	    'Yes' => false,  // label says "IS NEW", so invert
        			 	    'No' => true,
					    ),
			         'data' => false,
					   ))
            ->add('contactPerson', TextType::class)
            ->add('arrivalDate', DateType::class, array('data' => new \DateTime()))
            ->add('departureDate', DateType::class, array('data' => new \DateTime()))

            ->add('userProfile', ChoiceType::class, array(
    	    			 'choices'  => array(
        			 	    'CNR' => 'CNR',
					    'UNIPD' => 'UNIPD',
					    'Consorzio RFX' => 'RFX',
        				    'ENEA' => 'ENEA',
					    'Dottorando' => 'DOTTORANDO',
					    'Tesista' => 'TESISTA',
					    'Ospite' => 'OSPITE',
        				    'Consulente' => 'CONSULENTE',
        			 	    'Borsista' => 'BORSISTA',
        			 	    'Perfezionando' => 'PERFEZIONANDO',
        			 	    'ALTRO' => 'ALTRO',
					    ),
					   ))
            ->add('mainGroup', ChoiceType::class, array(
    	    			 'choices'  => array(
        			 	    'AI' => 'AI',
        			 	    'FA' => 'FA',
        			 	    'FB' => 'FB',
        			 	    'FC' => 'FC',
        			 	    'FD' => 'FD',
        			 	    'FT' => 'FT',
        			 	    'IP' => 'IP',
        			 	    'SE' => 'SE',
        			 	    'IE' => 'IE',
        			 	    'Servizio IT' => 'SC',
        			 	    'Officina Elettrica' => 'OElettrica',
        			 	    'Officina Elettronica' => 'OElettronica',
        			 	    'Officina Meccanica' => 'OMeccanica',
        			 	    'SX-Alimentazioni' => 'SXA',
        			 	    'SX-Controlli' => 'SXC',
        			 	    'SX-Diagnostiche' => 'SXD',
        			 	    'SX-Macchina' => 'SXM',
        			 	    'Ufficio Acquisti' => 'UAcquisti',
        			 	    'Ufficio Manutenzione' => 'UManutenzione',
        			 	    'Ufficio Tecnico' => 'UTecnico',
        			 	    'Ospiti' => 'Ospiti',
        			 	    'Altro' => 'Altro',
					    ),
					   ))

            ->add('systemsToEnable', ChoiceType::class, array(
	    			 'expanded' => true,
	    			 'multiple' => true,
    	    			 'choices'  => array(
        			 	    'Posta Elettronica' => 'PostaElettronica',
        			 	    'PC Windows' => 'PCWindows',
        			 	    'Linux Offline' => 'LinuxOffline',
					    ),
			         'data' => array(
				            0 => "PostaElettronica",
					    1 => "PCWindows",
					    2 => "LinuxOffline",
				            ),

					   ))

//            ->add('mailingLists', ChoiceType::class, array(
//    	    			 'choices'  => array(
//        			 	    'tutti group' => 'tuttiGroup',
//        			 	    'win group' => 'winGroup',
//        			 	    'linux group' => 'linuxGroup',
//					    ),
//					   ))

            ->add('note', TextType::class, array(
    	      	    'required'    => false,
		    // 'placeholder' => '',
    		    'empty_data'  => null
		    ))
//            ->add('save', SubmitType::class, array('label' => 'SEND REQUEST'))
            ->getForm();

	  $form->handleRequest($request);

	  if ($form->isSubmitted() && $form->isValid()) {
             // $form->getData() holds the submitted values
             // but, the original `$task` variable has also been updated
	     $ar = $form->getData();
	     $ar->setMailingLists("");
	     // save
	     //$repo = $this->getDoctrine()->getrepository('AppBundle:AccountRequest');
             $em = $this->getDoctrine()->getManager();
             $em->persist($ar);
             $em->flush();

	     // Using service to get LDAP attributes
             $srvc = $this->container->get('get.attributes');
	     $attributes = $srvc->getAttributes($this->getUser()->getUsername());

	     $mailsToNotify = $this->container->getParameter('mailsToNotify');
	     array_push($mailsToNotify, $attributes['email']);

             // OK ALL DONE!
	     foreach ($mailsToNotify as $recipient) {
	         $message = \Swift_Message::newInstance()
	             ->setSubject('New account request from ' . $ar->getGroupHead() . ' for ' . $ar->getName() . ' ' . $ar->getSurname())
		     ->setFrom('webmaster@igi.cnr.it')
		     ->setTo($recipient)
		     ->setBody(
			$this->renderView(
                        'emails/newaccount.html.twig',
                        array('ar' => $ar)
                      ),'text/html');
	          $this->get('mailer')->send($message);



//GMY
//$headers = "From: webmaster@igi.cnr.it\r\n";
//$ret = mail('gianluca.moro@igi.cnr.it', 'LOG: email sent', 'email sent', $headers);
//GMY
	     }
             return $this->redirectToRoute('thanks');
    	}

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/thanks", name="thanks")
     */
    public function thanksAction(Request $request)
    {
        return $this->render('default/thanks.html.twig', array(
            'note' => "note",
	    ));
    }


    /**
     * @Route("/showall", name="showall")
     */
    public function showallAction(Request $request)
    {
        $repo = $this->getDoctrine()->getrepository('AppBundle:AccountRequest');
        $ars = $repo->findAll();

        return $this->render('default/showall.html.twig', array(
            'ars' => $ars,
	    ));
    }




}
