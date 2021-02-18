<?php

namespace App\Service;

use App\Entity\Proposition;
use App\Entity\User;
use App\Manager\PropositionManager;
use App\Manager\UserManager;
use Exception;

class  PropositionService {

    private PropositionManager $propositionManager;

    public function __construct(PropositionManager $propositionManager)
    {
        $this->propositionManager = $propositionManager;
    }

    public function getPropositionById(int $id): Proposition {
        return $this->propositionManager->getPropositionById($id);
    }
}
