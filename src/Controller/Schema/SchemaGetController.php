<?php

declare(strict_types=1);

namespace App\Controller\Schema;

use App\Controller\AbstractController;
use App\Entity\ConfigSchema;
use App\Model\Schema\SchemaDtoFactory;
use FOS\RestBundle\View\View;

class SchemaGetController extends AbstractController
{
    public function index(ConfigSchema $schema): View
    {
        $dto = SchemaDtoFactory::create($schema);

        return View::create($dto);
    }
}
