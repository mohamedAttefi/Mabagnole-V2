<?php
include_once "Utilisateur.php";

class Admin extends Utilisateur
{
    public function __construct(
        $id,
        $nom,
        $email,
        $motPasse,
        $role,
        $telephone,
        $adress,
        $permisNumero,
        $dateInscription
    ) {
        parent::__construct(
            $id,
            $nom,
            $email,
            $motPasse,
            $role,
            $telephone,
            $adress,
            $permisNumero,
            $dateInscription
        );
    }
}
