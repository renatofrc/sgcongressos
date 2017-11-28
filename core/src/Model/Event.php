<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\User;


class Event extends Model {


	public static function listAll($id)
	{

		$sql = new Sql();

		$results =  $sql->select("SELECT * FROM tb_event WHERE create_user_id = :id", array(
			":id" => $id
		));

		return $results;

	}

	public static function listById($idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_event WHERE idevent = :idevent", 
			array(
				":idevent" => $idevent
			));

		return $results;

	}

	public static function totalSubs($id)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT SUM(subscribes) as soma FROM tb_event 
			WHERE create_user_id = :id", 
			array(
				":id" => $id
			));

		$data = $results[0];

		return $data['soma'];

	}

	public static function listEventData($site)
	{

		$sql = new Sql();

		$results =  $sql->select("SELECT * FROM tb_event WHERE site = :site", array(
			":site" => $site
		));

		return $results;

	}

	public static function availableMoney($event_id)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT SUM(total_amount) as available_money FROM tb_payment WHERE event_id = :event_id AND status = 'approved'", array(
			":event_id" => $event_id

			));

		return $results;

	}

	public static function getManagerData($site)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT desname, desemail, event_name FROM tb_users a INNER JOIN tb_event b  WHERE b.site = :site AND b.create_user_id = a.iduser", array(
			":site" => $site

		));

		return $results;

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

	public static function confirmedPayment($event_id)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_payment WHERE event_id = :event_id AND status = 'approved'", array(
			":event_id" => $event_id

			));

		return count($results);

	}
	

	public static function checkList($list)
	{

		foreach ($list as &$row) {
			$e = new Event();
			$e->setData2($row);
			$row = $e->getValues();
		}

		return $list;

	}

	public static function getParticipantsActivities($idevent, $idactivity)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT pname, cpf, phone, email, category FROM tb_participants a, tb_participants_activities b WHERE a.idparticipant = b.participant_id AND b.activity_id = :idactivity AND b.event_id = :idevent", array(
			':idactivity' => $idactivity,
			':idevent' => $idevent
		));

		return $results;

	}


	public function createEvent($event_name, $description, $site, $create_user_id, $initial_date, $end_date, $vacancies, $local, $address, $cep, $price, $fb_id, $instagram_id)
	{

		$sql = new Sql();

		$results = $sql->query("INSERT INTO tb_event (event_name, description, site, create_user_id, initial_date, end_date, vacancies, local, address, cep, price, fb_id, instagram_id) 
			VALUES (:event_name, :description, :site, :create_user_id, :initial_date, :end_date, :vacancies, :local, :address, :cep, :price, :fb_id, :instagram_id)", 
			array(
			':event_name'=>utf8_decode($event_name),
			':description'=> utf8_decode($description),
			':site' => $site, 
			':create_user_id'=> $create_user_id, 
			':initial_date'=> $initial_date, 
			':end_date'=> $end_date, 
			':vacancies'=> $vacancies, 
			':local'=> utf8_decode($local), 
			':address'=> utf8_decode($address), 
			':cep'=> $cep,
			":price" => $price,
			':fb_id'=> $fb_id,
			':instagram_id' => $instagram_id
			));
		
		return $results;

	}


	public function deleteEvent()
	{

		$sql = new Sql();

		$user = User::getFromSession();

		$iduser = $user->getiduser();

		$results = $sql->query("CALL sp_event_delete(:idevent, :iduser)", 
			[
			':idevent'=>$this->getidevent(),
			':iduser'=>$iduser
			]);

		$data = $results[0];

		if($data['create_user_id'] == $iduser){

			return true;

		}
		else return false;

	}

	public function accessEdit($iduser)
	{

		$sql = new Sql();

		$idevent = $this->getidevent();

		$results =  $sql->select("SELECT * FROM tb_event WHERE idevent = :idevent AND create_user_id = :iduser", array(
			":idevent" => $idevent,
			":iduser" => $iduser
		));

		if(count($results) > 0){

			return true;

		}
		else return false;
		

	}

	public function eventUpdate()
	{

		$sql = new Sql();

		$results = $sql->query("UPDATE tb_event 
			SET 
			event_name = :name, 
			description = :description,
			site = :site,
			initial_date = :initial_date,
			end_date = :end_date,
			regs_start = :regs_start,
			regs_end = :regs_end,
			vacancies = :vacancies,
			local = :local,
			address = :address,
			cep = :cep,
			price = :price,
			fb_id = :fb_id,
			instagram_id = :instagram_id
			WHERE idevent = :idevent 
			", array(
			":idevent" => $this->getidevent(),
			":name" => utf8_decode($this->getevent_name()),
			":description" => utf8_decode($this->getdescription()),
			":site" => $this->getsite(),
			":initial_date" => $this->getinitial_date(),
			":end_date" => $this->getend_date(),
			":regs_start" => $this->getregs_start(),
			":regs_end" => $this->getregs_end(),
			":vacancies" => $this->getvacancies(),
			":local" => utf8_decode($this->getlocal()),
			":address" => utf8_decode($this->getaddress()),
			":cep" => $this->getcep(),
			":price" => $this->getprice(),
			":fb_id" => $this->getfb_id(),
			":instagram_id" => $this->getinstagram_id()
			));

		return $results;

	}

	public function setPhoto($file)
	{
		if(empty( $file['name'])){
 		
 			$this->checkPhoto();
 		
 		}
 		else{

			$extension = explode('.', $file['name']);
			$extension = end($extension);

			switch ($extension) {

				case "jpg":
				case "jpeg":
				$image = imagecreatefromjpeg($file["tmp_name"]);
				break;

				case "gif":
				$image = imagecreatefromgif($file["tmp_name"]);
				break;

				case "png":
				case "PNG":
				$image = imagecreatefrompng($file["tmp_name"]);
				break;

			}

			$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"event" . DIRECTORY_SEPARATOR . 
				"images" . DIRECTORY_SEPARATOR .  
				$this->getidevent() . ".jpg";

			imagejpeg($image, $dist);

			imagedestroy($image);

			$this->checkPhoto();
		}	
	}

	public function checkPhoto()
	{

		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"event" . DIRECTORY_SEPARATOR . 
			"images" . DIRECTORY_SEPARATOR .  
			$this->getidevent() . ".jpg"
			)) {

			$url = "/res/event/images/" . $this->getidevent() . ".jpg";

		} else {

			$url = "/res/event/images/banner.jpg";

		}

		return $this->setdesphoto($url);

	}

	public function getValues()
	{

		$this->checkPhoto();

		$values = parent::getValues();

		return $values;

	}


	public static function checkSiteExist($site){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_event WHERE site = :site", [
			':site'=>$site
		]);

		return (count($results) > 0);

	}


	
	public function getUrl($site)
	 {

	 	$sql = new Sql();

	 	$results = $sql->select("SELECT * FROM tb_event WHERE site = :site", array(
	 		":site"=>$site
	 	));

	 	return $results;

	 }

	 public function getId($idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_event WHERE idevent = :idevent", array(
			":idevent"=>$idevent
		));

		$data = $results[0];

		$this->setData($data);

	}

}



?>