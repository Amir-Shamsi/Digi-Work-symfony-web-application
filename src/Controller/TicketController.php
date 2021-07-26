<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketFormType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class TicketController extends AbstractController
{
    /**
     * @Route("/ticket/new", name="app_ticket")
     */
    public function ticket(Request $request, EntityManagerInterface $manager): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(TicketFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile*/
            $uploadedFile = $form['imageFile']->getData();
            if($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '\public\uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
            }
            /** @var Ticket $ticket */
            $ticket = $form->getData();
            $ticket->setPublishedAt(new \DateTimeImmutable());
            /** @var array $files $files */
            if($uploadedFile) {
                $files = ['uploads\\'.$newFilename];
                $ticket->setUploadedImagesFilename($files);
            }
            $ticket->setTracingNumber('ticket'.'-'.uniqid());

            /** @var User $user*/
            $user = $manager->getRepository(User::class)->findOneBy(
                ['username' => $this->getUser()->getUsername()]
            );

            $ticket->setUser($user);

            $manager->persist($ticket);
            $manager->flush();



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
        if(sizeof($tracingNumber)==0 || !$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        /** @var Ticket $ticket */
        $ticket = $manager->getRepository(Ticket::class)->findOneBy(
            ['tracingNumber' => $tracingNumber]
        );

        /** @var User $user*/
        $user = $this->getUser();

        return $this->render('ticket/receipt.html.twig',[
            'ticket'=>$ticket,
            'user'=>$user
        ]);
    }
}
