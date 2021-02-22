<?php 

namespace App\Manager;

use App\Entity\Tag;

Trait TagManagerTrait {

    /**
     * Permet de récupéré la liste des tags d'une proposition
     */
    public function getTags(int $propositionId): array {
        $requete = "SELECT id_Tag FROM `havetags` WHERE id_Proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        $tagsList = $this->createTags($result);

        return $tagsList;
    }

    private function createTags(array $result): array{
        $tags = [];
        foreach($result as $tag) {
            $tagId = $tag["id_Tag"];

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
}
