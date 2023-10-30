<?php 
namespace App;

use App\Model\User;
use Exception;
use PDO;

class Actions {

    public static function checkTable($param1, $param2, string $tableName){
        if($tableName === "article_user"){

            $pdo = Connect::getPDO();
            $query = $pdo->prepare('SELECT * FROM article_user WHERE article_id = :param1 AND user_id = :param2');
            $query->execute(['param1' => $param1, 'param2' => $param2]);
            $query->setFetchMode(PDO::FETCH_NUM);
            return ($query->rowCount() > 0)? true: false ;

        }else if($tableName === "panier"){

            $pdo = Connect::getPDO();
            $query = $pdo->prepare('SELECT * FROM panier WHERE id_article = :param1 AND id_user = :param2');
            $query->execute(['param1' => $param1, 'param2' => $param2]);
            $query->setFetchMode(PDO::FETCH_NUM);
            return ($query->rowCount() > 0)? true: false ;
        }else{
            throw new Exception("Invalid table name");
        }
    }

    public static function backUserId() : ?int
    {   
        if(isset($_COOKIE['LOGGED_USER'])){
            $userInfos = $_COOKIE['LOGGED_USER'];
            $username = explode('_', $userInfos);
            $firstname = $username[0];

            $pdo = Connect::getPDO();
            $query = $pdo->prepare('SELECT id FROM user WHERE firstname = :firstname');
            $query->execute(['firstname' => $firstname]);
            //$query->setFetchMode(PDO::FETCH_CLASS, Article::class);
            $param2 = $query->fetch();
            return (int)$param2;
        }
        return null;
    }

    public static function get_sum_basket() : ?float
    {
        $articles = PaginQuery::getBasket(Actions::backUserId());
        $sum = 0;
        foreach ($articles as $article){
            $sum += $article['prix'] * $article['qte'];
        }
        return ($sum != null)? $sum : 0;
    }

    public static function checkPayment()
    {
        if(isset($_SESSION['payment']) && $_SESSION['payment'] === "payment_started"){
    
                return true;
        }
        return false;
    }


}