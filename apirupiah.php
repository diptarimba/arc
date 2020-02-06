<?php
	
	function curl($url, $fields = null, $headers = null, $custreq = null)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			//curl_setopt($ch, CURLOPT_HEADER, 1);
			if ($fields !== null) {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			}
			if ($headers !== null) {  
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
			if ($custreq !== null) {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custreq);
			}else{
				curl_setopt($ch, CURLOPT_POST, 1);
			}
			$result   = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header = substr($result, 0, $header_size );
			$body = substr($result, $header_size );
			curl_close($ch);
			
			return array(
				$result,
				$httpcode,
				$header,
				$body,
			);
		}
		
		function getCookie($source) {
			preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $source, $matches);
			$cookies = array();
			foreach($matches[1] as $item) {
				parse_str($item, $cookie);
				$cookies = array_merge($cookies, $cookie);
			}
			return $cookies;
		}
		
		
		
		$UA = file_get_contents("UserAgent.txt");
		$UA = explode("\n", $UA);
		
		echo "[+] Masukan Nomer HP : ";
		$nomerhp = trim(fgets(STDIN));
		
		$st = (string)(microtime(true) * 10000);
		$headers = array();
		$headers[] = 'Host: apiservice.rupiahcepatweb.com';
		$headers[] = 'User-Agent: '.$UA[array_rand($UA,1)];
		$headers[] = 'Accept: text/html, application/xhtml+xml, application/json, */*';
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
		$headers[] = 'Content-Length: 166';
		$headers[] = 'Origin: https://h5.rupiahcepatweb.com';
		$headers[] = 'Connection: keep-alive';
		//$headers[] = 'x-forward-for: 1.142.353.234';
		$headers[] = 'Referer: https://h5.rupiahcepatweb.com/dua2/pages/openPacket/openPacket.html?activityId=11&invite=200205190099965309';
		
		$y = curl('https://apiservice.rupiahcepatweb.com/webapi/v1/request_login_register_auth_code','data=%7B%22mobile%22%3A%22'.$nomerhp.'%22%2C%22noise%22%3A%22'.$st.rand(10000, 99999).'%22%2C%22request_time%22%3A%22'.$st.rand(0, 9).'%22%2C%22access_token%22%3A%2211111%22%7D',$headers,null);
		$y = $y[0];
		echo $y."\n";
		
		echo "[+] Masukan Nomer Pin: ";
		$pinhp = trim(fgets(STDIN));
		
		unset($headers[6]);
		$st2 = (string)(microtime(true) * 10000);
		$z = curl('https://apiservice.rupiahcepatweb.com/webapi/v1/login_or_register','data=%7B%22mobile%22%3A%22'.$nomerhp.'%22%2C%22auth_code%22%3A%22'.$pinhp.'%22%2C%22channel%22%3A%22%22%2C%22invite%22%3A%22200205190099965309%22%2C%22op%22%3A%22%22%2C%22type%22%3A%22%22%2C%22noise%22%3A%22'.$st2.rand(10000, 99999).'%22%2C%22request_time%22%3A%22'.$st2.rand(0, 9).'%22%2C%22access_token%22%3A%2211111%22%7D',$headers,null);
		$z = $z[0];
		
		echo $z;
		
		
		
