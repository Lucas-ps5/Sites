<?php
namespace App;

use App\Model\Article;
use PDO;

class PaginQuery {

    private $perPage;
    private $pdo;
    private $count;
    private $queryCount;
    private $marque;

    public function __construct(string $queryCount, 
         ?PDO $pdo = null, int $perPage = 12, $marque = null)
    {
        $this->queryCount = $queryCount;
        //$this->classMapping = $classMapping;
        $this->pdo = $pdo ?: Connect::getPDO();
        $this->perPage = $perPage;
        $this->marque = $marque;
    }

    public function getItems(string $classMapping) : array
    {
        $currentPage = $this->getCurrentPage();
        $offset = $this->perPage * ($currentPage - 1);

        if($currentPage > $this->getPAges()){
            throw new \Exception("cette page n'existe pas ");
        }
        if($this->marque !== null){
            $items = $this->pdo->prepare("SELECT * FROM article WHERE marque = ? LIMIT {$this->perPage} OFFSET $offset");
            $items->execute([$this->marque]);
            $items->setFetchMode(PDO::FETCH_CLASS, $classMapping);
            return $items->fetchAll();
        }
        return ($this->pdo->query("SELECT * FROM article LIMIT {$this->perPage} OFFSET $offset")
                           ->fetchAll(PDO::FETCH_CLASS, $classMapping));
    }

    /*public function getItemsBymark(string $marque, string $classMapping) : array
    {
        $currentPage = $this->getCurrentPage();
        $offset = $this->perPage * ($currentPage - 1);
        if($currentPage > $this->getPages()){
            throw new \Exception("cette page n'existe pas ");
        }
        $items = $this->pdo->prepare("SELECT * FROM article WHERE marque = ? LIMIT {$this->perPage} OFFSET $offset");
        $items->execute([$marque]);
        $items->setFetchMode(PDO::FETCH_CLASS, $classMapping);
        return $items->fetchAll();
    }*/

    public function getPAges() : int
    {
        if($this->count === null && $this->marque === null){
            $this->count = (int)$this->pdo
                         ->query($this->queryCount)
                         ->fetch(PDO::FETCH_NUM)[0];
        }
        if($this->marque !== null){
            $count = $this->pdo->prepare("SELECT COUNT(id) FROM article WHERE marque = ?"); 
            $count->execute([$this->marque]);
            $result = $count->fetch(PDO::FETCH_NUM)[0];
            $this->count = $result;
            return (int)$result;
        }
        return ceil($this->count / $this->perPage);
    }

    public static function getFavorites($user_id) : Article|array|null
    {
        $pdo = Connect::getPDO();
        $query = $pdo->prepare("SELECT `id`, `name`, `category`, `marque`, `path`, `slug`, `description`, `prix` FROM article
                                      left join article_user on article_user.user_id 
                                      where article_user.article_id = article.id and article_user.user_id = ?");
        $query->execute([$user_id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Article::class);
        return $query->fetchAll(); 
    }

    public static function getBasket($user_id) : array|null
    {
        $pdo = Connect::getPDO();
        $query = $pdo->prepare("SELECT `id`, `name`, `path`, `prix` , `qte` FROM article
                                      left join panier on panier.id_user 
                                      where panier.id_article = article.id and panier.id_user = ?");
        $query->execute([$user_id]);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->rowCount() ? $query->fetchAll(): [];
    }

/*    public function getPagesByMark(string $marque) : int 
    {
        $count = $this->pdo->prepare("SELECT COUNT(id) FROM articles WHERE marque = ?"); 
        $count->execute([$marque]);
        $count->fetch(PDO::FETCH_NUM)[0];
        return (int)$count;
    }*/

    public function getCurrentPage()
    {
        return URL::getPositiveInt('page', 1);
    }

    public function nextLink(string $link) : ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPAges();

        if($currentPage >= $pages) return null;
        if((int)$this->count <= $this->perPage) return null;

        $link .= "?page=" . ($currentPage + 1);
        return <<<HTML
            <a href="{$link}" id="pagin-right">Page Suivante</a>
HTML;
     }

     public function previousLink(string $link) : ?string
     {
        $currentPage = $this->getCurrentPage();
        
        if($currentPage <= 1) return null;
        if($currentPage > 2) {
           /* if($this->marque !== null){
                $link .= "{$this->marque}/";
            }*/
            $link .= "?page=" . ($currentPage - 1);
        }
        return <<<HTML
            <a href="{$link}" id="pagin-left">Page Precedente</a>
HTML;
     }

}