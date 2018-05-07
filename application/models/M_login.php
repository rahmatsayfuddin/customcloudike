<?php 
class M_login extends CI_Model {

	public function do_login($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/login/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param),
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$result=json_decode($response,true);
			if(isset($result['code']))
			{
				$result['message']='error';
				return $result;
			}
			else{
				$result['message']='sukses';
				return $result;
			}
		}

	}

}