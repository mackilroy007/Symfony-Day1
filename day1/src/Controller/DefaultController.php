<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\ Controller \AbstractController;
use Symfony\Component\HttpFoundation\ Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/hello/{name}")
     */

    // public function index()
    public function index($name)
    {
        // return new Response('Hello!');
        return new Response("Hello $name");
    }
    /**
     * @Route("/simplicity")
     */
    public function simple()
    {
        return new Response('Simple! Easy! Great!');
    }

    /**
     * @Route("/test/variable", name="var")
     */

    public  function testVarAction(Request $request)
    {
        $arr = array("name" => "serri", "age" => 30); // here we create a simple array have keys and values
        return $this->render('test/test.html.twig', array("varName" => $arr)); // this is the way how to send a variable from php (variable you created in the controller) to the twig file
    }
}
