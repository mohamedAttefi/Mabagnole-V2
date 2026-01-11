<?php
include_once "DataBase.php";


class Tag
{
    private $id;
    private $name;
    private static ?PDO $pdo = null;

    public function __construct($id = null, $name)
    {
        $this->id = $id;
        $this->name = $name;
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
        $stmt = self::$pdo->prepare("select *, count(a.article_id) as total_articles from blog_tags t left join article_tags a on t.id = a.tag_id GROUP BY t.id");
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetchall();
        } else {
            return null;
        }
    }
    
}
