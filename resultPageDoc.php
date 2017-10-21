
<?php
//starting session to display all results
	session_start();

// copyleaks api & email
$email = 'dhruv140701@gmail.com';
$apiKey = '0C8D8848-9899-45CC-948D-19BA2F0849D6';

//dependencies and autoload
include_once( getcwd().'/autoload.php');
use Copyleaks\CopyleaksCloud;
use Copyleaks\CopyleaksProcess;



/* CREATE CONFIG INSTANCE */
$config = new \ReflectionClass('Copyleaks\Config');
$clConst = $config->getConstants();

/* 
	CONSTRUCT ACCEPTS 1 PARAMETER (type of product).

	ACCEPTED TYPES: 
	1. publisher 
	2. academy

	CONFIG HAS CONSTANTS FOR ACCEPTED TYPES:
	1. $clConst['E_PRODUCT']['PUBLISHER']
	2. $clConst['E_PRODUCT']['ACADEMY']

	DEFAULT:
	publisher
*/
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
								$clConst['PARTIAL_SCAN_HEADER']
								);

	// recieving information from createID & createDocID
	$hold = $_SESSION['data'];
	$t = $_SESSION['time'];

	// creating a proccess to be displayed 
	$oldProcess = new CopyleaksProcess($hold,$t,$clCloud->loginToken->authHeader(),$clConst['E_PRODUCT']['PUBLISHER']);

	//print_r($process->getStatus()); //get process status
	//print_r($oldProcess->getResult()); //get process results
	// print_r($oldProcess->getResult()); 
	// print_r($createFileProcess); //print createByFile response


	
	//DELETE process example
	// echo '<Br/>delete process';
	//$deleteProcess = $process->delete();
	 //print_r($deleteProcess);

	//get processes list
	//$plist = $clCloud->getProcessList();
	// printing result for user
	 $plist = $oldProcess->getResult();
	// print_r($plist);
	



	//get OCR's supported languages
	$ocrSupportedLanguages = $clCloud->getOCRLanguages();
	// print_r($ocrSupportedLanguages);
	
}catch(Exception $e){

	echo "<br/>Caught exception: ". $e->getMessage();
}

//build table from PHP array
function build_table($array){
    // start table
    //custom class container for table
    $html = '<table width=100% class="container"';
	
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
    	if($key == "Percents" || $key=="NumberOfCopiedWords" || $key == "EmbededComparison"){
            $html .= '<th align=left >' . $key . '</th>';
    	}
    	if($key=="URL"){
    		$html .= '<th align=center >' . $key . '</th>';
    	}
       }
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
        	if($key2=="URL"){
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
        		  $html .= '<td align=center>' . @$value2 . '</td>';
        	}
        	if($key2 == "Percents" || $key2=="NumberOfCopiedWords" ){
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
          		$html .= '<td align=center>' . @$value2 . '</td>';
        	}
        	if($key2=="EmbededComparison"){
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
        		//$html .='<a href='.@$value2.'>click link to see results</a>'; 
        		$html .= '<td align=left><a href='.@$value2.' target=_blank >click link to see results</a></td>';
        	}
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

<!-- Creating a custom table to display results-->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

 <link rel="stylesheet"  href="css/tableStyle.css">

</body>
</html>


