<?php

declare(strict_types=1);

namespace App\Controller\Group;

use App\Controller\AbstractController;
use App\Entity\ConfigGroup;
use App\Model\Group\GroupDtoFactory;
use App\Security\GroupVoter;
use FOS\RestBundle\View\View;

class GroupGetController extends AbstractController
{
    public function index(ConfigGroup $group): View
    {
        $dto = GroupDtoFactory::create($group);
        $this->denyAccessUnlessGranted(
            GroupVoter::ACCESS,
            $dto,
            GroupVoter::getMessage(GroupVoter::ACCESS, $this->getUser())
        );

        return View::create($dto);
    }
}
