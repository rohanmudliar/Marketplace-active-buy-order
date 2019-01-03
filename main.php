<?php error_reporting(0);

 $opts = array(
   'http' => array(
     'method' => "GET",
     'header' => "Content-Type: application/json\r\n".
                 "Accept: application/json\r\n",
     'ignore_errors' => true
   ),
   // VVVVV   The extra config that fixed it
   'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
   )
   // ^^^^^
 );
 $context = stream_context_create($opts);
 $htmlContent = file_get_contents('https://marketplace.tf/items/1071;11;kt-3/Professional%20Strange%20Golden%20Frying%20Pan', false, $context);

$aDataTableHeaderHTML=[];


// $htmlContent = file_get_contents($url, false, stream_context_create($arrContextOptions));

    // $htmlContent = file_get_contents("https://marketplace.tf/items/1071;11;kt-3/Professional%20Strange%20Golden%20Frying%20Pan");
    
    $pageArray = explode('<th width="50%">Amount</th>', $htmlContent);
    
    $secondArray = explode('<div class="panel-heading">Sales Stats</div>', $pageArray[1]);
     $value= $secondArray[0];
		
	$DOM = new DOMDocument();
	$DOM->loadHTML($value);
	
	$Detail = $DOM->getElementsByTagName('td');

    //#Get header name of the table
	foreach($Detail as $NodeHeader) 
	{
		$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
    }
    
    // print_r($aDataTableHeaderHTML);

    $answer;

	for ($i=0; $i<=11; $i++) {
        if($i%2==0) {
            $answer = $answer.$aDataTableHeaderHTML[$i];
        } else {
            $answer = $answer."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$aDataTableHeaderHTML[$i]."<br>";
        }
    }
?>
