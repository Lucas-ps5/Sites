<?php
use App\Auth;
use App\Connect;
use App\Html\Form;
use App\Model\User;
use App\Tables\UserTable;
$form = new Form($_POST);
$title = "Connexion";

if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $usertable = new UserTable(Connect::getPDO());
    if(!empty($email) && !empty($password)){
        try{
            $user = $usertable->findByemail($email);
            if($user != null){
                if(password_verify($password, $user->getPassword())){
                    try{
                        session_start();
                        $_SESSION['auth'] = $user->getFirstname() . '_' . $user->getLastname();
                        header('Location: ' . $router->url('home'));
                        exit();
                    }catch (Exception $e){
                        echo "Erreur : ". $e->getMessage(). "<br/>";
                    }
                }else{
                    $message =  <<<HTML
                    <div class="register-error">
                        <p>Email ou mot de passe invalide</p>
                    </div>
HTML;
                    }
                    
            }else{
                $message =  <<<HTML
                <div class="register-error">
                    <p>Email ou mot de passe invalide</p>
                </div>
HTML;
                }
        }catch(Exception $a){
            echo "Erreur : ". $a->getMessage(). "<br/>";
        }
        
    }
}

?>

<?php if(Auth::checkConnected() === true) : ?>
            <h1 class="logged-text">Vous etes deja connectes</h1>
<?php else : ?>
<div class="body-form">
    <?= $message ?? '' ?>
    <form class="auth-form" id="auth-form-connect" name="myForm" action="<?= $router->url('connexion') ?>" onsubmit="return validateForm()"  method="POST">
        <p id="inscription-header">Connexion</p>
        <div class="form-field">
            <?= $form->input('email', 'adresse email') ?>
            <?= $form->input('password', 'mot de passe') ?>
            <div class="check-password" style="color: blue;">
                <?= $form->checkbox('see-password') ?>
            </div>
        </div>
        <div class="register-send">
            <p><button type="submit" id="register" style="margin-top: 80px">Se connecter</button></p>
            <a href="<?= $router->url('inscription') ?>" style="color:orangered">Inscrivez vous ici</a>
        </div>
    </form>
</div>
<?php endif ?>
