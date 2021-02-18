<?php 

namespace App\Manager;

use App\Entity\Tag;

Trait TagManagerTrait {

    /**
     * Permet de récupéré la liste de like ainsi le nombre de dislike
     */
    private function getTags(int $propositionId): array {
        $requete = "SELECT 'id_Tag' FROM `havetags` WHERE 'id_Proposition' = '$propositionId'";
        $this->setQuery($requete);
        $result = $this->querySelect();

        $tagsList = $this->createTags($result);

        return $tagsList;
    }

    private function createTags(array $result): array{
        $tags = [];
        foreach($result as $tag) {
            $tagId = $tag["id_Tag"];

            // faire une requete dans la table getTags

            $requete = "SELECT 'id', 'nom' FROM `havetags` WHERE 'id_tag' = '$tagId'";
            $this->setQuery($requete);
            $result = $this->querySelect();

            $newTag = new Tag(
                $tag[0]["id"],
                $tag[0]["nom"]
            );
            array_push($tags, $newTag);
        }
        return $tags;
    }
}
