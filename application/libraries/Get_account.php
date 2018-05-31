<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_account {
	public function get()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/get",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"mountbit-auth:".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$result=json_decode($response,true);
			return $result;
		}
	}
}