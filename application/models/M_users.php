<?php 
class M_users extends CI_Model {


	public function get()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/get/?storage_stat=true",
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

	public function get_order()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://saas.cloudike.com/provisioning-api/0/users/".$_SESSION['userid']."/orders/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}





	public function change_profile($param)
	{
		$arrayparam = json_decode('{
			"features": {
				"billing": true
				},
				"trash_size": 128418216,
				"last_activity": 1527219457165,
				"timezone": "Europe/Moscow",
				"is_approved": true,
				"upload_photo_directory": "/My photos",
				"last_login": 1527217330843,
				"family_user_id": 0,
				"role": "user",
				"overhead_size": 0,
				"quota_owner_id": 0,
				"logins": [
				"email:sayrahmat41@gmail.com",
				"contacts_sync:sayrahmat41.gmail.com"
				],
				"registration_date": 1521706154460,
				"is_active": true,
				"storage_size": 464784,
				"hard_quota_size": 53687091200,
				"deleted_date": 0,
				"lang": "en",
				"name": "Rahmat",
				"region": "",
				"userid": 10507,
				"quota_size": 53687091200,
				"balance": "n/a",
				"password": ""
			}',true);

		$arrayparam['name']=$param['display_name'];
		$arrayparam['password']=$param['password'];
		$arrayparam['lang']=$param['lang'];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/change_profile/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($arrayparam),
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
			echo $response;
		}
	}

	public function redeem_code($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL =>"https://saas.cloudike.com/provisioning-api/0/users/".$_SESSION['userid']."/promocodes/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param),
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
			return $result =  json_decode($response,true);
		}
	}


	public function get_activity_log($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/events/?".http_build_query($param),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}
	public function get_basic_auth()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/get_basic_auth/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}

	public function remove_login($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/remove_login/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param),
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}

	public function create_basic_auth($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/create_basic_auth/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param),
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}


	public function get_contacts_sync_auth()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/get_contacts_sync_auth/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}

	public function create_contacts_sync_auth($param)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => url_cloudike."/accounts/create_contacts_sync_auth/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($param),
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"mountbit-auth: ".$_SESSION['token']
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $result=json_decode($response,true);
		}
	}



}