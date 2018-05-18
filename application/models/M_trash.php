<?php 
class M_trash extends CI_Model {

	public function get_trash()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/trash/?limit=500&offset=0&order_by=name",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return $data['error']="cURL Error #:" . $err;
		} else {
			$result=json_decode($response,true);
			return $result;
		}
	}

	public function restore($param)
	{
		echo json_encode($param);
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL=>url_cloudike."/trash/restore/".$param['name'],
			CURLOPT_RETURNTRANSFER=> 1,
			CURLOPT_POSTFIELDS=>json_encode($param,JSON_UNESCAPED_SLASHES ),
			CURLOPT_POST=>1,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth:".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// $result =json_decode($response,true);
			// $url=$result['location'];
			// $this->get_task($url);
			echo $response;
		}
	}

	public function empty_trash()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL=>url_cloudike."/trash/clear/",
			CURLOPT_RETURNTRANSFER=> 1,
			CURLOPT_POST=>1,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth:".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// $result =json_decode($response,true);
			// $url=$result['location'];
			// $this->get_task($url);
			echo $response;
		}
	}


	public function get_task($url='')
	{
		$curl = curl_init();
		$url=utf8_encode($url);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"mountbit-auth: 1f7b53df83f0497bad42e8c1e7283aaa"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$task=file_get_contents($url.'/result');
			$result =json_decode($task,true);
			redirect($result['url']);
		}
	}

}