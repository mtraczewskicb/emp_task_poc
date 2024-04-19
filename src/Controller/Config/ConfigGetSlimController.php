<?php

declare(strict_types=1);

namespace App\Controller\Config;

use App\Controller\AbstractController;
use App\Entity\Config;
use App\Model\Config\ConfigDtoFactory;
use FOS\RestBundle\View\View;
use Psr\Cache\CacheItemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Contracts\Cache\CacheInterface;

class ConfigGetSlimController extends AbstractController
{
    /**
     * @ParamConverter("config", class="App\Entity\Config", converter="config_param_converter")
     */
    public function index(Config $config, CacheInterface $cache): View
    {
        $dto = $cache->get($config->getAlias() . '_slim', function (CacheItemInterface $cacheItem) use ($config) {
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }
            $cacheItem->expiresAfter(Config::CACHE_TTL);
            $value = ConfigDtoFactory::createSlim($config);
            $cacheItem->set($value);

            return $value;
        });

        return View::create($dto);
    }
}
