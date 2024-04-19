<?php

declare(strict_types=1);

namespace App\Controller\Schema;

use App\Controller\AbstractController;
use App\Model\Config\ConfigsRequestDto;
use App\Model\Schema\SchemaDtoFactory;
use App\Repository\ConfigSchemaRepository;
use FOS\RestBundle\View\View;
use Gtmc\EmpCore\Model\Response\ListResponse\ListResponseBuilder;

class SchemasController extends AbstractController
{
    public function index(ConfigSchemaRepository $repo): View
    {
        /** @var ConfigsRequestDto $dto */
        $dto = $this->serializer->deserialize(ConfigsRequestDto::class);

        $query = $repo->getQueryBuilderConfigSchemasRequestDto($dto);

        $response = ListResponseBuilder::build($dto, $query);
        foreach ($response->getData() as $key => $entity) {
            $response->replaceData($key, SchemaDtoFactory::create($entity));
        }

        return View::create($response);
    }
}
