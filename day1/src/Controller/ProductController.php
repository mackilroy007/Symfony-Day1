<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/create", name="createAction")
     */
    public function createAction()
    {

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();
        $product = new  Product(); // here we will create an object from our class Product.
        $product->setName('Keyboard'); // in our Product class we have a set function for each column in our db
        $product->setPrice(19);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return  new Response('Saved new product with id ' . $product->getId());
    }
}
