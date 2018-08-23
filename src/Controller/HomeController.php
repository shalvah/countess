<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        $visitorCount = $this->getVisitorCount();
        return $this->render('index.html.twig', [
            'visitor_count' => $visitorCount,
        ]);
    }

    private function getVisitorCount()
    {
        return 0;
    }
}
