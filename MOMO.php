<?php
// https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?idbouton=2&typebouton=PAIE&_amount=10&_tel=675779816&_clP=&_email=jessicatcheyanou%40gmail.com&submit.x=152&submit.y=30
function get_data($url){
  $ch = curl_init();
  $timeout = 60;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);


  $data = curl_exec($ch);
  // curl_close ($ch);

  return $data;
}

$amount = $_POST['amount'];
$number = $_POST['tel'];

$momoLink = "https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml?idbouton=2&typebouton=PAIE&_amount=".$amount."&_tel=".$number."&_clP=&_email=jessicatcheyanou%40gmail.com&submit.x=152&submit.y=30";

$returned_momo_info = get_data($momoLink);

// echo $returned_momo_info;

$sampleJSON = ' {
  "SenderNumber":"'.$number.'",
  "Amount":'.$amount.'
}';

//convert retrne json data to PHP $arrayName = array('' => , );
$phparray = json_decode($returned_momo_info);

// $phparray = json_decode($sampleJSON, true);

// foreach($phparray as $keyval => $value){
//   echo $keyval.": ".$value."<br/>";
// }

header("location:index.php?amount=".$phparray['Amount']."&number=".$phparray['SenderNumber']);

?>
