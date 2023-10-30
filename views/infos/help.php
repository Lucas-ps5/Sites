<?php
$problems = ['probleme de paiement', 'probleme de connexion', 'autre'];
$problems_buy = ["ma carte n'est pas prise en charge", "l'achat n'est pas valide"];
$problems_connect = ["mon compte a ete supprime", "je n'ai plus acces a mon compte", "j'ai oublie mon mot de passe"];
// var_dump($_GET);
$title = "Aide";
?>

<h1 id="h1-help">Espace dedie aux clients ayants des soucis avec notre site </h1>

<form class="form-help" action="" method="GET">
<?php if(!isset($_GET['choix']) && !isset($_GET['probleme'])) : ?>
    <div class="form-group-choice" >
        <fieldset class="field-choice">
            <legend>rencontrez-vous un probleme sur ce site ?</legend>
                <ul>
                    <li>
                        <label for="yes">
                        <input type="radio" id="yes" name="choix" value="Oui">
                        Oui
                        </label>
                    </li>
                    <li>
                        <label for="no">
                        <input type="radio" id="no" name="choix" value="Non">
                        Non
                        </label>
                    </li>
                </ul>
        </fieldset>
    </div>
<?php elseif(isset($_GET['choix']) && $_GET['choix'] === 'Oui') : ?>
    <div class="form-group-choice">
        <section class="section-choice">
            <legend>Selectionnez votre probleme ici</legend>
            <?php foreach($problems as $key => $pb) : ?>
                <p class="check-choice"><input type="checkbox" name="probleme[]" value="<?= $pb ?>"><?= $pb?></p>
            <?php endforeach ?>
        </section>
    </div>
    <?php endif ?>
    <?php if(isset($_GET['probleme'])) : ?>
        <?php if(in_array('probleme de paiement', $_GET['probleme'])) : ?>
            <div class="form-group-choice">
            <section class="section-choice">
                <legend>Selectionnez le probleme de paiement</legend>
                    <?php foreach($problems_buy as $pb) : ?>
                        <p class="check-choice"><input type="checkbox" name="problem_buy[]" value="<?= $pb ?>"><?= $pb?></p>
                    <?php endforeach ?>
            </section>
            </div>
        <?php endif ?>
    <?php if(in_array('probleme de connexion', $_GET['probleme'])) : ?>
            <div class="form-group-choice">
            <section class="section-choice">
                <legend>Selectionnez votre probleme de connexion</legend>
                    <?php foreach($problems_connect as $pb) : ?>
                        <p class="check-choice"><input type="checkbox" name="problem_connect[]" value="<?= $pb ?>"><?= $pb?></p>
                    <?php endforeach ?>
            </section>
            </div>
        <?php endif ?>
        <?php if(in_array('autre', $_GET['probleme'])) : ?>
            <div class="form-group-edit">
                <p class="section-edit">Veuillez formuler votre probleme</p>
                <textarea required placeholder="Ecivez votre probleme ici..."></textarea>
            </div>
        <?php endif ?>
    <?php endif ?>
    <div class="submit-choice">
        <p><button type="submit" id="send-choice">Suivant</button></p>
    </div>
</form>