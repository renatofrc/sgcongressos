<?php 

namespace SG\PagSeguro;

class Config {

	const SANDBOX = true;

	const SANDBOX_EMAIL = "renatofr95@gmail.com";
	const PRODUCTION_EMAIL = "renatofr95@gmail.com";

	const SANDBOX_TOKEN = "36364C9E995B4097B91BD26F8F27604E";
	const PRODUCTION_TOKEN = "A1F5EA1767644D14AB12448DBDC0CC54";

	const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";
	const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/checkout";

	const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

	public static function getAuthentication():array
	{

		if(Config::SANDBOX === true)
		{

			return [
				"email" => Config::SANDBOX_EMAIL,
				"token" => Config::SANDBOX_TOKEN
			];

		} else {

			return [
				"email" => Config::PRODUCTION_EMAIL,
				"token" => Config::PRODUCTION_TOKEN
			];

		}

	}

	public static function getUrlSessions():string
	{

		return (Config::SANDBOX === true) ? Config::SANDBOX_SESSIONS : Config::PRODUCTION_SESSIONS;

	}

	public static function getUrlJS()
	{

		return (Config::SANDBOX === true) ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS;
	}

}

 ?>