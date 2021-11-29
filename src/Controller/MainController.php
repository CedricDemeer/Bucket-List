<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render("Default/home.html.twig");
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render("Bucket/AboutUs.html.twig");
    }
}

