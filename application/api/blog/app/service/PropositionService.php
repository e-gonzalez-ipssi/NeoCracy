<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Organisation;
use App\Entity\Proposition;
use App\Manager\PropositionManager;
use Exception;

class  PropositionService {

    private PropositionManager $propositionManager;
    private OrganisationService $organisationService;

    public function __construct(PropositionManager $propositionManager, OrganisationService $organisationService)
    {
        $this->propositionManager = $propositionManager;
        $this->organisationService = $organisationService;
    }

    public function createProposition(Organisation $org, User $author, string $title, string $description, string $tags) {
        // on créer une proposition
        $propositionId = $this->propositionManager->createProposition($org->getId(), $author->getId(), $title, $description);

        // créer une array avec la liste des tags : séparateur utiliser : virgule
        $tagsList = explode(",", $tags);

        // récupération de la liste de tag de l'organisation 
        $orgTags = $this->organisationService->getOrganisationTags($org);
        $orgTagsName = [];
        foreach ($orgTags as $orgTag) {
            array_push($orgTagsName, $orgTag->getName());
        }

        // pour chaque tags vérifier si il éxiste deja dans la db pour l'organisation
        $tagList = [];
        foreach ($tagsList as $tag) {
            if (!in_array($tag, $orgTagsName)) {
                $this->organisationService->addTagToOrganisation($org, $tag);
            }
            // récupéré l'id du tag via son nom et le mettre dans une array
            $tagId = $this->organisationService->getTagId($org, $tag);
            array_push($tagList, $tagId);
        }

        // pour chaque tags, les ajouter séparément à la proposition
        foreach ($tagList as $tagId) {
            $this->addTagToProposition($propositionId, $tagId);
        }
    }

    public function getPropositionById(int $id): Proposition {
        return $this->propositionManager->getPropositionById($id);
    }

    public function getPropositionTags(int $id): array {
        return $this->propositionManager->getTags($id);
    }

    public function addTagToProposition(int $propositionId, int $tagId) {
        $this->propositionManager->addTagToProposition($propositionId, $tagId);
    }
}