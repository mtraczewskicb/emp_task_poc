<?php

declare(strict_types=1);

namespace App\Controller\Config;

use App\Controller\AbstractController;
use App\Model\Config\ConfigDtoFactory;
use App\Model\Config\ConfigsRequestDto;
use App\Repository\ConfigRepository;
use FOS\RestBundle\View\View;
use Gtmc\EmpCore\Model\Response\ListResponse\ListResponseBuilder;

class ConfigsController extends AbstractController
{
    public function index(ConfigRepository $repo): View
    {
        /** @var ConfigsRequestDto $dto */
        $dto = $this->serializer->deserialize(ConfigsRequestDto::class);

        $query = $repo->getQueryBuilderConfigsRequestDto($dto);

        $response = ListResponseBuilder::build($dto, $query);
        foreach ($response->getData() as $key => $entity) {
            $response->replaceData($key, ConfigDtoFactory::create($entity));
        }

        return View::create($response);
    }
}
