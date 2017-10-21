<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\Event;

class User extends Model {

	const SESSION = "User";
	const SECRET = "sg_hash";

	public static function getFromSession()
	{

		$user = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['iduser'] > 0) {

			$user->setData($_SESSION[User::SESSION]);

		}

		return $user;

	}

	public static function checkLogin()
	{

		if (
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 
			
		) {
			//Não está logado
			return false;
		} else {

			return true;

		}

	}


	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		)); 

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)
		{

			$user = new User();

			$data['deslogin'] = utf8_encode($data['deslogin']);

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

	}

	public static function verifyLogin()
	{

	 	if (!User::checkLogin()) {

			header("Location: /manager/login");

	 		} else {
	 			return true;
	 		}
	 	exit;

	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

	public function getAdminData($site)
	{

		$sql = new Sql();


		$results = $sql->select("SELECT desname,desemail,nrphone FROM tb_users INNER JOIN tb_event WHERE site = :site AND create_user_id = iduser", array(
			":site" => $site
		));


		return $results;

	}



	public function createUser($name, $email, $phone, $login, $password)
	{

		$sql = new Sql();

		$results = $sql->query("INSERT INTO tb_users (desname, desemail, nrphone,
		 deslogin, despassword) 
		 VALUES (:desname, :desemail, :nrphone, :deslogin, :despassword)", 
		 array(
			':desname'=>$name,
			':desemail'=>$email,
			':nrphone'=>$phone,
			':deslogin'=>$login,
			':despassword'=>$password
			));

	}

	public function updateUser($iduser)
	{

		$sql = new Sql();

		$results = $sql->query("UPDATE tb_users 
			SET
			desname = :desname,
			desemail = :desemail,
			nrphone = :nrphone,
			deslogin = :deslogin
			WHERE iduser = :iduser", 
			array(
				":iduser" => $iduser,
				":desname" => $this->getdesname(),
				":desemail" => $this->getdesemail(),
				":nrphone" => $this->getnrphone(),
				":deslogin" => $this->getdeslogin()
			));

		return $results;

	}


	public function get($iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE iduser = :iduser", array(
			":iduser"=>$iduser
		));

		$data = $results[0];

		$data['desname'] = utf8_encode($data['desname']);


		$this->setData($data);

	}


	public static function getForgot($email)
	{

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_users
			WHERE desemail = :email;
		", array(
			":email"=>$email
		));

		if (count($results) === 0)
		{
			throw new \Exception("Email não cadastrado.");
			
		}
		else
		{

			$data = $results[0];

			$results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(
				":iduser"=>$data["iduser"],
				":desip"=>$_SERVER["REMOTE_ADDR"]
			));

			if (count($results2) === 0)
			{

				throw new \Exception("Não foi possível recuperar a senha");

			}
			else
			{

				$dataRecovery = $results2[0];

				$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, User::SECRET, $dataRecovery["idrecovery"], MCRYPT_MODE_ECB));

				if ($inadmin) {
					$link = "http://sgcongressos.com/manager/forgot/reset?code=$code";	
				} else {
					$link = "http://sgcongressos.com.br/forgot/reset?code=$code";
				}

				$mailer = new Mailer($data["desemail"], $data["desname"], "Redefinir Senha", "forgot", array(
					"name"=>$data["desname"],
					"link"=>$link
				));

				$mailer->send();

				return $data;

			}


		}

	}

	public function requestDeposit($idevent, $iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_request WHERE create_user_id = :iduser", 
			array(
				":iduser" => $iduser

			));
	
		if(count($results) > 0)
		{

			throw new \Exception("Você já solicitou um depósito, aguarde 3 dias uteis e verifique sua conta bancária");

		} else 
			{	

				// $results2 = $sql->select("SELECT * FROM tb_bank WHERE create_user_id = :iduser", 
				// array(
				// 	":iduser" => $iduser		

				// ));

				// $data = $results2[0];

				$mailer = new Mailer('renatofr95@gmail.com' , "Solicitação de Depósito", "request", array(
				"name" => $this->getholder_name(),
				"cpf" => $this->getcpf_cnpj(),
				"bank_name" => $this->getbank_name(),
				"agency" => $this->getagency(),
				"account" => $this->getaccount(),
				"value" => $this->getvalue(),
				"event_name" => $this->getevent_name()
				));

				$mailer->send();

				$results2 = $sql->query("INSERT INTO tb_request (idevent, create_user_id) VALUES (:idevent, :create_user_id)", 
					array(
						":idevent" => $this->getidevent(),
						":create_user_id" => $this->getcreate_user_id()

					));
				

			}
		



	}

	public function addBank($iduser)
	{

		$sql = new Sql();

		$results = $sql->query("INSERT INTO tb_bank (bank_name, agency, account, cpf_cnpj, holder_name, phone, create_user_id) 
			VALUES (:bank_name, :agency, :account, :cpf_cnpj, :holder_name, :phone, :create_user_id)", 
			array(
				":bank_name" => $this->getbank_name(),
				":agency" => $this->getagency(),
				":account" => $this->getaccount(),
				":cpf_cnpj" => $this->getcpf_cnpj(),
				":holder_name" => $this->getholder_name(),
				":phone" => $this->getphone(),
				":create_user_id" => $iduser
			));

		return $results;

	}



	public function verifyBank($iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_bank WHERE create_user_id = :iduser", array(
			":iduser" => $iduser

		));

		return $results;

	}

	public static function validForgotDecrypt($code)
	{

		$idrecovery = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, User::SECRET, base64_decode($code), MCRYPT_MODE_ECB);

		$sql = new Sql();

		$results = $sql->select("
			SELECT * 
			FROM tb_userspasswordsrecoveries a
			INNER JOIN tb_users b USING(iduser)
			INNER JOIN tb_persons c USING(idperson)
			WHERE 
				a.idrecovery = :idrecovery
			    AND
			    a.dtrecovery IS NULL
			    AND
			    DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
			":idrecovery"=>$idrecovery
		));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else
		{

			return $results[0];

		}

	}

	public static function setFogotUsed($idrecovery)
	{

		$sql = new Sql();

		$sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
			":idrecovery"=>$idrecovery
		));

	}

	public function setPassword($password)
	{

		$sql = new Sql();

		$sql->query("UPDATE tb_users SET despassword = :password WHERE iduser = :iduser", array(
			":password"=>$password,
			":iduser"=>$this->getiduser()
		));

	}



	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin", [
			':deslogin'=>$login
		]);

		return (count($results) > 0);

	}

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

}

 ?>