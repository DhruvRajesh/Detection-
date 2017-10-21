<?php
session_start();

$try = $_POST["uploadText"];
$selectedLanguage = $_POST["Lang"];
//echo $try; '<br>';
echo $selectedLanguage;

// When you have your own client ID and secret, put them down here:
/*
$CLIENT_ID = "FREE_TRIAL_ACCOUNT";
$CLIENT_SECRET = "PUBLIC_SECRET";
// Specify your translation requirements here:
$postData = array(
  'fromLang' => "en",
  'toLang' => "fr",
  'text' => $try
);
$headers = array(
  'Content-Type: application/json',
  'X-WM-CLIENT-ID: '.$CLIENT_ID,
  'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
);
$url = 'http://api.whatsmate.net/v1/translation/translate';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);
//echo "Response: ".$response;
curl_close($ch);
?>*/


    $apiKey = 'AIzaSyDfMkT0d51FQWPStdbPu761aJhfyZeJeGI';
    $text = $try;
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$selectedLanguage;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);
   // $textInfo="";
    //echo 'Source: ' . $text . '<br>';
    $textInfo =  $responseDecoded['data']['translations'][0]['translatedText'];
    $_SESSION['information']=$textInfo;
    $_SESSION['language']=$selectedLanguage;
    header('Location: http://localhost/detection/trial1.php')
    //echo $textInfo;
    //echo 'Translation: ' . $responseDecoded['data']['translations'][0]['translatedText'];
 ?>
