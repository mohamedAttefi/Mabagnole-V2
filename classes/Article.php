<?php

include_once "DataBase.php";

class Article
{
    private $id;
    private $title;
    private $content;
    private $user_id;
    private $theme_id;
    private $status;
    private $created_at;
    private static ?PDO $pdo = null;

    public function __construct($id = null, $title, $content, $user_id, $theme_id, $status = null, $created_at = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->theme_id = $theme_id;
        $this->status = $status;
        $this->created_at = $created_at;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }

    public static function all($statut = null)
    {
        self::initPDO();
        $sql = "SELECT *, b.id as article_id, u.nom as user_name,u.id as user_id, t.id as theme_id, t.name as theme_name from blog_articles b join themes t on b.theme_id = t.id join utilisateurs u on b.user_id = u.id where 1=1";
        $params = [];
        if($statut){
            $sql .= " and status = ?";
            $params[] = $statut;
        }
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }


    public static function findByUser($user_id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT *, u.nom as user_name, t.name as theme_name from blog_articles b join themes t on b.theme_id = t.id join utilisateurs u on b.user_id = u.id where user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchall();
    }

    public static function find($id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT
    b.*,
    u.nom AS user_name,
    t.name AS theme_name,
    COUNT(c.id) AS total_comments
    FROM blog_articles b
    JOIN themes t ON b.theme_id = t.id
    JOIN utilisateurs u ON b.user_id = u.id
    LEFT JOIN blog_comments c ON b.id = c.article_id
    WHERE b.id = ?
    GROUP BY b.id, u.nom, t.name;
    ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addArticle()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into blog_articles (title, content, user_id, theme_id) value(?,?,?,?)");
        $result = $stmt->execute([$this->title, $this->content, $this->user_id, $this->theme_id]);
        if ($result) {
            return self::$pdo->lastInsertId();
        } else {
            return null;
        }
    }
}
