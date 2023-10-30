<?php

use App\Actions;
use App\Auth;
use App\Connect;
use App\Model\Article;
use App\Model\Caracteristiques;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connect::getPDO();
$query = $pdo->prepare('SELECT * FROM article WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Article::class);

$getInfos = $pdo->prepare('SELECT * FROM caracteristiques WHERE id = :id');
$getInfos->execute(['id' => $id]);
$getInfos->setFetchMode(PDO::FETCH_CLASS, Caracteristiques::class);

$article = $query->fetch();
$caracteristiques = $getInfos->fetch();
$user_id = '';
if(Auth::checkConnected() === true){

    $user_id = Actions::backUserId();
    
}

?>
<div class="show-article">
    <div class="name-img">
        <div id="article-show-name">
            <?= htmlentities($article->getCategory()) . ' ' . htmlentities($article->getName()) ?>
        </div>
        <div id="show-image">
            <img id="img-article" src="<?= $article->getPath() ?>">
        </div>
    </div>
    <div class="article-caract">
        <div class="article-show">
            <ul class="list-caract">
                <li class="caract-item">Processeur :  <span class="caract-item-text"><?= htmlentities($caracteristiques->getProcesseur()) ?></span></li>
                <li class="caract-item">Ram : <span class="caract-item-text"><?= htmlentities($caracteristiques->getRam()) ?></span></li>
                <li class="caract-item">Carte Graphique : <span class="caract-item-text"><?= htmlentities($caracteristiques->getGraphics()) ?></span></li>
                <li class="caract-item">Ecran : <span class="caract-item-text"><?= htmlentities($caracteristiques->getScreen()) ?></span></li>
                <li class="caract-item">Options : <span class="caract-item-text"><?= htmlentities($caracteristiques->getOther()) ?></span></li>
                <li class="caract-item">Disque Dur : <span class="caract-item-text"><?= htmlentities($caracteristiques->getDd()) ?></span></li>
                <li class="caract-item">Batterie : <span class="caract-item-text"><?= htmlentities($caracteristiques->getBattery()) ?> Heures</span></li>
                <li class="caract-item">Systeme : <span class="caract-item-text"><?= htmlentities($caracteristiques->getInstalled_sys()) ?></span></li>
            </ul>
            <span id="prix"><strong><?= $article->getPrix() ?> €</strong></span>
        </div>
    </div>
</div>
<div id="buy">
    <button id="send-basket">panier</button>
    <input type="number" placeholder="quantite" id="qte" name="qte" value="1">
</div>
<button id="add-favorite" data-user_id="<?= $user_id ?>" data-post_id="<?= $id ?>">
<?php if(Auth::checkConnected() === true && Actions::checkTable($id, $user_id, "article_user") === true) : ?>
    <img id="img-fav" class="img-fav-true" src="images/black_heart.png">
<?php else : ?>
    <img id="img-fav" class="img-fav-false" src="images/love-removebg-preview.png">
<?php endif ?>
    <p>Ajouter aux favoris</p>    
</button>
<?php //var_dump(Actions::checkFavorite($id, $user_id));
?>

<div class="main-modal">
    <div class="modal">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <h3 class="succes-box-msg">Ajoute au panier</h3>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript">
    $('#add-favorite').click(function(){
        
        var data = {
            id: $(this).data('post_id'),
            user_id: $(this).data('user_id')
        };
        $.ajax({
            url: '<?= $router->url('set_favorite')?>',
            type: "POST",
            data: data,
            success:function(response){
                console.log(response);
            }
        });
    });

    
    $('#send-basket').click(function(){

        var elements = {
            id: <?= $id ?>,
            user_id: <?= $user_id ?>,
            qte: $('#qte').val(),
            status: 'add_basket'
        };
        $.ajax({
            url: '<?= $router->url('action_basket')?>',
            type: "POST",
            data: elements,
            success:function(res){
                console.log(res);
                $('.main-modal').addClass("active");
                // close modal after a few seconds
                let time = setTimeout(function(){
                    $('.main-modal').removeClass("active");
                }, 1000);
            }
        });
    });
</script>