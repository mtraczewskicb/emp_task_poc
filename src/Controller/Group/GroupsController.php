<?php

declare(strict_types=1);

namespace App\Controller\Group;

use App\Controller\AbstractController;
use App\Model\Group\GroupDtoFactory;
use App\Model\Group\GroupsRequestDto;
use App\Repository\ConfigGroupRepository;
use App\Security\GroupVoter;
use FOS\RestBundle\View\View;
use Gtmc\EmpCore\Model\Response\ListResponse\ListResponseBuilder;

class GroupsController extends AbstractController
{
    public function index(ConfigGroupRepository $repo): View
    {
        /** @var GroupsRequestDto $dto */
        $dto = $this->serializer->deserialize(GroupsRequestDto::class);
        $this->denyAccessUnlessGranted(
            GroupVoter::ACCESS,
            $dto,
            GroupVoter::getMessage(GroupVoter::ACCESS, $this->getUser())
        );
        $query = $repo->getQueryBuilderConfigGroupsRequestDto($dto);

        $response = ListResponseBuilder::build($dto, $query);
        foreach ($response->getData() as $key => $entity) {
            $response->replaceData($key, GroupDtoFactory::create($entity));
        }

        return View::create($response);
    }
}
