<?php
use App\Connect;
use App\Model\Article;
use App\PaginQuery;

$pdo = Connect::getPDO();

$paginQuery = new PaginQuery("SELECT COUNT(id) FROM article", $pdo);
$articles = $paginQuery->getItems(Article::class);

$link = $router->url('home');
?>

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

<div class="pagination">
    <?= $paginQuery->previousLink($link); ?>
    <?= $paginQuery->nextLink($link); ?>
</div>

