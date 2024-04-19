<?php

declare(strict_types=1);

namespace App\Controller\Schema;

use App\Controller\AbstractController;
use App\Entity\ConfigSchema;
use App\Model\Schema\SchemaFactory;
use App\Model\Schema\SchemaUpdateDto;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class SchemaUpdateController extends AbstractController
{
    public function index(ConfigSchema $schema): View
    {
        /** @var SchemaUpdateDto $dto */
        $dto = $this->serializer->deserialize(SchemaUpdateDto::class);

        SchemaFactory::create($dto, $schema);
        $this->em->flush();

        return View::create(null, Response::HTTP_OK);
    }
}
