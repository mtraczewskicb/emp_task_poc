<?php

declare(strict_types=1);

namespace App\Controller\Group;

use App\Controller\AbstractController;
use App\Entity\ConfigGroup;
use App\Model\Group\GroupCreateDto;
use App\Model\Group\GroupFactory;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class GroupCreateController extends AbstractController
{
    public function index(): View
    {
        /** @var GroupCreateDto $dto */
        $dto = $this->serializer->deserialize(GroupCreateDto::class);

        /** @var ConfigGroup $group */
        $group = GroupFactory::create($dto);
        $this->em->persist($group);
        $this->em->flush();

        return View::create(['id' => $group->getId()], Response::HTTP_CREATED);
    }
}
