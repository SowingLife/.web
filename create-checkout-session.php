<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51Hc0h9IvCkPX15YkXjG6KahJFRv0TcSAvpJpeRHTdX7ZpItDHoW5Gsx5F5QLpsYrRxaSw0JrBsxIcFpQh2mIOAP200pERFhdwv');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'pen',
      'product_data' => [
        'name' => 'Compra en mi tienda',
      ],
      'unit_amount' => $data->amount,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

echo json_encode(['id' => $checkout_session->id]);
