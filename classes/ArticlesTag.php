<?php
include_once "DataBase.php";

class ArticlesTag
{
    private $article_id;
    private $tag_id;
    private static ?PDO $pdo = null;

    public function __construct($article_id, $tag_id)
    {
        $this->article_id = $article_id;
        $this->tag_id = $tag_id;
        self::initPDO();
    }
    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = DataBase::getInstance()->getConnection();
        }
    }
    public function add()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("insert into article_tags (article_id, tag_id) value(?,?)");
        $result = $stmt->execute([$this->article_id, $this->tag_id]);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public static function getTagForArticle($id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT *
        FROM blog_tags t
        JOIN article_tags at ON t.id = at.tag_id
        JOIN blog_articles a ON a.id = at.article_id
        WHERE a.id = ?;");
        $result = $stmt->execute([$id]);
        if ($result) {
            return $stmt->fetchall(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}
