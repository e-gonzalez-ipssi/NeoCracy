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

    public function getReports(): array {
        $requete = "SELECT * FROM `PropositionSignalee`";
        $this->setQuery($requete);
        $results = $this->querySelect();

        $return = [];
        foreach($results as $report) {
            $reportPrep = [];

            $proposition = $this->getPropositionById($report["id_Proposition"]);
            $reportPrep["Proposition"] = $proposition;

            $user = $this->userService->getUserById($report["id_Utilisateur"]);
            $reportPrep["User"] = $user;

            $reportPrep["Message"] = $report["message"];
            $reportPrep["Timestamp"] = $report["date"];

            array_push($return, $reportPrep);
        }

        return $return;
    }

}
