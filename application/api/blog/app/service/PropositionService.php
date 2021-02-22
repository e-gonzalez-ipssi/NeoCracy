<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Organisation;
use App\Entity\Proposition;
use App\Manager\PropositionManager;
use Exception;

class  PropositionService {

    private PropositionManager $propositionManager;

    public function __construct(PropositionManager $propositionManager)
    {
        $this->propositionManager = $propositionManager;
    }

    public function createProposition(Organisation $org, User $author, string $title, string $description): void {
        $this->propositionManager->createProposition($org->getId(), $author->getId(), $title, $description);
    }

    public function getPropositionById(int $id): Proposition {
        return $this->propositionManager->getPropositionById($id);
    }

    public function getPropositionTags(int $id): array {
        return $this->propositionManager->getTags($id);
    }
}
