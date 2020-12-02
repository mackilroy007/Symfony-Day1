<?php
namespace App\Controller;

// We need to import Response, Route, Request and Controller if we want to use them
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class  TodoController extends Controller
{
   /**
    * @Route("/", name="home_page")
    */
   public function showAction()
   {
        // Here we will use getDoctrine to use doctrine and we will select the entity that we want to work with and we used findAll() to bring all the information from it and we will save it inside a variable named todos and the type of the result will be an array
       $todos = $this->getDoctrine()->getRepository( 'App:Todo')->findAll();
     
       return $this ->render('todo/index.html.twig', array('todos'=>$todos));
// we send the result (the variable that have the result of bringing all info from our database) to the index.html.twig page
   }


    /**
    * @Route("/create", name="create_page")
    */
   public  function createAction()
   {
       return  $this->render('todo/create.html.twig');
   }

    /**
    * @Route("/edit/{id}", name="edit_page")
    */
   public  function editAction($id)
   {
        return $this->render('todo/edit.html.twig' );
   }

   /**
    * @Route("/details/{id}", name="details_page")
    */
   public function  detailsAction($id)
   {
       return  $this->render('todo/details.html.twig');
   }
}
?> 