<?php

declare(strict_types=1);

namespace App\Controller\Group;

use App\Controller\AbstractController;
use App\Entity\ConfigGroup;
use App\Security\GroupVoter;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class GroupDeleteController extends AbstractController
{
    public function index(ConfigGroup $group): View
    {
        $this->denyAccessUnlessGranted(
            GroupVoter::ACCESS,
            null,
            GroupVoter::getMessage(GroupVoter::ACCESS, $this->getUser())
        );
        $this->em->remove($group);
        $this->em->flush();

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
