<?php
include_once "DataBase.php";

class Categorie
{
    private $id;
    private $nom;
    private $description;
    private $disponible;

    private static ?PDO $pdo = null;

    public function __construct($nom, $description, $disponible = null, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->disponible = $disponible;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public static function find($id)
    {
        try {
            self::initPDO();

            $stmt = self::$pdo->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public function __get($att)
    {
        return $this->$att;
    }

    public function __set($att, $value)
    {
        $this->$att = $value;
    }
    public static function all($statut = null)
    {
        self::initPDO();
        $sql = "SELECT * FROM categories WHERE 1=1";
        $params = [];
        if ($statut) {
            $sql .= " and disponible = ?";
            $params[] = $statut;
        }
        $stmt = self::$pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchall();
    }
    public static function one($caregorieName)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM categories WHERE disponible = 1 and nom = ?");
        $stmt->execute([$caregorieName]);
        return $stmt->fetch();
    }

    public static function countVehicle($caregorieName)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("select count(v.categorie_id) as count from categories c JOIN vehicules v ON c.id = v.categorie_id where c.nom = ?");
        $stmt->execute([$caregorieName]);
        return $stmt->fetch();
    }

    public static function updateStatus($statut, $id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("update categories set disponible = ? where id = ?");
        $stmt->execute([$statut, $id]);
    }

    public function create()
    {
        $stmt = self::$pdo->prepare("insert into categories(nom, description) values(?,?)");
        $stmt->execute([$this->nom, $this->description]);
    }
    public static function findById($id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM categories WHERE disponible = 1 and id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return new Categorie($row["nom"], $row["description"], null, $row["id"]);
    }

    public function update($newName, $newDescription)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("update categories set nom = ?, description = ? where id = ?");
        $stmt->execute([$newName, $newDescription, $this->id]);
    }
}
