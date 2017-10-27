<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\Event;

class Participant extends Model {

	const SESSION = "Participant";
	const SECRET = "sg_hash";
	const ERROR = "ParticipantError";
	const ERROR_REGISTER = "ParticipantErrorRegister";
	const REGISTER_SUCCESS = "ParticipantRegisterSuccess";

	public static function listAll($idevent)
	{

		$sql = new Sql();

		$results =  $sql->select("SELECT * FROM tb_participants WHERE event_id = :idevent", array(
			":idevent" => $idevent
		));

		return $results;

	}


	public static function getFromSession()
	{

		$participant = new Participant();

		if (isset($_SESSION[Participant::SESSION]) && (int)$_SESSION[Participant::SESSION]['idparticipant'] > 0) {

			$participant->setData($_SESSION[Participant::SESSION]);

		}

		return $participant;

	}

	public static function checkLogin()
	{

		if (
			!isset($_SESSION[Participant::SESSION])
			||
			!$_SESSION[Participant::SESSION]
			||
			!(int)$_SESSION[Participant::SESSION]["idparticipant"] > 0 
			
		) {
			//Não está logado
			return false;
		} else {

			return true;

		}

	}

	public function createParticipant($event_id)
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_participants_save(:pname, :cpf, :phone, :email, :login, :password, :event_id, :category, :idevent)", 
			array(
			":pname"=>utf8_decode($this->getpname()),
			":cpf"=>$this->getcpf(),
			":phone"=>$this->getphone(),
			":email"=>$this->getemail(),
			":login"=>$this->getlogin(),
			":password"=>User::getPasswordHash($this->getpassword()),
			":event_id"=>$event_id,
			":category"=>$this->getcategory(),
			":idevent" =>$event_id
		));

	}

	public function updateParticipant($idparticipant)
	{

		$sql = new Sql();

		$results = $sql->query("UPDATE tb_participants
			SET 
			pname = :pname,
			cpf = :cpf,
			phone = :phone,
			email = :email,
			category = :category,
			login = :login
			WHERE idparticipant = :idparticipant
			", 
			array(
			":idparticipant" => $idparticipant,
			":pname" => $this->getpname(),
			":cpf" => $this->getcpf(),
			":phone" => $this->getphone(),
			":email" => $this->getemail(),
			":category" => $this->getcategory(),
			":login" => $this->getlogin()	
			));

		return $results;
	}

	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_participants WHERE login = :login", array(
			":login"=>$login
		)); 

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0];

		if (password_verify($password, $data["password"]) === true)
		{

			$participant = new Participant();

			$data['login'] = utf8_encode($data['login']);

			$participant->setData($data);

			$_SESSION[Participant::SESSION] = $participant->getValues();

			return $participant;

		} else {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}

	public static function verifyLogin($site)
	{

	 	if (!Participant::checkLogin()) {

			header("Location: /event/$site/login");

	 		} else {
	 			return true;
	 		}
	 	exit;

	}

	public function accessEdit($idparticipant)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_participants WHERE idparticipant = :id", array(
			":id" => $idparticipant
		));

		if(count($results) > 0){

			return true;

		}
		else return false;
		

	}

	public static function logout()
	{

		$_SESSION[Participant::SESSION] = NULL;

	}

		public static function setError($msg)
	{

		$_SESSION[Participant::ERROR] = $msg;

	}


	public static function getError()
	{

		$msg = (isset($_SESSION[Participant::ERROR]) && $_SESSION[Participant::ERROR]) ? $_SESSION[Participant::ERROR] : '';

		Participant::clearError();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[Participant::ERROR] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Participant::ERROR_REGISTER] = $msg;

	}

	public static function setRegisterSuccess($msg)
	{

		$_SESSION[Participant::REGISTER_SUCCESS] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Participant::ERROR_REGISTER]) && $_SESSION[Participant::ERROR_REGISTER]) ? $_SESSION[Participant::ERROR_REGISTER] : '';

		Participant::clearErrorRegister();

		return $msg;

	}

	public static function getRegisterSuccess()
	{

		$msg = (isset($_SESSION[Participant::REGISTER_SUCCESS]) && $_SESSION[Participant::REGISTER_SUCCESS]) ? $_SESSION[Participant::REGISTER_SUCCESS] : '';

		Participant::clearRegisterSuccess();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[Participant::ERROR_REGISTER] = NULL;

	}

	public static function clearRegisterSuccess()
	{

		$_SESSION[Participant::REGISTER_SUCCESS] = NULL;

	}

	public static function checkEmailExist($email, $idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_participants WHERE email = :email AND event_id = :event_id", [
			':email'=>$email,
			':event_id'=>$idevent
		]);

		return (count($results) > 0);

	}

	public static function checkCpfExist($cpf, $idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_participants WHERE cpf = :cpf AND event_id = :event_id", [
			':cpf'=>$cpf,
			':event_id'=>$idevent
		]);

		return (count($results) > 0);

	}

	public static function checkLoginExist($login, $idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_participants WHERE login = :login AND event_id = :event_id", [
			':login'=>$login,
			':event_id'=>$idevent
		]);

		return (count($results) > 0);

	}

	public static function checkVacancies($site)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_event  WHERE site = :site 
			AND subscribes = vacancies AND vacancies > 0 AND subscribes > 0", [
			':site'=>$site,
		]);

		return (count($results) > 0);

	}

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	public function toSession()
	{

		$_SESSION[Order::SESSION] = $this->getValues();

	}


}