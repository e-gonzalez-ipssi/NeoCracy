<?php 

include 'Manager.php';

class AddUserManager extends Manager {

    /**
     * Cette fonction permet de setup la query pour créer un utilisateur
     * 
     * @return string Cette fonction retourne ou un message d'erreur ou un message disant que tout c'est bien passer
     * 
     */
    public function createUser(string $nom, string $prenom, string $mdp, string $mail, ?string $telephone = null, ?string $photo = null): array {
        /** @var string $newQuery */
        $newQuery = "INSERT INTO `Utilisateur` (`nom`, `prenom`, `mdp`, `mail`, `tel`, `photo`) VALUES ($nom, $prenom, $mdp, $mail, $telephone, $photo);";
        $this->setQuery($newQuery);

        try {
            $result = $this->find();
        } catch (Exception $e) {
            return $this->error($e->getCode(), $e->getMessage());
        }
        
        return $this->ack("L'utilisateur a bien été ajouté a la base de donnée");
    }
}
