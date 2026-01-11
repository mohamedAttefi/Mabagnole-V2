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
        $stmt = self::$pdo->prepare("SELECT t.id, t.name,t.description,b.created_at, count(b.id) as total from themes t left join blog_articles b on t.id = b.theme_id GROUP BY b.theme_id, t.name
");
        $stmt->execute();
        return $stmt->fetchall();
    }

    public static function delete($id){
        self::initPDO();
        $stmt = self::$pdo->prepare("delete themes where id = ?");
        $stmt->execute([$id]);
    }
    public function create(){
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into themes (name, description) values (?,?)");
        $stmt->execute([$this->name, $this->description]);
    }

    public function update(){
        self::initPDO();
        $stmt = self::$pdo->prepare("update themes set name = ?, description = ? where id = ?");
        $stmt->execute([$this->name, $this->description, $this->id]);
    }
}
