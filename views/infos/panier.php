<?php

use App\Actions;
use App\PaginQuery;
use App\PaypalPayment;
use App\StripePayment;
$title = "Panier";
$articles = PaginQuery::getBasket(Actions::backUserId());
$table = json_encode($articles);
$somme = 0;
$n = 0;

?>
<div id="body-basket">
    <h1 id="h1-panier" style="color:green;">Votre panier</h1>

    <table id="panier">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantite</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article):?>
                <?php $n++ ?>
                <tr id="line-<?= $n ?>">
                    <td class="infos-product"><img class="img-basket" src="<?= $article['path'] ?>" alt="article image"> <p style="margin-left:20px;"><?= $article['name'] ?></p></td>
                    <td><?= $article['qte'] ?></td>
                    <td style="color:green;"><?= $article['prix'] ?>€</td>
                    <td class="col-total-price" style="color:green;"><?= $article['prix'] * $article['qte']?>€</td>
                    <td><input type="button" class="delete-basket"  data-line_id="#line-<?= $n ?>" data-post_id="<?= $article['id'] ?>" data-total="<?= $article['prix'] * $article['qte']?>" data-post_qte="<?= $article['qte']?>" Value="Retirer"></td>
                </tr>
                <?php $somme += $article['prix'] * $article['qte'] ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td id="sum-basket">Somme</td>
                <td class="col-total-price" style="color:green;" id="sum-basket-value"><?= $somme ?>€</td>
            </tr>
        </tfoot>
    </table>
    <h2 id="paypal-checkout">Proceder au paiement</h2>
    
        <a id="stripe-button-link" href="<?= $router->url('stripe-payment') ?>">
        <div class="stripe-button">Payer</div>
        </a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript">
    
    $('.delete-basket').click(function(){
        <?php $articles = PaginQuery::getBasket(Actions::backUserId());
              $table = json_encode($articles);
        ?>
        var button = $(this);
        //alert(button.data('line_id'));
        var td_sum = $('.col-total-price');
        var sum = <?= $somme ?>;
        //alert(sum);
        //alert(button.data('total'));
        var new_s = parseFloat(sum) - parseFloat(button.data('total'));
        var new_sum =new_s.toFixed(2);
        //alert(new_sum);
        td_sum.text(new_sum.toString() + '€');
        $('#basket-value-content').text(new_sum.toString() + '€');
        var data = {
            id: $(this).data('post_id'),
            user_id: <?= Actions::backUserId() ?>,
            qte: $(this).data('post_qte'),
            status: 'remouve_basket'
        };
        $.ajax({
            url: '<?= $router->url('action_basket')?>',
            type: "POST",
            data: data,
            success : function(res){
                console.log(res);
                //alert('suppression reussie');
                $(button.data('line_id')).remove();

            }
        });
    });

</script>


