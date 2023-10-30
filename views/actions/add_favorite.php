<?php
use App\Actions;
use App\Auth;
use App\Connect;
use App\Model\Article;

/*var_dump($_GET);
$id = (int)$params['id'];
var_dump($id);*/

if(Auth::checkConnected() === true){

    /*$userInfos = $_COOKIE['LOGGED_USER'];
    $username = explode('_', $userInfos);
    $firstname = $username[0];
    
    $query = $pdo->prepare('SELECT id FROM user WHERE firstname = :firstname');
    $query->execute(['firstname' => $firstname]);
    //$query->setFetchMode(PDO::FETCH_CLASS, Article::class);
    $user_id = $query->fetch();*/
    if(!empty($_POST['id']) && !empty($_POST['user_id'])){

        $id = (int)$_POST['id'];
        $user_id = (int)$_POST['user_id'];
        $pdo = Connect::getPDO();

        $user_id = Actions::backUserId();
        
        if(Actions::checkTable($id, $user_id, "article_user") === false){
            try{
                $pdo->exec("INSERT INTO article_user SET article_id=$id, user_id=$user_id");
            }catch(PDOException $pe){
                
            }
        }else{
            try{
                $pdo->exec("DELETE FROM article_user WHERE article_id=$id AND user_id=$user_id");
            }catch(PDOException $pe){
                
            }
        }
    }
}else{
    header('Location: ' . $router->url('connexion'));
}
?>
