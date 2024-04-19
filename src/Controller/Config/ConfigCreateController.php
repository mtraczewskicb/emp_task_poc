<?php

declare(strict_types=1);

namespace App\Controller\Config;

use App\Controller\AbstractController;
use App\Entity\Config;
use App\Model\Config\ConfigCreateDto;
use App\Model\Config\ConfigFactory;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ConfigCreateController extends AbstractController
{
    public function index(ConfigFactory $configFactory): View
    {
        /** @var ConfigCreateDto $dto */
        $dto = $this->serializer->deserialize(ConfigCreateDto::class);

        /** @var Config $config */
        $config = $configFactory->build($dto);
        $this->em->persist($config);
        $this->em->flush();

        return View::create(['id' => $config->getId()], Response::HTTP_CREATED);
    }
}
