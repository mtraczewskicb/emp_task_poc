<?php

declare(strict_types=1);

namespace App\Controller\Schema;

use App\Controller\AbstractController;
use App\Entity\ConfigSchema;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class SchemaDeleteController extends AbstractController
{
    public function index(ConfigSchema $schema): View
    {
        $this->em->remove($schema);
        $this->em->flush();

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
