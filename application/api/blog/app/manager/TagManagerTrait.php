<?php 

namespace App\Manager;

use App\Entity\Tag;
use Exception;

Trait TagManagerTrait {

    /**
     * Permet de récupéré la liste des tags d'une proposition
     */
    public function getTags(int $propositionId): array {
        $requete = "SELECT id FROM `PropositionTags` WHERE id_Proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        $tagsList = $this->createTags($result);

        return $tagsList;
    }

    public function getOrganisationTags(int $orgId): array {
        $requete = "SELECT id FROM `tags` WHERE id_Organisation = $orgId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        $tagsList = $this->createTags($result);

        return $tagsList;
    }

    private function createTags(array $result): array{
        $tags = [];
        foreach($result as $tag) {
            $tagId = $tag["id"];

            $requete = "SELECT * FROM `tags` WHERE id = $tagId";
            $this->setQuery($requete);
            $result = $this->querySelect();

            $newTag = new Tag(
                $result[0]["id"],
                $result[0]["nom"]
            );
            array_push($tags, $newTag);
        }
        return $tags;
    }

    public function addTagToOrganisation(int $orgId, string $tagName) {
        $requete = "INSERT INTO `tags` (`nom`, `id_Organisation`) VALUES ('$tagName', '$orgId')";
        $this->setQuery($requete);
        $this->querySet();

        $requete = "SELECT `id` FROM `tags` WHERE `nom` = '$tagName' and `id_Organisation` = '$orgId'";
        $this->setQuery($requete);
        $result = $this->querySelect();

        if(count($result) < 1) {
            throw new Exception("tag-not-created");
        }
    }

    public function getTagId(int $orgId, string $tagName): int{
        $requete = "SELECT `id` FROM `tags` WHERE `nom` = '$tagName' and `id_Organisation` = '$orgId'";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return $result[0]['id'];
    }

    public function addTagToProposition(int $propositionId, int $tagId) {
        $requete = "INSERT INTO `PropositionTags` (`id`, `id_Proposition`) VALUES ('$tagId', '$propositionId')";
        $this->setQuery($requete);
        $this->querySet();
    }
}
