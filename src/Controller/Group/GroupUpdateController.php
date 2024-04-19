<?php

declare(strict_types=1);

namespace App\Controller\Group;

use App\Controller\AbstractController;
use App\Entity\ConfigGroup;
use App\Model\Group\GroupFactory;
use App\Model\Group\GroupUpdateDto;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class GroupUpdateController extends AbstractController
{
    public function index(ConfigGroup $group): View
    {
        /** @var GroupUpdateDto $dto */
        $dto = $this->serializer->deserialize(GroupUpdateDto::class);

        GroupFactory::create($dto, $group);
        $this->em->flush();

        return View::create(null, Response::HTTP_OK);
    }
}
