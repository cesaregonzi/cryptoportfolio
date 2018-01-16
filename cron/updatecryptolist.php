<?php

function getCoinMarketCapData($url) {

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
	    $info = curl_getinfo($curl);
	    curl_close($curl);
	    die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	else {
		curl_close($curl);
		return $curl_response;
	}

}

function updatecryptolist() {

	//Use COINMARKETCAP API
	include "../connect.php";

	$CoinMarketCap = "https://api.coinmarketcap.com/v1/ticker/?limit=0";
	$retrieveData = json_decode(getCoinMarketCapData($CoinMarketCap));
	//print_r($retrieveData);
	$i = 1;
	foreach ($retrieveData as $key) {
		
		$name = $key->name;
		$symbol = $key->symbol;
		$priceusd = $key->price_usd;
		$pricebtc = $key->price_btc;

		mysqli_query($mysqli,"UPDATE cryptolist SET lastusd=$priceusd, lastbtc=$pricebtc WHERE name='$name'");

		$i++;
	}

}

updatecryptolist();

?>