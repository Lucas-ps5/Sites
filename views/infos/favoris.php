<?php

use App\Actions;
use App\Auth;
use App\PaginQuery;

if(Auth::checkConnected() === true){
    $articles = PaginQuery::getFavorites(Actions::backUserId());
}
$title = "Favoris";
?>

<?php if(isset($articles)) : ?>
<h1 id="h1-favorites">Vos Favoris</h1>
<div class="favorites-articles">
<?php foreach($articles as $article) : ?>
    <a href="<?= $router->url('article', ['id' => $article->getId(), 'slug' => $article->getSlug()])?>" class="laptop-link">
        <div class="article-card">
            <div class="article-img">
                <img class="article-image" src="<?= htmlentities($article->getPath()) ?>">
            </div>
            <div class="article-name">
                <h2><?= htmlentities($article->getName()) ?></h2>                   
            </div>
            <div class="article-description">
                <p><?= htmlentities($article->getDescription()) ?></p>
                <p style="color: green;"><?= $article->getPrix() ?> €</p>
            </div>
        </div>
    </a>
<?php endforeach ?>
</div>
<?php endif ?>