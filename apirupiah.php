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
		
		echo "Masukan Nomer HP : ";
		$nomerhp = trim(fgets(STDIN));
		
		/*
		$UA = array(
		'HTC_HD2_T8585Opera/9.70 (Windows NT 5.1; U; de)',
		'Mozilla/3.0 (Windows NT 5.0; U)Opera 7.01 [en]',
		'Mozilla/3.0 (Windows NT 5.0; U)Opera 7.10 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.0-4GB i686)Opera 5.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.0-64GB-SMP i686)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.10-4GB i686)Opera 6.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.18 i686)Opera 6.11 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.18-4GB i686)Opera 6.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.18-4GB i686)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.18-4GB i686)Opera 6.1 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.19 i686)Opera 6.1 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.19-16mdk i686)Opera 6.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.19-4GB i686)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.19-4GB i686)Opera 6.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.20-13.7 i686)Opera 6.11 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.20-4GB i686)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.20-4GB i686)Opera 6.12 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.20-686 i686)Opera 6.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.4 i686)Opera 6.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux 2.4.4-4GB i686)Opera 5.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Linux)Opera 5.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Mac_PowerPC)Opera 5.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Mac_PowerPC)Opera 5.12 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Mac_PowerPC)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Mac_PowerPC)Opera 6.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; SunOS 5.8 sun4u)Opera 5.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; UNIX)Opera 6.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; UNIX)Opera 6.11 [fr]',
		'Mozilla/4.0 (compatible; MSIE 5.0; UNIX)Opera 6.12 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.04 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 2000)Opera 6.04 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 95)Opera 6.02 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 95)Opera 6.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 5.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 5.12 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 5.12 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 5.12 [it]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.0 [fr]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.01 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.01 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.01 [fr]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.01 [it]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.04 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)Opera 6.04 [pl]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 5.11 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 5.12 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 5.12 [it]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 6.01 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows ME)Opera 6.01 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 5.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 5.11 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 5.12 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.01 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.01 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 4.0)Opera 6.04 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.1)Opera 5.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.01 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.01 [et]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.01 [it]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.04 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.04 [en]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.04 [fr]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.06 [de]',
		'Mozilla/4.0 (compatible; MSIE 5.0; Windows XP)Opera 6.06 [fr]',
		'Mozilla/4.0 (compatible; MSIE 5.23; Mac_PowerPC)Opera 7.54 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; ; Linux i686)Opera 7.50 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; ; Linux x86_64)Opera 7.50 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; Linux i686 ; en)Opera 9.70',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 2000)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 95)Opera 7.03 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 98)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 98)Opera 7.01 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 98)Opera 7.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 98)Opera 7.03 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows 98)Opera 7.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows ME)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows ME)Opera 7.02 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows ME)Opera 7.03 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 4.0)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 4.0)Opera 7.02 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.0)Opera 7.0 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.0)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.0)Opera 7.01 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.0)Opera 7.03 [de]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.0)Opera 7.03 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1)Opera 7.0 [en]',
		'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1)Opera 7.01 [de]',
		);
		echo $UA[array_rand($UA,1)];
		*/
		$st = (string)(microtime(true) * 10000);
		echo $st."\n";
		$headers = array();
		$headers[] = 'Host: apiservice.rupiahcepatweb.com';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0';
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
		
		//echo 'data=%7B%22mobile%22%3A%22'.$nomerhp.'%22%2C%22noise%22%3A%22'.$st.rand(10000, 99999).'%22%2C%22request_time%22%3A%22'.$st.rand(0, 9).'%22%2C%22access_token%22%3A%2211111%22%7D';
		echo $y."\n";
		
		echo "Masukan Nomer Pin: ";
		$pinhp = trim(fgets(STDIN));
		
		unset($headers[6]);
		$st2 = (string)(microtime(true) * 10000);
		echo $st2;
		$z = curl('https://apiservice.rupiahcepatweb.com/webapi/v1/login_or_register','data=%7B%22mobile%22%3A%22'.$nomerhp.'%22%2C%22auth_code%22%3A%22'.$pinhp.'%22%2C%22channel%22%3A%22%22%2C%22invite%22%3A%22200205190099965309%22%2C%22op%22%3A%22%22%2C%22type%22%3A%22%22%2C%22noise%22%3A%22'.$st2.rand(10000, 99999).'%22%2C%22request_time%22%3A%22'.$st2.rand(0, 9).'%22%2C%22access_token%22%3A%2211111%22%7D',$headers,null);
		$z = $z[0];
		
		echo $z;
		
		
