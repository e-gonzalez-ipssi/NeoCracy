<?php 

namespace App\Manager;

use Exception;

Trait LikeManagerTrait {

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

    public function likeProposition(int $propositionId, int $authorid): void {
        $requete = "INSERT INTO `propositionlike` (`id_Proposition`, `id_Utilisateur`, `vote`) VALUES ('$propositionId', '$authorid', '1')";
        $this->setQuery($requete);
        $this->querySet();
    }

    public function dislikeProposition(int $propositionId, int $authorid): void {
        $requete = "INSERT INTO `propositionlike` (`id_Proposition`, `id_Utilisateur`, `vote`) VALUES ('$propositionId', '$authorid', '0')";
        $this->setQuery($requete);
        $this->querySet();
    }

    public function removeLikeProposition(int $propositionId, int $authorid): void {
        $requete = "DELETE FROM `propositionlike` WHERE `id_Proposition` = $propositionId and `id_Utilisateur` = $authorid";
        $this->setQuery($requete);
        $this->querySet();
    }
}
