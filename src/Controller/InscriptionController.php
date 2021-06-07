<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController

{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            //    $search_email= $this->em->getRepository( User::class)->findOneByEmail($user->getEmail());

            //    if(!$search_email){
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();



            // $notification = 'Votre inscription a bien été pris en compte vous pouvez dés à présent vous connecter à votre compte';           
            //   }

            //    else{

            //     $notification = 'L\'email que vous avez renseigné existe déjà !';
            // }

            return $this->redirectToRoute('app_login');
        }


        return $this->render('inscription/index.html.twig', [

            'form' => $form->createView(),

            // 'notification' => $notification

        ]);
    }
}