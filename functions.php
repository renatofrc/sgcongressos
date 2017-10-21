<?php 

use \SG\Model\User;
use \SG\Model\Participant;
use \SG\DB\Sql;


function checkLogin($inadmin = true)
{

	return User::checkLogin($inadmin);

}

function getUserName()
{

	$user = User::getFromSession();

	return $user->getdesname();

}

function getUserId()
{

	$user = User::getFromSession();

	return $user->getiduser();

}

function getEnterDate()
{

	$user = User::getFromSession();

	$date = $user->getdtregister();

	return date("d/m/Y",strtotime($date));
}


function getParticipantName()
{

	$user = Participant::getFromSession();

	return $user->getpname();

}

function getParticipantDt()
{

	$participant = Participant::getFromSession();

	$date = $participant->getdtregister();

	return date("d/m/Y",strtotime($date));
}

 ?>