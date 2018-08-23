<?php

namespace App\Controller;

use Psr\SimpleCache\CacheInterface;
use Pusher\Pusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function index()
    {
        $visitorCount = $this->getVisitorCount();
        return $this->render('index.html.twig', [
            'pusherKey' => $this->getParameter('pusherKey'),
            'pusherCluster' => $this->getParameter('pusherCluster'),
            'visitorCount' => $visitorCount,
        ]);
    }

    public function webhook(Request $request, Pusher $pusher)
    {
        $events = json_decode($request->getContent(), true)['events'];
        $visitorCount = $this->getVisitorCount();
        foreach ($events as $event) {
            // ignore any events from our public channel--it's only for broadcasting
            if ($event['channel'] === 'visitor-updates') {
                return;
            }
            $visitorCount += ($event['name'] === 'channel_occupied') ? 1 : -1;
        }
        // save new figure and notify all clients
        $this->saveVisitorCount($visitorCount);
        $pusher->trigger('visitor-updates', 'update', ['newCount' => $visitorCount]);
        return new Response();
    }

    private function getVisitorCount()
    {
        return $this->cache->get('visitorCount') ?: 1;
    }

    private function saveVisitorCount($visitorCount)
    {
        $this->cache->set('visitorCount', $visitorCount);
    }

}
