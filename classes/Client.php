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
    protected static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }
    public static function getAll($user_id = null, $limit = null)
    {
        self::initPDO();

        $sql = "SELECT
    u.id, u.nom, u.email, u.telephone, u.adresse, u.permis_numero, u.date_inscription,u.statut,
    SUM(r.prix_total) AS total_depense, count(r.id) as total_reservation
    FROM utilisateurs u
    LEFT JOIN reservations r ON u.id = r.client_id where 1=1";
        $params = [];
        if ($user_id) {
            $sql .= " and id = ?";
            $params[] = $user_id;
        }

        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $sql .= " GROUP BY u.id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);

        $reservations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservations[] = $row;
        }
        return $reservations;
    }

    public static function updateStatut($statut, $id)
    {
        self::initPDO();

        $sql = "update utilisateurs set statut = ? where id = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$statut, $id]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
}
