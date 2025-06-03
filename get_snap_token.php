<?php
header('Content-Type: application/json');
require_once 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-037y4EYaXZzwCcd319T1oKiS';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$raw_input = file_get_contents("php://input");
$data = json_decode($raw_input, true);

$total = isset($data['total']) ? (int)$data['total'] : 10000;
$cart = isset($data['cart']) ? $data['cart'] : [];

$order_id = 'ORDER-' . uniqid();

$params = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $total,
    ],
    'item_details' => [],
    'customer_details' => [
        'first_name' => 'Pembeli',
        'email' => 'pembeli@example.com',
        'phone' => '081234567890',
    ]
];  

foreach ($cart as $item) {
    $params['item_details'][] = [
        'id' => $item['id'],
        'price' => $item['price'],
        'quantity' => $item['qty'],
        'name' => substr($item['name'], 0, 50),
    ];
}

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    error_log("Midtrans Snap Error: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}
