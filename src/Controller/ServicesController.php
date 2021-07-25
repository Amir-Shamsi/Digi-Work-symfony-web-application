<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="app_services")
     */
    public function services(Request $request, EntityManagerInterface $manager, UserInterface $user): Response
    {

        if ($request->request->get('silver-package') === "true")
        {
            AddUserPackage();
        }
        else if($request->request->get('bronze-package') === "true")
        {
            dd('my bronze', $user);

        }
        else if($request->request->get('gold-package') === "true")
        {
            dd('my gold');
        }

        return $this->render('services/services.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }
}
