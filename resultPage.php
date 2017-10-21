<!--This API has been created by COPYLEAKS
  The API has not been created Dhurv Tekchandani (5302109)
  The contents insde the API has been modified to match the desired output for the assignment.
-->


<?php
//starting session to display all results
	session_start();

// copyleaks api & email
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
								$clConst['PARTIAL_SCAN_HEADER']
								);

	// recieving information from createID & createDocID
	$hold = $_SESSION['data'];
	$t = $_SESSION['time'];

	// creating a proccess to be displayed 
	$oldProcess = new CopyleaksProcess($hold,$t,$clCloud->loginToken->authHeader(),$clConst['E_PRODUCT']['PUBLISHER']);

	
	// printing result for user
	 $plist = $oldProcess->getResult();
	
}catch(Exception $e){

	echo "<br/>Caught exception: ". $e->getMessage();
}
$urlKey="";
 $numberOfCopedWordsKey="";
 $percentsKey="";
 $embededComparisonKey="";
 $check="";
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
        	//choosing appropriate keys selected from api
        	if($key2=="URL"){
        		$check="true";
        		
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
        		  $html .= '<td align=center>' . @$value2 . '</td>';
        		  $urlKey=$value2;
        	}
        	if($key2 == "Percents" ){
        		
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
          		$html .= '<td align=center>' . @$value2 . '</td>';
          		$percentsKey=$value2;
        	}

        	if($key2=="NumberOfCopiedWords" ){
        		
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
          		$html .= '<td align=center>' . @$value2 . '</td>';
          		$numberOfCopedWordsKey=$value2;
        	}

        	if($key2=="EmbededComparison"){
        		$value2 = is_array($value2) ? json_encode($value2) : $value2;
        		$embededComparisonKey=$value2;
        		
        		//$html .='<a href='.@$value2.'>click link to see results</a>'; 
        		$html .= '<td align=left><a href='.@$value2.' target=_blank >click link to see results</a></td>';
        		
        	}
        }
        // inserting data in database 
        $html .= '</tr>';
         if($check=="true"){
			$uID = $_SESSION['u_id'];
			$docID = $_SESSION['docID'];
			//conncecting to database
    		$conn = mysqli_connect("localhost","root","","loginSystem");
    		$sql = "INSERT INTO userHistory (userID,docID,URL,Percents,NumberOfCopiedWords,EmbededComparisons) VALUES ('$uID','$docID','$urlKey','$percentsKey','$numberOfCopedWordsKey','$embededComparisonKey')";
    		mysqli_query($conn,$sql);
			}
    }

    // finish table and return it

    $html .= '</table>';
    $conn->close();
 
    return $html;
}

//print process list as HTML table
if(isset($plist,$plist['response']) && count($plist['response'])>0)
	echo build_table($plist['response']);
else{
	 echo "<h3 align=center>Please wait as we are currently searching for results</h3>";
    echo " <script>
  			setTimeout(function(){
    			window.location.href=window.location;
 			 }, 5000);
		</script>";
}

?>

<!-- Creating a custom table to display results-->
<!DOCTYPE html>
<html>
<body>
<!--
    This table has been created by This table is product of  Pablo García 
    (https://codepen.io/PableraShow/pen/qdIsm) 
-->
 <link rel="stylesheet"  href="css/tableStyle.css">

</body>
</html>


