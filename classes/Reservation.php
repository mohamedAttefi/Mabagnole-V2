<?php
include_once "Database.php";

class Reservation
{
    private $id;
    private $client_id;
    private $vehicule_id;
    private $date_debut;
    private $date_fin;
    private $lieu_priseencharge;
    private $lieu_retour;
    private $prix_total;
    private $statut;
    private $date_creation;

    private static $pdo = null;

    public function __construct(
        $id = null,
        $client_id = null,
        $vehicule_id = null,
        $date_debut = null,
        $date_fin = null,
        $lieu_priseencharge = null,
        $lieu_retour = null,
        $prix_total = null,
        $statut = null,
        $date_creation = null
    ) {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->vehicule_id = $vehicule_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu_priseencharge = $lieu_priseencharge;
        $this->lieu_retour = $lieu_retour;
        $this->prix_total = $prix_total;
        $this->statut = $statut;
        $this->date_creation = $date_creation;

        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public static function getUserReservations($user_id, $limit = null)
    {
        self::initPDO();

        try {
            $sql = "SELECT * FROM reservations r left join vehicules v on r.vehicule_id = v.id where r.client_id = ? ORDER BY date_debut DESC";

            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$user_id]);

            $reservations = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reservations[] = $row;
            }
// print_r($reservations);
            return $reservations;
        } catch (PDOException $e) {
            error_log("Error in Reservation::getUserReservations(): " . $e->getMessage());
            return [];
        }
    }

    public static function find($id)
    {
        self::initPDO();

        try {
            $stmt = self::$pdo->prepare("SELECT * FROM reservations r JOIN liste_vehicules v on r.vehicule_id = v.id WHERE r.id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row;
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error in Reservation::find(): " . $e->getMessage());
            return null;
        }
    }

    public static function create($data)
    {
        self::initPDO();

        $stmt = self::$pdo->prepare("
                INSERT INTO reservations
                (client_id, vehicule_id, date_debut, date_fin, lieu_priseencharge, lieu_retour, prix_total, statut, date_creation)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");

        $result = $stmt->execute([
            $data['user_id'],
            $data['vehicule_id'],
            $data['date_debut'],
            $data['date_fin'],
            $data['lieu_prise'],
            $data['lieu_retour'],
            $data['prix_total'],
            'en_attente'
        ]);

        if ($result) {
            return self::$pdo->lastInsertId();
        }
        return null;
    }


    public static function findPendingByUser($userId)
    {
        self::initPDO();

        $sql = "SELECT * FROM reservations
                WHERE client_id = ? AND statut = 'en_attente'
                ORDER BY date_creation DESC";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function countByStatusAndUser($userId, $status)
    {
        self::initPDO();
        $sql = "SELECT COUNT(*) FROM reservations
                WHERE client_id = ? AND statut = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$userId, $status]);
        return $stmt->fetchall();
    }


    public function updateStatus($status)
    {
        self::initPDO();

        try {
            $stmt = self::$pdo->prepare("
                UPDATE reservations
                SET statut = ?
                WHERE id = ?
            ");

            $result = $stmt->execute([$status, $this->id]);

            if ($result) {
                $this->statut = $status;
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in Reservation::updateStatus(): " . $e->getMessage());
            return false;
        }
    }

    public static function isVehicleAvailable($vehicle_id, $start_date, $end_date)
    {
        self::initPDO();

        try {
            $stmt = self::$pdo->prepare("
                SELECT COUNT(*) as count
                FROM reservations
                WHERE vehicule_id = ?
                AND statut IN ('confirmee', 'en_attente', 'annulee')
                AND (
                    (date_debut <= ? AND date_fin >= ?) OR
                    (date_debut <= ? AND date_fin >= ?) OR
                    (date_debut >= ? AND date_fin <= ?)
                )
            ");

            $stmt->execute([
                $vehicle_id,
                $end_date,
                $start_date,
                $start_date,
                $end_date,
                $start_date,
                $end_date
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] == 0;
        } catch (PDOException $e) {
            error_log("Error in Reservation::isVehicleAvailable(): " . $e->getMessage());
            return false;
        }
    }

    public static function findByUser($user_id)
    {
        self::initPDO();

        try {
            $stmt = self::$pdo->prepare("
                SELECT r.*, v.marque, v.modele, v.image_url, v.prix_journalier
                FROM reservations r
                JOIN vehicules v ON r.vehicule_id = v.id
                WHERE r.client_id = ?
                ORDER BY r.date_creation DESC
            ");

            $stmt->execute([$user_id]);

            $reservations = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $date_debut = new DateTime($row['date_debut']);
                $date_fin = new DateTime($row['date_fin']);
                $duree_jours = $date_debut->diff($date_fin)->days + 1;

                $reservations[] = array_merge($row, [
                    'duree_jours' => $duree_jours
                ]);
            }

            return $reservations;
        } catch (PDOException $e) {
            error_log("Error in Reservation::findByUser(): " . $e->getMessage());
            return [];
        }
    }

    public static function getAll($limit = null, $status = null)
    {
        self::initPDO();

        $sql = "SELECT r.*, v.marque, v.modele, u.nom, u.prenom
                    FROM reservations r
                    JOIN vehicules v ON r.vehicule_id = v.id
                    JOIN clients u ON r.client_id = u.id";

        $params = [];

        if ($status) {
            $sql .= " WHERE r.statut = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY r.date_creation DESC";

        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);

        $reservations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservations[] = $row;
        }
        return $reservations;
    }





    public function calculateDuration()
    {
        if ($this->date_debut && $this->date_fin) {
            $date_debut = new DateTime($this->date_debut);
            $date_fin = new DateTime($this->date_fin);
            return $date_debut->diff($date_fin)->days + 1;
        }
        return 0;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
}
