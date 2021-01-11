<?php

abstract class  Manager
{
    DB $db;
    string $query;
    
    public function __construct (DB $db)  {
        $this->$db = $db;
    }

    /**
     * Cette fonction permet de préparer la requete qui sera effectuer en la stokant dans l'objet Manager
     * 
     * @param string $requete la requete que l'on souhaite mettre en recherche
     * 
     * @return void
     */
    private function setQuery (string $requete): void {
        $this->$query = $requete;
    }

    /**
     * Cette fonction permet de renvoyer le resultat de la requête faite a la DB sous la forme d'une array exploitable
     * 
     * @return array
     */
    private function find (): array {
        $result = $db->query($this->$query);

        return $this->arrayify($result);
    }

    /**
     * Cette fonction permet de créer une array exploitable avec le resultat de la query
     * 
     * @param typederetour $queryResult le resultat de la query
     * 
     * @return array
     */
    private function arrayify (typederetour $queryResult): array {
        $result = $queryResult;

        return $result
    }
