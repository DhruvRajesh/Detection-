<!-- 
     The API used in this page is created by COPYLEAKS. 
-->
<!--
  The API has not been created Dhurv Tekchandani (5302109)
  The contents insde the API has been modified to match the desired output for the assignment.
-->

<?php

session_start();
//redirecting web page
header('Location: http://localhost/detection/resultPage.php');

// getting data from the user selection
$img = $_POST["image"];
//echo $img;

// checking for file extension
$check ="";
$file_parts = pathinfo($img);
$uID = $_SESSION['u_id'];

if(isset($_POST['Submit'])){

	
	echo "image: ".$img;
	//$uID = $_SESSION['u_id'];
	echo $uID;

	$conn = mysqli_connect("localhost","root","","loginSystem");
     
  
     	
     $sql="INSERT INTO documents (documentName,userID) VALUES ('$img','$uID')";
     mysqli_query($conn,$sql);
      $check = "true";
      
     if(empty($errors)==true){
        //move_uploaded_file($file_tmp,"images/".$file_name);
        echo "Success";
     }else{
        print_r($errors);
     }
     $conn->close();
}

echo $check;
echo "<br>";



if($check=="true"){
	$conn = mysqli_connect("localhost","root","","loginSystem");
	$sqlDocID = "SELECT docID, documentName, userID FROM documents WHERE userID = '$uID'";
	//$sqlUserID = "SELECT user_id from users";

	$result = mysqli_query($conn,$sqlDocID);

	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			echo "id: ".$row["docID"]. " Document name: ".$row["documentName"]." User ID: ".$row["userID"]. "<br>";
			$_SESSION['docID'] = $row['docID'];
		}
	}
	else {
		echo "000";
	}
	$conn->close();
}

	
	

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

// google api key
 $apiKey = 'AIzaSyB2cKr2KUqVHlojHZGMuwb7GboHk909Y6c';

 $textInfo="";

 // checking which document type is uploaded
if($file_parts['extension']=="pdf"){
	 
	// outsourced PDF to TXT converter
	include('pdf2text.php');
	$a = new PDF2Text();
	$a->setFilename($img); 
	$a->decodePDF();
	$text = $a->output(); 
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$selectedLanguage;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    $textInfo= $responseDecoded['data']['translations'][0]['translatedText'];
   // echo $textInfo;
	

}else if($file_parts['extension']=="txt"){

	 $trial = file_get_contents($img);
	$text = $trial; 
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$selectedLanguage;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    $textInfo= $responseDecoded['data']['translations'][0]['translatedText'];
   // echo $textInfo;
}else if($file_parts['extension']=="docx" || $file_parts['extension']=="doc"){

	 // outsourced DOCX || DOC to txt converter
	 require("doc2txt.class.php");
	 $docObj = new Doc2Txt($img);
	 $txt = $docObj->convertToText();

	$text = $txt; 
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$selectedLanguage;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    $textInfo= $responseDecoded['data']['translations'][0]['translatedText'];
}



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

								// sending the langauge to the copy leaks api
								$clConst['ACCEPTED_LANGUAGE_HEADER'].': '.$copyLeakLang,
								$clConst['PARTIAL_SCAN_HEADER']
								);

	
	//creating the process by text
	$process  = $clCloud->createByText($textInfo,$additionalHeaders);

	// creating a proccess ID for the document 
	$process = new CopyleaksProcess($process['response']['ProcessId'],
		$process['response']['CreationTimeUTC'],
		$clCloud->loginToken->authHeader(),
		$clConst['E_PRODUCT']['PUBLISHER']);

	echo "<BR/> Process created! (PID = '" . $process->processId . "')";

	// proccessing & storing information that is created
	$send = $process->processId;
	$time = $process->creationTime;
	
	// sending data across pages using sessions 
	$_SESSION['data']=$send;
	$_SESSION['time']=$time;



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

