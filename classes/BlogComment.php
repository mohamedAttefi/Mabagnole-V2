<?php
include_once "DataBase.php";

class BlogComment
{
    private $id;
    private $article_id;
    private $user_id;
    private $content;
    private $created_at;
    private static ?PDO $pdo = null;


    public function __construct($id = null, $article_id, $user_id, $content, $created_at)
    {
        $this->id = $id;
        $this->article_id = $article_id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->created_at = $created_at;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }

    public static function findByArticle($id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT *, c.content as commentaire, u.nom as user_name from blog_comments c join utilisateurs u on c.user_id = u.id join blog_articles a on c.article_id = a.id where a.id = ?");
        $result = $stmt->execute([$id]);
        if($result){
            return $stmt->fetchall();
        }
        else{
            return null;
        }
    }

    public static function addComment($data)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into blog_comments (article_id, user_id, content, created_at) values (?, ?, ?, NOW())");
        $result = $stmt->execute([$data["article_id"], $data["user_id"], $data["content"]]);
        if($result){
            return $result;
        }else{
            return null;
        }
    }
}
