<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;


class Message extends Model {

	const ERROR = "Error";
	const ERROR_REGISTER = "ErrorRegister";
	const REGISTER_SUCCESS = "RegisterSuccess";
	const SUCCESS = "Success";

		public static function setError($msg)
	{

		$_SESSION[Message::ERROR] = $msg;

	}


	public static function getError()
	{

		$msg = (isset($_SESSION[Message::ERROR]) && $_SESSION[Message::ERROR]) ? $_SESSION[Message::ERROR] : '';

		Message::clearError();

		return $msg;

	}

	public static function setSuccess($msg)
	{

		$_SESSION[Message::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Message::SUCCESS]) && $_SESSION[Message::SUCCESS]) ? $_SESSION[Message::SUCCESS] : '';

		Message::clearSuccess();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[Message::ERROR] = NULL;

	}

	public static function clearSuccess()
	{

		$_SESSION[Message::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Message::ERROR_REGISTER] = $msg;

	}

	public static function setRegisterSuccess($msg)
	{

		$_SESSION[Message::REGISTER_SUCCESS] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Message::ERROR_REGISTER]) && $_SESSION[Message::ERROR_REGISTER]) ? $_SESSION[Message::ERROR_REGISTER] : '';

		Message::clearErrorRegister();

		return $msg;

	}

	public static function getRegisterSuccess()
	{

		$msg = (isset($_SESSION[Message::REGISTER_SUCCESS]) && $_SESSION[Message::REGISTER_SUCCESS]) ? $_SESSION[Message::REGISTER_SUCCESS] : '';

		Message::clearRegisterSuccess();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[Message::ERROR_REGISTER] = NULL;

	}

	public static function clearRegisterSuccess()
	{

		$_SESSION[Message::REGISTER_SUCCESS] = NULL;

	}


}
 ?>