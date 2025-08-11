<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "No SignIn/LogIn Found";
    exit;
}

if (!isset($_COOKIE['quote'])) {
    require 'config.php';
    $api_key = $config['QUOTES_API_KEY'];
    $url = "https://api.api-ninjas.com/v1/quotes";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Api-Key: $api_key"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);
    $quote = $data[0]['quote'] . " —" . $data[0]['author'];

    setcookie("quote", $quote , time() + 3600, "/");
}
?>
