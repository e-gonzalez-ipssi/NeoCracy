<?php 

namespace App\Manager;

use Exception;

Trait ReportManagerTrait {

    public function reportProposition(int $propositionId, int $userId, string $message): void {
        $time = time();
        $requete = "INSERT INTO `PropositionSignalee` (`id_Proposition`, `id_Utilisateur`, `message`, `date`) VALUES ('$propositionId', '$userId', '$message', '$time')";
        $this->setQuery($requete);
        $this->querySet();
    }

    public function getReportByPropositionAndUserIds(int $propositionId, int $userId): array {
        $requete = "SELECT * FROM `PropositionSignalee` WHERE id_Proposition = $propositionId and id_Utilisateur = $userId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        return $result;
    }

}
