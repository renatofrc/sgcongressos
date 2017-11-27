<?php 

namespace SG\Model;

use \SG\DB\Sql;
use \SG\Model;
use \SG\Mailer;
use \SG\Model\Event;
use \SG\Model\Participant;

class Activities extends Model {


	public static function listAllActivities($idevent)
	{

		$sql = new Sql();

		$results =  $sql->select("SELECT * FROM tb_activities WHERE event_id = :idevent", array(
			":idevent" => $idevent
		));

		return $results;

	}

	public static function listEventActivities($idparticipant)
	{

		$sql = new Sql();

		$results =  $sql->select("SELECT idactivity, activity_name,description, activity_type, data_activity, initial_hour, end_hour ,vacancies , subscribes FROM tb_activities a, tb_participants b WHERE a.event_id = b.event_id AND idparticipant = :idparticipant",
			array(
				":idparticipant" => $idparticipant
		));

		return $results;

	}

	public static function checkVacancies($idactivity)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_activities  WHERE idactivity = :idactivity AND subscribes = vacancies AND vacancies > 0 AND subscribes > 0", [
			':idactivity'=>$idactivity,
		]);

		return (count($results) > 0);

	}

	public function createActivity($event_id)
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_activities_save(:activity_name, :description, :activity_type, :data_activity, :initial_hour, :end_hour, :vacancies, :event_id)", 
			array(
				':activity_name' => utf8_decode($this->getactivity_name()),
				':description' => utf8_decode($this->getdescription()),
				':activity_type' => $this->getactivity_type(),
				':data_activity' => $this->getdata_activity(),
				':initial_hour' => $this->getinitial_hour(),
				':end_hour' => $this->getend_hour(),
				':vacancies' => $this->getvacancies(),
				':event_id' => $event_id

			));

		return $results;

	}

	public static function checkExist($activity_name, $idevent)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_activities WHERE activity_name = :name AND event_id = :id", array(
			":name" => $activity_name,
			":id" => $idevent

		));

		return (count($results) > 0);

	}

	public function activityUpdate($idactivity)
	{

		$sql = new Sql();

		$results = $sql->query("UPDATE tb_activities 
			SET
			activity_name = :activity_name,
			description = :description,
			activity_type = :activity_type,
			data_activity = :data_activity,
			initial_hour = :initial_hour,
			end_hour = :end_hour,
			vacancies = :vacancies 
			WHERE idactivity = :idactivity", array(
			":idactivity" => $idactivity,
			":activity_name" => utf8_decode($this->getactivity_name()),
			":description" => utf8_decode($this->getdescription()),
			":activity_type" => $this->getactivity_type(),
			":data_activity" => $this->getdata_activity(),
			":initial_hour" => $this->getinitial_hour(),
			":end_hour" => $this->getend_hour(),
			":vacancies" => $this->getvacancies()

		));
	
		return $results;
		

	}

	public function getId($idactivity)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_activities WHERE idactivity = :idactivity", array(
			":idactivity"=>$idactivity
		));

		$data = $results[0];

		$this->setData($data);

	}


}



 ?>