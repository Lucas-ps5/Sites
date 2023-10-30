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
    if(!empty($_POST['id']) && !empty($_POST['user_id']) && !empty($_POST['qte'])){

        $id = (int)$_POST['id'];
        $user_id = (int)$_POST['user_id'];
        $qte = (int)$_POST['qte'];
        $pdo = Connect::getPDO();

        if($_POST['status'] === 'add_basket'){
        
            if($qte > 0){
                if(Actions::checkTable($id, $user_id, "panier") === false){
                    try{
                        $pdo->exec("INSERT INTO panier SET id_article=$id, id_user=$user_id, qte=$qte");
                    }catch(PDOException $pe){
                        
                    }
                }else{
                    $query = $pdo->prepare("SELECT `qte` FROM panier WHERE id_article = :id AND id_user = :user_id");
                    $query->execute(['id' => $id,
                                     'user_id' => $user_id]);
                    $newQte = $query->fetch(PDO::FETCH_NUM)[0];
                    $newQte += $qte;
                    $pdo->exec("UPDATE panier SET qte=$newQte WHERE id_article=$id AND id_user=$user_id");
                }
            }
        }
        if($_POST['status'] === 'remouve_basket'){

            $pdo->exec("DELETE FROM panier WHERE id_article=$id AND id_user=$user_id");
            echo 'deleted';
        }
    }
}else{
    header('Location: ' . $router->url('connexion'));
}
?>
