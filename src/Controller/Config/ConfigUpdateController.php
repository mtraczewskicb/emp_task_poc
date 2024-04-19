<?php

declare(strict_types=1);

namespace App\Controller\Config;

use App\Controller\AbstractController;
use App\Entity\Config;
use App\Model\Config\ConfigFactory;
use App\Model\Config\ConfigUpdateDto;
use App\Service\ConfigHistoryService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;

class ConfigUpdateController extends AbstractController
{
    public function index(
        Config $config,
        ConfigFactory $configFactory,
        ConfigHistoryService $configHistoryService,
        CacheInterface $cache
    ): View {
        /** @var ConfigUpdateDto $dto */
        $dto = $this->serializer->deserialize(ConfigUpdateDto::class);

        $oldAttr = $config->getAttribute();
        $configFactory->build($dto, $config);
        $configHistoryService->checkAndCreateHistory($config, $oldAttr);
        $this->em->flush();
        $cache->delete($config->getAlias());
        $cache->delete($config->getAlias() . '_slim');

        return View::create(null, Response::HTTP_OK);
    }
}
