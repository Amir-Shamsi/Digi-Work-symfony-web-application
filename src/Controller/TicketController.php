<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Form\TicketFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="app_ticket")
     */
    public function ticket(Request $request): Response
    {
        $form = $this->createForm(TicketFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            dd($form['imageFile']->getData());
        }
        return $this->render('ticket/ticket.html.twig', [
            'ticketForm' => $form->createView()
        ]);
    }
}
