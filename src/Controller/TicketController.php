<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\RegistrationFormType;
use App\Form\TicketFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use http\Exception\UnexpectedValueException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="app_ticket")
     */
    public function ticket(Request $request, EntityManagerInterface $manager, UserInterface $user): Response
    {
        $form = $this->createForm(TicketFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
           /** @var UploadedFile $uploadedFile*/
            $uploadedFile = $form['imageFile']->getData();
            $destination = $this->getParameter('kernel.project_dir').'\public\uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'-'.$uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFilename
            );
            /** @var Ticket $ticket */
            $ticket = $form->getData();
            $ticket->setPublishedAt(new \DateTimeImmutable());
            /** @var array $files $files */
            $files = [$newFilename];
            $ticket->setUploadedImagesFilename($files);

            $ticket->setTracingNumber('ticket'.'-'.uniqid());
            $manager->persist($ticket);
            $manager->flush();

            $ticket->setUser($user);

            $this->addFlash('tracingNumber', $ticket->getTracingNumber());
            return $this->redirectToRoute('app_receipt');
        }
        return $this->render('ticket/ticket.html.twig', [
            'ticketForm' => $form->createView()
        ]);
    }

    /**
     * @Route ("/ticket/receipt", name="app_receipt")
     */
    public function receipt(Session $session, EntityManagerInterface $manager): Response
    {
        $tracingNumber = $session->getFlashBag()->get('tracingNumber');
//        if($tracingNumber==0 || !$this->getUser()){
//            return $this->redirectToRoute('app_login');
//        }
        $tracingNumber ='ticket-60fe6bafa7efb';

        /** @var Ticket $ticket */
        $ticket = $manager->getRepository(Ticket::class)->findBy(
            ['tracingNumber' => $tracingNumber]
        );


        return $this->render('ticket/receipt.html.twig',[
            'ticket'=>$ticket[0]
        ]);
    }
}
