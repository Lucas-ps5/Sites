<?php

use App\Actions;
use App\StripePayment;

if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['auth'])){
    setcookie(
        'LOGGED_USER',
        $_SESSION['auth'],
        [
            'expires' => time() + 30*24*3600,
            'secure' => true,
            'httponly' => true,
        ]
    );
}
function checkActive(string $name): ?string
{
    if (isset($_SERVER['REQUEST_URI']) && ($_SERVER['REQUEST_URI'] === $name)) {
        return 'marque-clicked';
    } else {
        return null;
    }
}

//if(isset($_GET['']))

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Laptops et composants pc" ?></title>
    <link href="/Style/lestyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="body">
    <div class="entete">

        <div id="nom-site">
            <div id="image-nom">
                <img id="logo-site" src="images/Shop-electro-removebg-preview.png">
            </div>
            <h1>Achetez vos composants pour pc chez nous</h1>
            <div id="submit">
                <a id="submit-link" href="<?= $router->url('inscription') ?>">Inscrivez vous</a>
            </div>
            <div class="basket-value">
                <a href="<?= $router->url('panier') ?>">
                <div class="basket-value-field">
                    <p id="basket-value-content-img"><img id="img-basket-value" src="images/3091153741582807758-128.png" alt="image de panier"></p>
                    <p id="basket-value-content">
                        <?= Actions::get_sum_basket() ?>€
                    </p>
                </div>
                </a>
            </div>
        </div>
        <div id="menu-search">

            <div class="contenu-menu">
                <div id="image-menu">
                    <img id="icone-menu" src="images/icons8-menu-50.png">
                    <img id="icone-menu-rigth" src="images/icons8-menu-arrondi-48.png">
                    <div class="submenu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="#" class="sub-menu-link">
                                <img src="images/processor-chip.png" alt="processeur">
                                <p>Processeurs</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img id="graphic-card" src="images/graphic-card.png" alt="processeur">
                                <p>Cartes graphique</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img src="images/settings.png" alt="processeur">
                                <p>Parametres</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <img src="images/logout.png" alt="processeur">
                                <p>Se deconnecter</p>
                                <span>></span>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="menu">
                    <ul id="liste-menu">
                        <li class="element-menu">
                            <img class="menu-img" src="images/information.png" alt="aide">
                            <a class="contenue-element-menu" href="<?= $router->url('aide') ?>">Aide</a>
                        </li>
                        <li class="element-menu">
                            <img class="menu-img" src="images/shopping-cart.png" alt="panier">
                            <a class="contenue-element-menu" href="<?= $router->url('panier') ?>">Panier</a>
                        </li>
                        <li class="element-menu">
                            <img class="menu-img" src="images/heart.png" alt="favoris">
                            <a class="contenue-element-menu" href="<?= $router->url('favoris') ?>">Favoris</a>
                        </li>
                        <li class="element-menu">
                            <img class="menu-img" src="images/black-male-user-symbol.png" alt="connection">
                            <a class="contenue-element-menu" href="<?= $router->url('connexion') ?>">Connexion</a>
                        </li>
                    </ul>
                </nav>

                <div id="search-bar">
                    <input id="search-field" type="search" placeholder="Rechercher un produit...">
                    <div id="search-img">
                        <img id="search-bar-img" src="images/brows_browsing_find_search_seo_web_zoom_icon_123196.png">
                    </div>
                </div>

            </div>
        </div>
    <div class="container">
        <div class="marques">
            <aside>
                <h3><a class="marque <?= checkActive("/hp") ?>" href="<?= $router->url('marque', ['slug' => 'hp']) ?>">HP</a></h3>
                <h3><a class="marque <?= checkActive("/acer") ?>" href="<?= $router->url('marque', ['slug' => 'acer']) ?>">ACER</a></h3>
                <h3><a class="marque <?= checkActive("/dell") ?>" href="<?= $router->url('marque', ['slug' => 'dell']) ?>">DELL</a></h3>
                <h3><a class="marque <?= checkActive("/lenovo") ?>" href="<?= $router->url('marque', ['slug' => 'lenovo']) ?>">LENOVO</a></h3>
            </aside>
        </div>
        <div class="articles">
            <?= $content ?>
        </div>
    </div>
    <footer>
        <div id="pied-de-page">
            <p>Copyright 2023 Logabo Luc Etudiant en Informatique</p>
        </div>
    </footer>
    <script src="test.js"></script>
</body>

</html>