<?php
include_once "Utilisateur.php";

class Client extends Utilisateur
{
    private $statut;
    public function __construct(
        $id,
        $nom,
        $email,
        $motPasse,
        $role,
        $telephone,
        $adress,
        $permisNumero,
        $dateInscription,
        $statut
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
            $dateInscription,
            $statut
        );

        $this->statut = $statut;
    }
}

