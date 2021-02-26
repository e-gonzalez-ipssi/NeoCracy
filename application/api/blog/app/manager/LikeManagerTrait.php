<?php 

namespace App\Manager;

use Exception;

Trait TagManagerTrait {

    /**
     * Permet de récupéré le nombre de like
     */
    private function getLikeNumber(int $propositionId): int {
        $requete = "SELECT * FROM `PropositionLike` WHERE vote = 1 and id_proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return count($result);
    }

    /**
     * Permet de récupéré la liste de like
     */
    public function getLike(int $propositionId): array {
        $requete = "SELECT * FROM `PropositionLike` WHERE vote = 1 and id_proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return $result;
    }

    /**
     * Permet de récupéré le nombre de dislike
     */
    private function getDislikeNumber(int $propositionId): int {
        $requete = "SELECT * FROM `PropositionLike` WHERE vote = 0 and id_proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return count($result);
    }

    /**
     * Permet de récupéré la liste de like
     */
    public function getDislike(int $propositionId): array {
        $requete = "SELECT * FROM `PropositionLike` WHERE vote = 0 and id_proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return $result;
    }
}
