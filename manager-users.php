<?php 

use \SG\PageManager;
use \SG\Model\User;
use \SG\Model\Event;
use \SG\Model\Participant;
use \SG\Model\Message;
use \SG\Model\Activities;
use \SG\PageManagerError;
use \SG\Model;
use Rain\Tpl;

// require_once("functions.php");

// $app->get("/manager/users", function() {

// 	User::verifyLogin();

// 	$users = User::listAll();

// 	$page = new PageManager();

// 	$page->setTpl("users", array(
// 		"users"=>$users
// 	));

// });

$app->get("/manager/events", function() {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);

	$page = new PageManager();

	$page->setTpl("events", [
		'event' => $event,
	]);

});

$app->post("/manager/events/:idevent", function($idevent) {

	User::verifyLogin();

	$event = new Event();

	$event->getId((int)($idevent));

	$event->setData($_POST);

	$event->checkPhoto();

	$results = $event->eventUpdate();

	$event->setPhoto($_FILES["file"]);


	header('Location: /manager/events');
	exit;

});


$app->get("/manager/events/:idevent", function($idevent) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	if($results === true){

		$page = new PageManager();

		$page->setTpl("events-update", [
		'event' => $event->getValues()
		]);
	}
	else{

		$page = new PageManagerError();

		$page->setTpl("404");
	}
		
});



$app->get("/manager/events/:idevent/delete", function($idevent){

	User::verifyLogin();

	$event = new Event();

	$event->getId((int)($idevent));

	$event->deleteEvent();

	header('Location: /manager/events');
	exit;



});

$app->get("/manager/events/new/", function() {

	User::verifyLogin();

	$page = new PageManager();
		
	$page->setTpl("events-new",
		[
		'registerError'=>Message::getErrorRegister(),
		'postValues'=>
			(isset($_SESSION['postValues'])) ? $_SESSION['postValues'] :
			[
			'event_name'=>'', 
			'description'=>'', 
			'site'=>'', 
			'initial_date'=>'', 
			'end_date'=>'', 
			'vacancies'=>'', 
			'local'=>'', 
			'address'=>'', 
			'cep'=>'',
			'price' => '',
			'fb_id'=>'',
			'instagram_id'=>''
			]
		]);
	
	

});

