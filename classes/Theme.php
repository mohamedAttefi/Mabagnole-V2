<?php
include_once "DataBase.php";

class Theme
{
    private $id;
    private $name;
    private $description;

    private static ?PDO $pdo = null;


    public function __construct($id = null, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }

    public static function all()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * from themes");
        $stmt->execute();
        return $stmt->fetchall();
    }
}
