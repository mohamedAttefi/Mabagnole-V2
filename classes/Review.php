<?php
include_once "DataBase.php";

class Review
{
    private $id;
    private $client_id;
    private $vehicule_id;
    private $reservation_id;
    private $note;
    private $commentaire;
    private $date_creation;
    private static $pdo = null;

    public function __construct($id, $client_id, $vehicule_id, $reservation_id, $note, $commentaire, $date_creation)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->commentaire = $commentaire;
        $this->note = $note;
        $this->reservation_id = $reservation_id;
        $this->date_creation = $date_creation;
        $this->vehicule_id = $vehicule_id;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            $db = DataBase::getInstance();
            self::$pdo = $db->getConnection();
        }
    }

    public function create()
    {
        self::initPDO();

        try {
            $sql = "
                INSERT INTO avis
                (client_id, vehicule_id, reservation_id, note, commentaire, date_creation)
                VALUES (?, ?, ?, ?, ?, NOW())
            ";

            $stmt = self::$pdo->prepare($sql);
            $result = $stmt->execute([
                $this->client_id,
                $this->vehicule_id,
                $this->reservation_id,
                $this->note,
                $this->commentaire,
            ]);

            if ($result) {
                return self::$pdo->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in Review::create(): " . $e->getMessage());
            return false;
        }
    }





    public static function find($id)
    {
        self::initPDO();

        try {
            $sql = "SELECT * FROM avis WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::find(): " . $e->getMessage());
            return null;
        }
    }

    public static function findByReservation($reservation_id)
    {
        self::initPDO();

        try {
            $sql = "SELECT * FROM avis WHERE reservation_id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$reservation_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::findByReservation(): " . $e->getMessage());
            return null;
        }
    }

    public static function findByAllUser($user_id = null, $reservation_id = null, $limit = null)
    {
        self::initPDO();

        try {
            $sql = "
            SELECT a.*,u.*, v.marque, v.modele, v.image_url, v.prix_journalier, v.immatriculation, v.categorie, v.note_moyenne, v.carburant
            FROM avis a
            JOIN utilisateurs u ON a.client_id = u.id
            JOIN listevehicules v ON a.vehicule_id = v.id
            WHERE 1=1
        ";

            $params = [];

            if ($user_id !== null) {
                $sql .= " AND a.client_id = ?";
                $params[] = $user_id;
            }
            if ($reservation_id !== null) {
                $sql .= " AND a.reservation_id = ?";
                $params[] = $reservation_id;
            }

            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public static function findByUser($user_id, $reservation_id = null, $limit = null)
    {
        self::initPDO();

        try {
            $sql = "
            SELECT a.*, v.marque, v.modele, v.image_url, v.prix_journalier
            FROM avis a
            JOIN vehicules v ON a.vehicule_id = v.id
            WHERE a.client_id = ?
        ";

            $params = [$user_id];

            if ($reservation_id !== null) {
                $sql .= " AND a.reservation_id = ?";
                $params[] = $reservation_id;
            }

            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public static function getVehicleReviews($vehicle_id, $limit = null)
    {
        self::initPDO();

        try {
            $sql = "
                SELECT a.*, c.nom, c.prenom
                FROM avis a
                JOIN clients c ON a.client_id = c.id
                WHERE a.vehicule_id = ? AND a.statut = 'actif'
                ORDER BY a.date_avis DESC
            ";

            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$vehicle_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::getVehicleReviews(): " . $e->getMessage());
            return [];
        }
    }

    public static function deleteReview($id)
    {
        $sql = "delete from avis where id = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
