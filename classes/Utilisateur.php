<?php
include_once "DataBase.php";
class Utilisateur
{
    protected $id;
    protected $nom;
    protected $email;
    protected $motPasse;
    protected $role;
    protected $telephone;
    protected $adresse;
    protected $permisNumero;
    protected $dateInscription;
    protected static ?PDO $pdo = null;

    public function __construct($id = null, $nom, $email, $motPasse, $role, $telephone, $adress, $permisNumero, $dateInscription = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motPasse = $motPasse;
        $this->telephone = $telephone;
        $this->adress = $adress;
        $this->permisNumero = $permisNumero;
        $this->dateInscription = $dateInscription;
        $this->role = $role;
        self::initPDO();
    }

    protected static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }


    public static function findByEmail($email)
    {
        self::initPDO();
        $sql = "select * from utilisateurs where email = '$email';";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Utilisateur($row["id"], $row["nom"], $row["email"], $row["mot_de_passe"], $row["role"], $row["telephone"], $row["adresse"], $row["permis_numero"], $row["date_inscription"]);
        } else {
            return null;
        }
    }
    public static function seConnecter($email, $pass)
    {
        $userFind = Utilisateur::findByEmail($email);
        if (!$userFind) return null;

        if (password_verify($pass, $userFind->__get("motPasse"))) {
            return $userFind;
        }
        // print_r($userFind);
        return null;
    }

    final public function sInscrire()
    {
        $userFind = Utilisateur::findByEmail($this->email);
        if ($userFind) {
            return null;
        } else {
            $sql = "INSERT INTO utilisateurs
            (nom, email, mot_de_passe, role, telephone, adresse, permis_numero, statut)
            VALUES
            (:nom, :email, :motPasse, :role, :telephone, :adress, :permisNumero, :statut)";

            $stmt = self::$pdo->prepare($sql);

            $stmt->execute([
                'nom' => $this->nom,
                'email' => $this->email,
                'motPasse' => password_hash($this->motPasse, PASSWORD_BCRYPT),
                'role' => 'client',
                'telephone' => $this->telephone,
                'adress' => $this->adress,
                'permisNumero' => $this->permisNumero,
                'statut' => 1
            ]);
            return true;
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

    public static function getUserDetails($user_id)
    {
        self::initPDO();
        $sql = "SELECT * FROM utilisateurs WHERE id = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
