<?php
include_once "Database.php";

class Vehicle
{
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $categorie_id;
    private $prix_journalier;
    private $carburant;
    private $nb_places;
    private  $description;
    private  $image_url;
    private $disponible;

    private static ?PDO $pdo = null;

    public function __construct($id = null, $marque, $modele, $annee, $immatriculation, $categorie_id, $prix_journalier, $carburant, $nb_places, $description, $image_url, $disponible)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->immatriculation = $immatriculation;
        $this->categorie_id = $categorie_id;
        $this->prix_journalier = $prix_journalier;
        $this->carburant = $carburant;
        $this->nb_places = $nb_places;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->disponible = $disponible;
        self::initPDO();
    }


    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public static function all()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * from listevehicules where disponible = 1");
        $stmt->execute();
        return $stmt->fetchall();
    }

    public static function find(int $id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM listevehicules WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function ajouterVehicule($data)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into vehicules (marque, modele, annee, immatriculation, categorie_id, prix_journalier, nb_places, description, image_url, carburant) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data["marque"], $data["marque"], $data["modele"], $data["annee"], $data["immatriculation"], $data["categorie_id"], $data["prix_journalier"], $data["nb_places"], $data["description"], $data["image_url"], $data["carburant"]]);
        return $stmt->fetch();
    }

    public function __get($att)
    {
        return $this->$att;
    }

    public function __set($att, $value)
    {
        $this->$att = $value;
    }
}
