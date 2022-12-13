<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/main")
     */
    public function main()
    {
        return $this->render('main.html.twig');
    }
}