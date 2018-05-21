<?php 
class M_home extends CI_Model {

	public function get_list($param='')
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/metadata/".$param."?limit=500&offset=0&order_by=name",
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
			if (isset($result['content'])) {
				return $result;
			}
		}
	}

	public function get_search($param='')
	{

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/files/search/?limit=500&offset=0&order_by=name&".$param,
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
			if (isset($result['content'])) {
				return $result;
			}
		}
	}

	public function download($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/files/get/".$param,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"mountbit-auth:".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$result =json_decode($response,true);
			redirect($result['url']);
		}
	}

	public function multiple_download($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL=>url_cloudike."/files/download_as_archive/",
			CURLOPT_RETURNTRANSFER=> 1,
			CURLOPT_POSTFIELDS=>json_encode($param,JSON_UNESCAPED_SLASHES ),
			CURLOPT_POST=>1,
			CURLOPT_ENCODING=> 'gzip, deflate',
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
			$result =json_decode($response,true);
			//echo $task=file_get_contents($result['location'].'/result');
			$url=$result['location'];
			//echo var_dump($url);
			//$url='https://saas.cloudike.com/api/2/task/035f5227-2441-4a20-a216-5fab532b9452/result';
			//echo var_dump($url);
			$this->get_task($url);
			//echo $response;
			//echo json_encode($task);
			//redirect($task['url']);
		}
	}

	public function delete($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL=>url_cloudike."/fileops/multi/delete/",
			CURLOPT_RETURNTRANSFER=> 1,
			CURLOPT_POSTFIELDS=>json_encode($param,JSON_UNESCAPED_SLASHES ),
			CURLOPT_POST=>1,
			CURLOPT_ENCODING=> 'gzip, deflate',
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
		//	$result =json_decode($response,true);
			//echo $response;
			//echo $task=file_get_contents($result['location'].'/result');
			//$url=$result['location'];
			//echo var_dump($url);
			//$url='https://saas.cloudike.com/api/2/task/035f5227-2441-4a20-a216-5fab532b9452/result';
			//echo var_dump($url);
			//$this->get_task($url);
			//echo $response;
			//echo json_encode($task);
			//redirect($task['url']);
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
			//echo $response;
		}
	}

	public function rename($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/fileops/rename/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			return $result =json_decode($response,true);
			//echo $response;
		}
	}

	public function create_folder($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, 	array(
			CURLOPT_URL => url_cloudike."/fileops/folder_create/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			return $result =json_decode($response,true);
		}
	}

	public function prepare_share($param)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/metadata/skv/?listing=0",
			//url_cloudike."/metadata/".$param."?listing=0",
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

	public function create_link($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, 	array(
			CURLOPT_URL => url_cloudike."/links/create/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			//return $result =json_decode($response,true);
			echo $response;
		}
	}

	public function others_create_link($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, 	array(
			CURLOPT_URL => url_cloudike."/shares/add/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			//return $result =json_decode($response,true);
			echo $response;
		}
	}

	public function delete_link($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, 	array(
			CURLOPT_URL => url_cloudike."/links/delete/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			//return $result =json_decode($response,true);
			echo $response;
		}
	}

	public function others_delete_link($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, 	array(
			CURLOPT_URL => url_cloudike."/shares/unshare/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			//return $result =json_decode($response,true);
			echo $response;
		}
	}

	public function move($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/fileops/copy/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			return $result =json_decode($response,true);
			//echo $response;
		}
	}

	public function copy($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/fileops/move/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param,JSON_UNESCAPED_SLASHES ),
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
			return $result =json_decode($response,true);
			//echo $response;
		}
	}

}