<!-- 
     The API used in this page is created by COPYLEAKS. 
-->
<!--
  The API has not been created Dhurv Tekchandani (5302109)
  The contents insde the API has been modified to match the desired output for the assignment.
-->



<?php
session_start();

// getting selected language from user
 $selectedLanguage = $_POST["Lang"];

// assigning selected language to code
$copyLeakLang="";
if($selectedLanguage=="ru"){
	$copyLeakLang="rus";
}
else if($selectedLanguage=="de"){
	$copyLeakLang="deu";
}
else if($selectedLanguage=="pt"){
	$copyLeakLang="por";
}
else if($selectedLanguage=="hi"){
	$copyLeakLang="hin";
}
else if($selectedLanguage=="ko"){
	$copyLeakLang="kor";
}
else if($selectedLanguage=="sv"){
	$copyLeakLang="swe";
}
else if($selectedLanguage=="he"){
	$copyLeakLang="heb";
}
else if($selectedLanguage=="fr"){
	$copyLeakLang="fra";
}
else if($selectedLanguage=="es"){
	$copyLeakLang="spa";
}
else if($selectedLanguage=="ja"){
	$copyLeakLang="jpn";
}
else if($selectedLanguage=="it"){
	$copyLeakLang="ita";
}
else if($selectedLanguage=="en"){
	$copyLeakLang="eng";
}

//error checking
echo "This is the selected language".$selectedLanguage;
// recieving text uploaded by the user
$try = $_POST["uploadText"];

/*

if(strlen($try)<=50){
	header("http://localhost/detection/cognac.html");
	exit();
}
*/
// google api key
//using google api to translate the language from the text
 $apiKey = 'AIzaSyB2cKr2KUqVHlojHZGMuwb7GboHk909Y6c';
    $text = $try;
    if($selectedLanguage!="en"){
    	$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$selectedLanguage;
  

    	$handle = curl_init($url);
    	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($handle);                 
    	$responseDecoded = json_decode($response, true);
    	curl_close($handle);

    	$textInfo =  $responseDecoded['data']['translations'][0]['translatedText'];
	}
	else
    	$textInfo = $try;	


// copyleaks API and email ID
    // generate new api key before running this 
$email = 'drajeshtek@gmail.com';
// chnage key after every 48 hours 
$apiKey = 'A5E5421F-0DB9-4CB5-AA62-6DEB54E32C9D';

//dependencies and autoload
include_once( getcwd().'/autoload.php');
use Copyleaks\CopyleaksCloud;
use Copyleaks\CopyleaksProcess;



/* CREATE CONFIG INSTANCE */
$config = new \ReflectionClass('Copyleaks\Config');
$clConst = $config->getConstants();

$clCloud = new CopyleaksCloud($clConst['E_PRODUCT']['PUBLISHER']);

//LOGIN
try{
	$response = $clCloud->login($email, $apiKey);	
}catch(Exception $e){
	echo "<Br/>Caught exception: ". $e->getMessage();
	die();
}


//validate login token
if(!isset($clCloud->loginToken) || !$clCloud->loginToken->validate()){ 
	echo "<Br/>FALSE LOGIN CREDS";
	die();
}

$plist=array();
$token = $clCloud->loginToken->token; //get login token
$creditBalance = $clCloud->getCreditBalance(); //get credit balance
// print_r($creditBalance);

//create by document file type or OCR
try{
	//All possible additional headers - only for CreateByFile \ CreateByOCR \ CreateByURL
	$additionalHeaders = array(
								//$clConst['SANDBOX_MODE_HEADER'], // Comment this line in production (leave sandbox mode)
								$clConst['ACCEPTED_LANGUAGE_HEADER'].': '.$copyLeakLang,
								$clConst['PARTIAL_SCAN_HEADER']
								);
	 //creating the process by text
	$process  = $clCloud->createByText($textInfo,$additionalHeaders);

		
	// creating a new proccess ID for the text submitted by user
	$process = new CopyleaksProcess($process['response']['ProcessId'],
		$process['response']['CreationTimeUTC'],
		$clCloud->loginToken->authHeader(),
		$clConst['E_PRODUCT']['PUBLISHER']);

	echo "<BR/> Process created! (PID = '" . $process->processId . "')";

	// storing variables 
	$send = $process->processId;
	$time = $process->creationTime;
	
	// sending data using session over PHP files
	$_SESSION['data']=$send;
	$_SESSION['time']=$time;

	// re-directing website link
	header('Location: http://localhost/detection/textResultPage.php');



	//get processes list
	$plist = $clCloud->getProcessList();

	
}catch(Exception $e){

	echo "<br/>Caught exception: ". $e->getMessage();
}

//build table from PHP array
function build_table($array){
    // start table
    $html = '<table width=100%>';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
    	
            $html .= '<th>' . $key . '</th>';
    	}
       
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
        	$value2 = is_array($value2) ? json_encode($value2) : $value2;
          $html .= '<td align=center>' . @$value2 . '</td>';
        		
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

//print process list as HTML table
if(isset($plist,$plist['response']) && count($plist['response'])>0)
	echo build_table($plist['response']);
?>

