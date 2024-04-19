<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Gtmc\EmpCore\Components\SerializerService\SerializerService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractController extends AbstractFOSRestController
{
    protected SerializerService $serializer;
    protected EntityManagerInterface $em;
    protected EventDispatcherInterface $eventDispatcher;
    protected LoggerInterface $logger;

    public function __construct(
        SerializerService $serializer,
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        LoggerInterface $logger
    ) {
        $this->serializer = $serializer;
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * @deprecated
     */
    protected function generateUrlWithPrefix(string $route, array $parameters = [], string $prefix = 'api'): string
    {
        return '/' . $prefix . $this->generateUrl($route, $parameters);
    }
}
