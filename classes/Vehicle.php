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

    public function __construct($marque, $modele, $annee, $immatriculation, $categorie_id, $prix_journalier, $carburant, $nb_places, $description, $image_url, $disponible = null, $id = null)
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
        $sql = "SELECT * from listevehicules where 1=1 and disponible = 1";

        $stmt = self::$pdo->prepare($sql);

        $stmt->execute();
        return $stmt->fetchall();
    }

    public static function find(int $id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM listevehicules WHERE id = ? and disponible = 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function ajouterVehicule()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into vehicules (marque, modele, annee, immatriculation, categorie_id, prix_journalier, nb_places, description, image_url, carburant) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        echo $this->categorie_id;
        $stmt->execute([$this->marque, $this->modele, $this->annee, $this->immatriculation, (int)$this->categorie_id, $this->prix_journalier, $this->nb_places, $this->description, $this->image_url, $this->carburant]);
        return $stmt->fetch();
    }

    public function updateVehicule()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("update vehicules set marque = ? , modele = ?, annee = ?, immatriculation = ?, categorie_id = ?, prix_journalier = ?, nb_places = ?, description = ?, image_url = ?, carburant = ? where id = ?");
        $stmt->execute([$this->marque, $this->modele, $this->annee, $this->immatriculation, (int)$this->categorie_id, $this->prix_journalier, $this->nb_places, $this->description, $this->image_url, $this->carburant, $this->id]);
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

    public static function deleteVehicle($id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("update vehicules set disponible = false where id = ?");
        $result = $stmt->execute([$id]);
        if ($result) {
            return true;
        }
        return null;
    }
}
