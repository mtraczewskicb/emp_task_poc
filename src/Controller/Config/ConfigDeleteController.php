<?php

declare(strict_types=1);

namespace App\Controller\Config;

use App\Controller\AbstractController;
use App\Entity\Config;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ConfigDeleteController extends AbstractController
{
    public function index(Config $config): View
    {
        $this->em->remove($config);
        $this->em->flush();

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
