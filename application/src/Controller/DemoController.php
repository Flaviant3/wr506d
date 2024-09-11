<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\Slugify;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(Slugify $slugify): Response
    {
        $phrase = 'éoh salamé, ça farte ?';
        $slug = $slugify->slugify($phrase);

        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
            'date' => new \DateTime(),
            'slug' => $slug, // On passe le slug à la vue
        ]);
    }
}