$app->post("/manager/events/new/", function() {

	User::verifyLogin();

	$_SESSION['postValues'] = $_POST;

	if (!isset($_POST['event_name']) || $_POST['event_name']=='') {
		Message::setErrorRegister("Digite o nome do evento.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['description']) || $_POST['description']=='') {
		Message::setErrorRegister("Digite a descrição.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['site']) || $_POST['site']=='') {
		Message::setErrorRegister("Digite o site do evento.");
		header('Location: /manager/events/new/');
		exit;
	}


	if (!isset($_POST['initial_date']) || $_POST['initial_date']=='') {
		Message::setErrorRegister("Digite a data inicial.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['end_date']) || $_POST['end_date']=='') {
		Message::setErrorRegister("Digite a data final.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['local']) || $_POST['local']=='') {
		Message::setErrorRegister("Digite o local.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['address']) || $_POST['address']=='') {
		Message::setErrorRegister("Digite o endereço.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['cep']) || $_POST['cep']=='') {
		Message::setErrorRegister("Digite o cep.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (!isset($_POST['price']) || $_POST['price']=='') {
		Message::setErrorRegister("Digite o preço da inscrição.");
		header('Location: /manager/events/new/');
		exit;
	}

	if (Event::checkSiteExist($_POST['site'])) {
		Message::setErrorRegister("Este site já existe");
	 	header('Location: /manager/events/new/');
		exit;
	}

	$user = User::getFromSession();
	$event = new Event();

	$vacancies = $_POST['vacancies'];

	$result = $event->createEvent(
		$_POST['event_name'],
		$_POST['description'],
		$_POST['site'],
		$user->getiduser(),
		$_POST['initial_date'],
		$_POST['end_date'],
		$_POST['vacancies'],
		$_POST['local'],
		$_POST['address'],
		$_POST['cep'],
		$_POST['price'],
		$_POST['fb_id'],
		$_POST['instagram_id']
	);
		 
		header('Location: /manager/events');
		exit;
	 
});

$app->get("/manager/participants", function() {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);

	$page = new PageManager();

	$page->setTpl("participants", [
		'event' => $event,
	]);


});

$app->get("/manager/submits", function() {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);

	$page = new PageManager();

	$page->setTpl("submits");


});

$app->get("/manager/participants/:idevent", function($idevent) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	if($results === true){

		$page = new PageManager();

		$participants = new Participant();

		$participant = Participant::listAll($idevent);



		$page->setTpl("participants-event", [
			'participant' => $participant,
			'idevent' => $idevent
		]);
	}
	else{

		$page = new PageManagerError();

		$page->setTpl("404");
	}

});

$app->get("/manager/participants/:idevent/export", function($idevent) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	$participants = new Participant();

	$participant = Participant::listAll($idevent);

	

	

});


$app->get("/manager/activities", function() {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);

	$page = new PageManager();

	$page->setTpl("activities", [
		'event' => $event,
	]);

});

$app->get("/manager/financial", function() {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);
	
	$page = new PageManager();

	$page->setTpl("financial", [
		'event' => $event,
	]);

});

$app->get("/manager/financial/request/:idevent", function($idevent) {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listById($idevent);

	$data = $event[0];

	$availableMoney = Event::availableMoney($idevent);

	$data2 = $availableMoney[0];

	$confirmedPayment = Event::confirmedPayment($idevent);

	$page = new PageManager();

	$page->setTpl("financial-event", [
		'event' => $data,
		'money' => $data2,
		'confirmedPayment' => $confirmedPayment
	]);

});

$app->get("/manager/financial/request/:idevent/bank", function($idevent) {

	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$event = Event::listAll($iduser);

	$verifyBank = $user->verifyBank($iduser);

	if(count($verifyBank) > 0)
	{
		$page = new PageManager();

		$page->setTpl("request", [
			'bank' => $verifyBank,
			'event' => $event,
			'messageSuccess' => Message::getSuccess(),
			'messageError' => Message::getError()
		]);

	} else{

	$page = new PageManager();

	$page->setTpl("account", [
		'event' => $event,
		'registerError'=>Message::getErrorRegister(),
		'postValues'=>
			(isset($_SESSION['postValues'])) ? $_SESSION['postValues'] :
			[
			'bank_name'=>'', 
			'agency'=>'', 
			'account'=>'', 
			'cpf_cnpj'=>'', 
			'holder_name'=>'', 
			'phone'=>'', 
			
			]
		]);
	

	}

	

});

$app->post("/manager/financial/request/:idevent/bank", function($idevent) {

	User::verifyLogin();

	$_SESSION['postValues'] = $_POST;

	if (!isset($_POST['bank_name']) || $_POST['bank_name']=='') {
		Message::setErrorRegister("Digite o nome do banco.");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}

	if (!isset($_POST['agency']) || $_POST['agency']=='') {
		Message::setErrorRegister("Digite a agencia.");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}

	if (!isset($_POST['account']) || $_POST['account']=='') {
		Message::setErrorRegister("Digite a conta");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}


	if (!isset($_POST['cpf_cnpj']) || $_POST['cpf_cnpj']=='') {
		Message::setErrorRegister("Digite o CPF ou CNPJ.");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}

	if (!isset($_POST['holder_name']) || $_POST['holder_name']=='') {
		Message::setErrorRegister("Digite a data final.");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}

	if (!isset($_POST['phone']) || $_POST['phone']=='') {
		Message::setErrorRegister("Digite um telefone para contato.");
		header('Location: /manager/financial/'.$idevent);
		exit;
	}

	$users = new User();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$email = $user->getdesemail();

	$event = Event::listAll($iduser);

	$users->setData($_POST);

	$users->addBank($iduser);

	header('Location: /manager/financial/'.$idevent);

	exit;

});

$app->post("/manager/financial/request/:idevent", function($idevent) {

	User::verifyLogin();

	$users = new User();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$email = $user->getdesemail();

	$availableMoney = Event::availableMoney($idevent);

	$money = $availableMoney[0];

	$results = $users->requestDeposit($_POST['holder_name'], $_POST['bank_name'], $_POST['agency'], $_POST['account'], $_POST['cpf_cnpj'], $_POST['phone'], $idevent, $iduser, $money['available_money'], $email);


	header('Location: /manager/financial/request/'.$idevent.'/bank');

	exit;

});

$app->get("/manager/activities/:idevent", function($idevent) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	if($results === true){

		$page = new Pagemanager();

		$activity = Activities::listAllActivities($idevent);

		$page->setTpl("activities-event", [
			'registerError'=>Message::getErrorRegister(),
			'activity' => $activity,
			'idevent' => $idevent
		]);
	}
	else{

		$page = new PagemanagerError();

		$page->setTpl("404");
	}

});

