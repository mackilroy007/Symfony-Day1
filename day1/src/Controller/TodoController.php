<?php

namespace App\Controller;

// We need to import Response, Route, Request and Controller if we want to use them
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Now we need some classes in our Controller because we need that in our form (for the inputs that we will create)
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Todo;

class TodoController extends  AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function  showAction()
    {
        // Here we will use getDoctrine to use doctrine and we will select the entity that we want to work with and we used findAll() to bring all the information from it and we will save it inside a variable named todos and the type of the result will be an array
        $todos = $this->getDoctrine()->getRepository('App:Todo')->findAll();
        // replace this example code with whatever you need
        return $this->render('todo/index.html.twig', array('todos' => $todos));
    }


    /**
     * @Route("/create", name="create_page")
     */
    public function  createAction(Request $request)
    {
        // Here we create an object from the class that we made
        $todo = new Todo;
        /* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */
        $form = $this->createFormBuilder($todo)->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr'  => array('class' => 'form-control', 'style' => 'margin-botton:15px')))
            ->add('due_date', DateTimeType::class, array('attr'  => array('style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create Todo', 'attr'  => array('class' => 'btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();
        $form->handleRequest($request);


        /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */
        if ($form->isSubmitted() && $form->isValid()) {
            //fetching data

            // taking the data from the inputs by the name of the inputs then getData() function
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $description = $form['description']->getData();
            $priority = $form['priority']->getData();
            $due_date = $form['due_date']->getData();

            // Here we will get the current date
            $now = new \DateTime('now');

            /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */
            $todo->setName($name);
            $todo->setCategory($category);
            $todo->setDescription($description);
            $todo->setPriority($priority);
            $todo->setDueDate($due_date);
            $todo->setCreateDate($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash(
                'notice',
                'Todo Added'
            );
            return   $this->redirectToRoute('home_page');
        }
        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */
        return   $this->render('todo/create.html.twig', array('form'  => $form->createView()));
    }



    /**
     * @Route("/edit/{id}", name="edit_page")
     */
    public   function   editAction($id)
    {
        return   $this->render('todo/edit.html.twig');
    }

    /**
     * @Route("/details/{id}", name="details_page")
     */
    public   function   detailsAction($id)
    {
        return   $this->render('todo/details.html.twig');
    }
}
