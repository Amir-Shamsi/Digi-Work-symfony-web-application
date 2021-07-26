<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\AddToUserCart;
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
    public function services(Request $request, EntityManagerInterface $manager): Response
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        /**
         * @var Product[]
         */
        $product = $repository->findAll();

//
//        if ($request->request->get('silver-package') === "true")
//        { //Todo: packages should replace by serial
////            AddToUserCart::addToCart($manager, $user);
//        }
        if($request->request->get('serial'))
        {
            dd($request->$request->get('serial'));

        }
//        else if($request->request->get('gold-package') === "true")
//        {
//            dd('my gold');
//        }

        return $this->render('services/services.html.twig', [
            'products' => $product
        ]);
    }
}
