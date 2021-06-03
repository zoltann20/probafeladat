<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    //A főoldalra irányításhoz szükséges
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render(view: 'home/index.html.twig');
    } 
    
    
    //A kapcsolat oldalra irányításhoz szükséges
    public function message()
    {
        return $this->render(view: 'message/index.html.twig');
    } 
}