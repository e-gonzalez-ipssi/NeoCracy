<?php 

namespace App\Manager;

use App\Entity\bd ;
Use App\Entity\User;
Use App\Entity\Proposition;
use App\Service\UserService;
use Exception;

class PropositionManager extends Manager {

    use TagManagerTrait;
    use LikeManagerTrait;

    protected UserService $userService;

    public function __construct(bd $bd, UserService $userService)
    {
        parent::__construct($bd);

        $this->userService = $userService;
    }

    /**
     * Cette fonction permet de récupéré une proposition exploitable en donnant son id
     */
    public function getPropositionById(int $id): Proposition {
        $requete = "SELECT * FROM `proposition` WHERE id = $id";
        $this->setQuery($requete);
        $result = $this->querySelect();

        if (count($result) < 1) {
            throw new Exception("proposition-not-founds");
        }

        if (count($result) > 1) {
            throw new Exception("error-in-request");
        }

        $author = $this->getAuthor($id);

        $tags = $this->getTags($id);

        $like = $this->getLikeNumber($id);
        $dislike = $this->getDislikeNumber($id);

        $propositions = $this->fromQueryToPropositions($result, $author, $tags, $like, $dislike);

        return $propositions[0];
    }

    /**
     * Permet de créer une nouvelle proposition
     */
    public function createProposition(int $orgId, int $authorId, string $title, string $description): int{
        $timestamp = time();
        $requete = "INSERT INTO `proposition` (`nom`, `description`, `date`) VALUES ('$title', '$description', '$timestamp')";
        $this->setQuery($requete);
        $this->querySet();

        $requete = "SELECT id FROM `proposition` WHERE date = $timestamp";
        $this->setQuery($requete);
        $result = $this->querySelect();

        $propositionId = $result[0]['id'];

        $requete = "INSERT INTO `OrgProposition` (`id_Proposition`, `id_Organisation`) VALUES ($propositionId, $orgId)";
        $this->setQuery($requete);
        $this->querySet();

        $requete = "INSERT INTO `UtilisateurProposition` (`id_Proposition`, `id_Utilisateur`) VALUES ($propositionId, $authorId);";
        $this->setQuery($requete);
        $this->querySet();

        return $propositionId;
    }

    /**
     * Fonction permettant de récupéré l'autheur d'une proposition
     */
    private function getAuthor(int $propositionId): User {
        $requete = "SELECT id_Utilisateur FROM `UtilisateurProposition` WHERE id_Proposition = $propositionId";
        $this->setQuery($requete);
        $result = $this->querySelect();

        if(count($result) < 1) {
            throw new Exception("no-author-to-proposition");
        }

        if(count($result) > 1) {
            throw new Exception("to-many-author-to-message");
        }

        return $this->userService->getUserById($result[0]["id_Utilisateur"]);
    }

    /**
     * Fonction permettant de récupéré la liste des likers a une proposition
     */
    public function getLikers(int $propositionId): array {
        $requete = "SELECT id_Utilisateur FROM `propositionlike` WHERE id_Proposition = $propositionId and vote = 1";
        $this->setQuery($requete);
        $result = $this->querySelect();

        if(count($result) < 1) {
            return [];
        }

        $userList = [];
    
        foreach($result as $userId) {
            $user = $this->userService->getUserById($userId["id_Utilisateur"]);
            array_push($userList, $user);
        }

        return $userList;
    }

    /**
     * Fonction permettant de récupéré la liste des dislikers a une proposition
     */
    public function getDislikers(int $propositionId): array {
        $requete = "SELECT id_Utilisateur FROM `propositionlike` WHERE id_Proposition = $propositionId and vote = 0";
        $this->setQuery($requete);
        $result = $this->querySelect();

        if(count($result) < 1) {
            return [];
        }

        $userList = [];
    
        foreach($result as $userId) {
            $user = $this->userService->getUserById($userId["id_Utilisateur"]);
            array_push($userList, $user);
        }

        return $userList;
    }
}
