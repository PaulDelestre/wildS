<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */

    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
        'website' => 'Wild Séries',
        ]);
    }
}