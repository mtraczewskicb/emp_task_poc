<?php

declare(strict_types=1);

namespace App\Controller\Schema;

use App\Controller\AbstractController;
use App\Entity\ConfigSchema;
use App\Model\Schema\SchemaCreateDto;
use App\Model\Schema\SchemaFactory;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class SchemaCreateController extends AbstractController
{
    public function index(): View
    {
        /** @var SchemaCreateDto $dto */
        $dto = $this->serializer->deserialize(SchemaCreateDto::class);

        /** @var ConfigSchema $config */
        $schema = SchemaFactory::create($dto);
        $this->em->persist($schema);
        $this->em->flush();

        return View::create(['id' => $schema->getId()], Response::HTTP_CREATED);
    }
}