$app->get("/manager/activities/:idevent/new/", function($idevent) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	if($results === true){

		$page = new Pagemanager();

		$page->setTpl("activities-event-new", [
			'registerError'=>Message::getErrorRegister(),
			'idevent' => $idevent,
			'postValues'=>
			(isset($_SESSION['postValues'])) ? $_SESSION['postValues'] :
			[
			'activity_name'=>'', 
			'description'=>'', 
			'type'=>'', 
			'date'=>'', 
			'initial_hour'=>'', 
			'end_hour'=>'', 
			'vacancies'=>''	
			]
		]);
	}
	else{

		$page = new PagemanagerError();

		$page->setTpl("404");
	}

});

$app->post("/manager/activities/:idevent/new/", function($idevent) {

	User::verifyLogin();

	$_SESSION['postValues'] = $_POST;


	if (!isset($_POST['activity_name']) || $_POST['activity_name']=='') {
		Message::setErrorRegister("Digite o nome da atividade.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	if (!isset($_POST['description']) || $_POST['description']=='') {
		Message::setErrorRegister("Digite a descrição.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	if (!isset($_POST['activity_type']) || $_POST['activity_type']=='') {
		Message::setErrorRegister("Selecione o tipo.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	if (!isset($_POST['data_activity']) || $_POST['data_activity']=='') {
		Message::setErrorRegister("Digite a data");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	if (!isset($_POST['initial_hour']) || $_POST['initial_hour']=='') {
		Message::setErrorRegister("Digite o horário inicial.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	if (!isset($_POST['end_hour']) || $_POST['end_hour']=='') {
		Message::setErrorRegister("Digite o horário final.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}


	if(Activities::checkExist($_POST['activity_name'],$idevent)){
		Message::setErrorRegister("Não é permitido duas atividades com o mesmo nome.");
		header('Location: /manager/activities/'.$idevent.'/new/');
		exit;
	}

	$activity = new Activities();

	$activity->setData($_POST);

	$activity->createActivity($idevent);

	header('Location: /manager/activities/'.$idevent);
	exit;
	 
});

$app->get("/manager/activities/:idevent/:idactivity", function($idevent, $idactivity) {

	User::verifyLogin();

	$user = new User();

	$event = new Event();

	$event->getId((int)($idevent));	

	$results = $event->accessEdit(getUserId());

	if($results === true){

		$page = new Pagemanager();
	
		$activity = new Activities();

		$activity->getId((int)($idactivity));

		$page->setTpl("activities-event-update", [
		'activity' => $activity->getValues(),
		'event' => $event->getValues()
		]);
	}
	else{

		$page = new PagemanagerError();

		$page->setTpl("404");
	}
		
});

$app->post("/manager/activities/:idevent/:idactivity", function($idevent, $idactivity) {

	User::verifyLogin();

	$event = new Event();

	$event->getId((int)($idevent));

	$activity = new Activities();

	$activity->getId((int)($idactivity));

	$activity->setData($_POST);

	$results = $activity->activityUpdate($idactivity);

	header('Location: /manager/activities/'.$idevent);
	exit;

});


 ?>