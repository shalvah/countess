<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        $visitorCount = $this->getVisitorCount();
        return $this->render('index.html.twig', [
            'pusherKey' => $this->getParameter('pusherKey'),
            'pusherCluster' => $this->getParameter('pusherCluster'),
            'visitorCount' => $visitorCount,
        ]);
    }

    private function getVisitorCount()
    {
        return 0;
    }
}
