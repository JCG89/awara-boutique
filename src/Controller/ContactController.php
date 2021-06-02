<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Swift_Mailer\FrameworkBundle;

class ContactController extends AbstractController
{
    /**
     * @Route("/nous-contacter", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact =  $form->getData();
            // L'envoi du mail
            $message = (new \Swift_Message('Nouveau Contact'))
                // On attribue l'expéditeur
                ->setFrom($contact['email'])
                //    On attribue le destinataire
                ->setTo('christophegomis89@gmail.com')
                // On rend le message à la vue Twig
                ->setBody(
                    $this->render(
                        'emails/contact.html.twig',
                        compact('contact')
                    ),
                    'text/html'
                );
            // On envoie le message 

            $mailer->send($message);


            $this->addFlash('notice', 'Merci de nous avoir contacter , notre équipe vous répondra dans les méilleurs délais');

            return $this->redirectToRoute('gomis');
        }
        return $this->render('contact/index.html.twig', [

            'form' => $form->createView()
        ]);
    }
}