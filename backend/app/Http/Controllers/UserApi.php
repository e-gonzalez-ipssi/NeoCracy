<?php

namespace App\Http\Controllers;

use App\Entity\User;
use Illuminate\Http\Request;

class UserApi extends Api
{
    private const NO_RIGHT = 1;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction qui permet d'initialiser la requete
     *  - initilise les paramêtres requis ou non pour faire fonctionner l'api
     *  - fait les checks de permissions d'utilisation
     *  - vérifie si l'utilisateur a besoin d'être connecté ou pas
     */
    private function initialize(
        array $params = [],
        int $right = self::NO_RIGHT,
        bool $isConnected = true,
        bool $isModification = false
    ): array {
        $paramsClean = $this->getParams($params);

        if ($isConnected) {
            if(isset($paramsClean["userToken"])){
                $userToken = $paramsClean["userToken"];
            
                if(!$isModification){
                    $userToken = explode("=", $paramsClean["userToken"])[1];
                }
                $this->me = $this->connexionService->getCurrentUserWithToken($userToken);

            } 
            else {
                $this->me = $this->connexionService->getCurrentUser();
            } 
        }

        $this->checkAccess($right, $this->me);

        return $paramsClean;
    }

    /**
     * Permet de faire des différents check de permission
     * - créer un nouveau case par nouveau type de permission
     */
    private function checkAccess(int $right, ?User $me) {
        switch ($right) {
            case self::NO_RIGHT:
            default:
                return;
        }
    }

    /**
     * @route get(api/user/{id})
     * 
     * @param int $id l'id de l'utilisateur que l'on recherche
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function getUser(int $id) {
        $params = $this->initialize([], self::NO_RIGHT, false);

        $user = $this->userService->getUserById($id);
        return $this->returnOutput($user->arrayify());
    }

    /**
     * @route get(api/me)
     * 
     * @return mixed les informations de l'utilisateur au format JSON
     */
    public function getMe(Request $request) {
        $this->initialize([
            ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
        ], self::NO_RIGHT, true);

        return $this->returnOutput($this->me->arrayify());
    }

    /**
     * @route post(api/user/{id}/update)
     * 
     * @return  mixed Un message d'approbation
     */
    public function updateMe(Request $request, int $id) {
        $params = $this->initialize(
            [
                ["nom", REQUIRED, TYPE_STRING, $request->input('nom')],
                ["prenom", REQUIRED, TYPE_STRING, $request->input('prenom')],
                ["mail", REQUIRED, TYPE_MAIL, $request->input('mail')],
                ["userToken", REQUIRED, TYPE_STRING, $request->input('userToken')],
            ],
            self::NO_RIGHT, 
            true,
            true,
        );
        
        $this->userService->updateMe(
            $this->userService->getUserById($id),
            $params['nom'],
            $params['prenom'],
            $params['mail']
        );
        return $this->returnOutput($this->ack());
    }

    /**
     * @route post(api/connect/)
     * 
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function connect(Request $request) {
        $params = $this->initialize(
            [
                ["mail", REQUIRED, TYPE_MAIL, $request->input('mail')],
                ["password", REQUIRED, TYPE_PASSWORD, $request->input('password')],
            ],
            self::NO_RIGHT,
            false,
        );

        $cookie = $this->connexionService->connexion($params['mail'], $params['password']);
        return $this->returnOutput($cookie);
    }

    /**
     * @route post(api/disconnect/)
     * 
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function disconnect(Request $request) {
        $params = $this->initialize(
            [
                ["userToken", NOT_REQUIRED, TYPE_STRING, $request->input('userToken')],
            ],
            self::NO_RIGHT,
            true,
        );
        
        $this->connexionService->deconnexion($params["userToken"]);
        return $this->returnOutput($this->ack());
    }

    /**
     * @route post(api/register/)
     * 
     * 
     * @return  mixed les informations de l'utilisateur au format JSON
     */
    public function register(Request $request) {
        $params = $this->initialize(
            [
                ["nom", REQUIRED, TYPE_STRING, $request->input('nom')],
                ["prenom", REQUIRED, TYPE_STRING, $request->input('prenom')],
                ["mail", REQUIRED, TYPE_MAIL, $request->input('mail')],
                ["password", REQUIRED, TYPE_PASSWORD, $request->input('password')],
                ["confirmPassword", REQUIRED, TYPE_PASSWORD, $request->input('confirmPassword')],
            ],
            self::NO_RIGHT, 
            false,
        );
        
        $this->connexionService->inscription(
            $params['nom'],
            $params['prenom'],
            $params['password'],
            $params['confirmPassword'],
            $params['mail']
        );
        return $this->returnOutput($this->ack());
    }

   /**
     * @route get(api/user/{id}/organisations)
     * 
     * @param int $id l'id de l'utilisateur dont on recherche les orgnisations
     * 
     * @return mixed les informations des organisations au format JSON
     */
    public function getOrgsByUserID(Request $request, int $id) {
        $this->initialize([], self::NO_RIGHT, false);

        $organisations = $this->userService->getOrganisationById($this->userService->getUserById($id));

        $return = [];
        foreach($organisations as $organisation) {
            array_push($return, $organisation->arrayify());
        }

        return $this->returnOutput($return);
    }

}
