<?php

include '../entity/bd.php';

abstract class  Manager
{
    private bd $bd;
    private string $query;
    
    public function __construct (bd $bd)  {
        $this->$bd = $bd;
    }

    /**
     * Cette fonction permet de préparer la requete qui sera effectuer en la stokant dans l'objet Manager
     * 
     * @param string $requete la requete que l'on souhaite mettre en recherche
     * 
     * @return void
     */
    protected function setQuery (string $requete): void {
        $this->query = $requete;
    }

    /**
     * Cette fonction permet de renvoyer le resultat de la requête faite a la bd sous la forme d'une array exploitable
     * 
     * @return array
     */
    protected function find () {
        $result = $this->bd->query($this->query);

        return $result;
    }

    /**
     * Permet de créer un retour indiquant que la fonction c'est bien dérouler comme prévu
     * 
     * @param string $message Message a renvoyer a l'utilisateur
     * 
     * @return array
     */
    protected function ack(string $message): array {
        return [
            "code" => 200,
            "message" => $message,
        ];
    }

    /**
     * Permet de créer un retour indiquant que la fonction c'est bien dérouler comme prévu
     * 
     * @param int $code le code d'erreur a renvoyer a l'utilisateur
     * @param string $message Message a renvoyer a l'utilisateur
     * 
     * @return array
     */
    protected function error(int $code, string $message): array {
        return [
            "code" => $code,
            "message" => $message,
        ];
    }
}
