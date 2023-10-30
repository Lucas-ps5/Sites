<?php

namespace App;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripePayment {

    
    private string $secret_key;
    private string $public_key;
    private $sesion_ID;

    private $endpoint_secret;
    public function __construct(string $secret_key, string $endpoint_secret)
    {
        $this->secret_key = $secret_key;
        $this->endpoint_secret = $endpoint_secret;
        Stripe::setApiKey($this->secret_key);
        //Stripe::setApiVersion('2020-08-27');
    }

    public function startPayment()
    {
      session_start();
      $_SESSION['payment'] = 'Payment_started';
        $cart = PaginQuery::getBasket(Actions::backUserId());
        $session = Session::create([
            'line_items' => [
                array_map(function(array $product){
                    return [
                        'quantity' => $product['qte'],
                        'price_data' => [
                            'currency' => 'EUR',
                            'product_data' => [
                                'name' => $product['name']
                            ],
                            'unit_amount' => $product['prix'] * 100
                        ]
                        ];
                }, $cart)
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/paiement_success',
            'cancel_url' => 'http://localhost:8000/',
            
        ]);
        $this->sesion_ID = $session->id;
        header("HTTP/1.1 303 See Other");
        header("Location: " . $session->url);
    }

    public function handle()
    {
      $payload = @file_get_contents('php://input');
      $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
      $event = null;
      
      try {
        $event = \Stripe\Webhook::constructEvent(
          $payload, $sig_header, $this->endpoint_secret
        );
      } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
      } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
      }
      
      function fulfill_order($line_items) {
        // TODO: fill me in
        error_log("Fulfilling order...");
        error_log($line_items);
      }
      
      // Handle the checkout.session.completed event
      if ($event->type == 'checkout.session.completed') {
        // Retrieve the session. If you require line items in the response, you may include them by expanding line_items.
        $session = Session::retrieve([
          'id' => $event->data->object->id,
          'expand' => ['line_items'],
        ]);
      
        $line_items = $session->line_items;
        // Fulfill the purchase...
        fulfill_order($line_items);
        $this->savePayment();
      }
      
      http_response_code(200);
    }

    public function savePayment()
    { 
        $dateTime = new \DateTime();
        $date = $dateTime->format('Y-m-d H:i:s');
        $id_client = Actions::backUserId();
        $amount = Actions::get_sum_basket();

        try{
          $pdo = Connect::getPDO();
          $query = $pdo->prepare("INSERT INTO payments SET id_client = :id_client, amount = :amount, date = :the_date");
            $ok = $query->execute([
                'id_client' => $id_client,
                'amount' => $amount,
                'the_date' => $date
            ]);
        }catch(\PDOException $e){
            echo $e;
        }
    }

    
}