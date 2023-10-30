<?php
require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


/*if(isset($_GET['page']) && $_GET['page'] === '1'){
       //reecrire l'url sans le paramettre ?page
       $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
       $get = $_GET['page'];
       unset($get['page']);
       $query = http_build_query($get);
       if(!empty($query)){
           $uri = $uri . '?' . $query;
       }
       http_response_code(301);
       header('Location: ' . $uri);
       exit();
}*/

$router = new App\Router(dirname(__DIR__) . '/views');
$router
       ->get('/', 'articles/index', 'home')
       ->get('/aide', 'infos/help', 'aide')
       ->get('/favoris', 'infos/favoris', 'favoris')
       ->get('/panier', 'infos/panier', 'panier')
       ->match('/paiement', 'actions/buy', 'stripe-payment')
       ->get('/paiement_success', 'infos/paiement_success', 'paiement_success')
       ->match('/connexion', 'auth/login', 'connexion')
       ->match('/inscription', 'auth/register', 'inscription')
       ->match('/set_favorite', 'actions/add_favorite', 'set_favorite')
       ->match('/action_basket', 'actions/action_basket', 'action_basket')
       ->get('/[*:slug]-[i:id]', 'articles/show', 'article')
       ->get('/[*:slug]', 'category/marque', 'marque')
       ->run();