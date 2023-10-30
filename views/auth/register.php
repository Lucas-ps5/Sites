<?php

use App\Auth;
use App\Connect;
use App\Html\Form;
use App\Model\User;
use App\Tables\UserTable;
$form = new Form($_POST);
$title = "Inscription";

$masque = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";

if(!empty($_POST)){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user = new User();
    if(isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])){
        $user->setFirstname($firstname)
             ->setLastname($lastname)
             ->setCountry($country)
             ->setPassword($password)
             ->setEmail($email);

        if(strlen($password) < 8){
            $message =  <<<HTML
            <div class="register-error">
                <p>Mot de passe trop court</p>
            </div>
HTML;
        }if(!(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($masque, $email))){
            $message =  <<<HTML
            <div class="register-error">
                <p>Email invalide</p>
            </div>
HTML;
        }
        else{

            try{
                $usertable = new UserTable(Connect::getPDO());
                $message = $usertable->register($user);
                session_start();
                $_SESSION['auth'] = $user->getFirstname() . '_' . $user->getLastname();
                header('Location: ' . $router->url('home'));
                exit();
            }catch (Exception $e){
                echo "Erreur : ". $e->getMessage(). "<br/>";
            }
        }
    }
}

?>

<?php if(Auth::checkConnected() === true) : ?>
            <h1 class="logged-text">Pas besoin ! vous etes deja inscrits</h1>
<?php else : ?>
<div class="body-form">
    <?= $message ?? '' ?>
    <form class="auth-form" name="myForm" action="<?= $router->url('inscription') ?>" onsubmit="return validateForm()"  method="POST">
        <p id="inscription-header">Inscription</p>
        <div class="form-field">
            <?= $form->input('firstname', 'nom') ?>
            <?= $form->input('lastname', 'prenom') ?>
            <?= $form->input('email', 'adresse email') ?>
            <?= $form->input('password', 'mot de passe') ?>
            <div class="check-password" style="color: blue;">
                <?= $form->checkbox('see-password') ?>
            </div>
            <p id="select-legend">Selectionnez votre pays</p>
            <?= $form->select('country') ?>
        </div>
        <div class="register-send">
            <p><button type="submit" id="register">S'inscrire</button></p>
        </div>
    </form>
</div>
<?php endif ?>
<script>
let password = document.getElementById("field-password");
let form = document.getElementsByClassName("auth-form")[0];
let p = document.createElement("p");
p.innerText = "Mot de passe trop court(minimun 8 caracteres)"
p.classList.add("password-test");
password.addEventListener("input", () => {
  //alert("ecriture");
    if(password.value.length < 8) {
      form.appendChild(p);
    }else{
      form.removeChild(p);
    } 
})

checkPassword = document.getElementById("see-password");
checkPassword.addEventListener("click", () => {
    if(checkPassword.checked === true){
      password.type = "text";
    }else{
      password.type = "password";
    }
})
</script>