<?php 

namespace SG\PagSeguro;

class Transporter {


	public static function createSession()
	{

		$client = new Client();
		
		$res = $client->request('POST'. Config::getUrlSessions(). "?" . httpd_build_query(Config::getAuthentication()), [
			'verify'= false

		]);

		echo $res->getBody()->getContents();

	}


}

 ?>