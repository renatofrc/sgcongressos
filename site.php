<?php 

use \SG\Page;
use \SG\Model\User;
use \SG\Model\Event;
use \SG\Model\Participant;
use \SG\Model\Message;
use \SG\PageEvent;
use \SG\PageParticipant;
use \SG\DB\Sql;
use \SG\PagSeguro\Config;
use \SG\Model\Payment;
use Rain\Tpl;

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");

});

$app->get("/event/:site", function($site) { // Novo modo de criação de páginas dinâmicas

	$page = new PageEvent($site);

	$events = new Event();

	$url = $events->getUrl($site);

	$event = $events->listEventData($site);

	$results = Event::checkList($event);

	$user = new User();

	$contact = $user->getAdminData($site);

	$data = $results[0];

	$page->setTpl("index", [
		'event' => $data,
		'contact' => $contact

	]);


 });

 $app->get("/event/:site/subscribe", function($site) { 

 	$page = new PageEvent($site, [
 		'header' => false,
 		'footer' => false
 	]);

 	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

 	$page->setTpl("subscribe" ,[
 		'event' => $data,
 		'registerError'=>Message::getErrorRegister(),
		'registerSuccess'=>Message::getRegisterSuccess()
 	]);

 });

 $app->post("/event/:site/subscribe", function($site) { 

 	
 	if(isset($_POST['submit'])){
	

 		$events = new Event();

 		$results = $events->getUrl($site);

 		$data = $results[0];

 		$url = $data['site'];

		if (!isset($_POST['pname']) || $_POST['pname']=='') {
			Message::setErrorRegister("Preencha o nome completo.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
			
		}

		if (!isset($_POST['cpf']) || $_POST['cpf']=='') {
			Message::setErrorRegister("Preencha o cpf.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (!isset($_POST['phone']) || $_POST['phone']=='') {
			Message::setErrorRegister("Preencha o telefone.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (!isset($_POST['email']) || $_POST['email']=='') {
			Message::setErrorRegister("Preencha o e-mail.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (!isset($_POST['password']) || $_POST['password']=='') {
			Message::setErrorRegister("Preencha a senha.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		$event = new Event();

		$results = $event->listEventData($site);

		$data = $results[0];

		$idevent = $data['idevent'];

		if (Participant::checkLoginExist($_POST['login'],$idevent)) {
			Message::setErrorRegister("Este login já está cadastrado. Use a opção esqueci a senha.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (Participant::checkCpfExist($_POST['cpf'],$idevent)) {
			Message::setErrorRegister("Este cpf já está cadastrado. Use a opção esqueci a senha.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (Participant::checkEmailExist($_POST['email'],$idevent)) {
			Message::setErrorRegister("Este email já está cadastrado. Use a opção esqueci a senha.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}

		if (Participant::checkVacancies($url)) {
			Message::setErrorRegister("Limite de vagas excedido.");
			header('Location: /event/'.$url.'/subscribe');
			exit;
		}


	}

	$participant = new Participant();

	$participant->setData($_POST);

	$participant->createParticipant($idevent);

	if(Participant::checkLoginExist($_POST['login'],$idevent)){
		Message::setRegisterSuccess("Cadastro realizado com sucesso!");
			header('Location: /event/'.$url.'/subscribe');
			exit;
	}

 });

$app->get("/event/:site/login", function($site) { 

 	$page = new PageEvent($site, [
 		'header' => false,
 		'footer' => false
 	]);

 	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

 	$page->setTpl("login" ,[
 		'event' => $data,
 		'registerError'=>Message::getErrorRegister()
 	]);

 });

  $app->post("/event/:site/login", function($site) { 

 	Participant::login($_POST["login"], $_POST["password"]);

	header("Location: /event/".$site."/panel");
	exit;

 });


 $app->get("/event/:site/panel", function($site) { 

 	Participant::verifyLogin($site);

 	$page = new PageParticipant($site);

 	$participant = Participant::getFromSession();

 	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	Payment::checkPayment($participant->getidparticipant());

 	$results = Event::checkList($event);

 	$data = $results[0];

 	$page->setTpl("index", [
 		'event' => $data,
 		'participant' => $participant->getValues()
 	]);

 });

 $app->get("/event/:site/panel/:idparticipant", function($site, $idparticipant) { 

 	Participant::verifyLogin($site);

 	$participant = Participant::getFromSession();

 	$participants = new Participant();

 	$participants->accessEdit($participant->getidparticipant());

 	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

 	$page = new PageParticipant($site);

 	$page->setTpl("profile", [
 		'event' => $data,
 		'participant' => $participant->getValues()
 	]);

 });

$app->post("/event/:site/panel/:idparticipant", function($site, $idparticipant) {

	Participant::verifyLogin($site);

	$participant = new Participant();

	$participant->setData($_POST);

	$participant->updateParticipant($idparticipant);

	header('Location: /event/'.$site.'/panel');
	exit;

}); 

$app->get("/event/:site/panel/activities", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	var_dump($idparticipant);

	$page = new PageParticipant($site);

	$page->setTpl("activities", [
 		'event' => $data,
 		
 	]);

}); 

$app->get("/event/:site/payment", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

	$page = new PageParticipant($site);

	$page->setTpl("payment", [
		"participant" => $participant->getValues(),
		"event" => $data,
	]);

}); 

$app->get("/event/:site/ticket", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

	$page = new PageParticipant($site);

	$page->setTpl("ticket", [
		"participant" => $participant->getValues(),
		"event" => $data,
		"msgError"=>Message::getSuccess(),
	]);

}); 

$app->get("/event/:site/card", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$events = new Event();

 	$url = $events->getUrl($site);

 	$event = $events->listEventData($site);

 	$results = Event::checkList($event);

 	$data = $results[0];

	$page = new PageParticipant($site);

	$page->setTpl("card", [
		"participant" => $participant->getValues(),
		"event" => $data,
		"msgError"=>Message::getSuccess(),
	]);

}); 

$app->post("/event/:site/ticket", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$participant_name = $participant->getpname();

	$participant_id = $participant->getidparticipant();

	$event = new Event();

	$dataEvent = $event->listEventData($site);

	$data = $dataEvent[0];

	$price = $data['price'];

	$event_id = $data['idevent'];

	$data_of_expiration =  date('Y-m-d\TH:i:s.000-04:00', strtotime(date('Y-m-d\TH:i:s.000-04:00'). ' + 3 days'));

	if(isset($_POST['button']))
	{

		if (!isset($_POST['first_name']) || $_POST['first_name']=='') {
			Message::setErrorRegister("Preencha o seu nome.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['last_name']) || $_POST['last_name']=='') {
			Message::setErrorRegister("Preencha o seu sobrenome.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['cpf']) || $_POST['cpf']=='') {
			Message::setErrorRegister("Preencha o seu cpf.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['email']) || $_POST['email']=='') {
			Message::setErrorRegister("Preencha o seu email.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['street_name']) || $_POST['street_name']=='') {
			Message::setErrorRegister("Preencha o seu endereço.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['neighborhood']) || $_POST['neighborhood']=='') {
			Message::setErrorRegister("Preencha o seu bairro.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['neighborhood']) || $_POST['neighborhood']=='') {
			Message::setErrorRegister("Preencha o seu bairro.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['street_number']) || $_POST['street_number']=='') {
			Message::setErrorRegister("Preencha o número da casa.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['city']) || $_POST['city']=='') {
			Message::setErrorRegister("Preencha a cidade.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['state']) || $_POST['state']=='') {
			Message::setErrorRegister("Escolha o estado.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		if (!isset($_POST['cep']) || $_POST['cep']=='') {
			Message::setErrorRegister("Preencha o cep.");
			header('Location: /event/'.$site.'/ticket');
			exit;
		}

		$results = Payment::ticketPay(
		$data_of_expiration,
		$_POST['first_name'],
		$_POST['last_name'],
		$_POST['cpf'],
		$_POST['email'],
		$_POST['street_name'],
		$_POST['neighborhood'],
		$_POST['street_number'],
		$_POST['city'],
		$_POST['state'],
		$_POST['cep'],
		(int)$price,
		$participant_id,
		$event_id
		);

		if($results == 1){

			Message::setSuccess("Boleto gerado com sucesso, verifique seu e-mail");
			header('Location: /event/'.$site.'/ticket');
			exit;

		}

	}



});

$app->post("/event/:site/card", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$participant_name = $participant->getpname();
		
	$results = Payment::PaymentCredit(
 	$_POST['email'], 
 	(int)$_POST['amount'], 
 	$_POST['token'], 
 	$_POST['installments'],  
 	$_POST['paymentMethodId'],
 	$participant_name,
 	$site
 	);

	if($results == 201)
	{
		Message::setSuccess("Sua solicitação de pagamento foi enviada, verifique seu e-mail em alguns instantes.");
		header('Location: /event/'.$site.'/payment');
		exit;

	}


});

$app->get("/event/:site/tests", function($site) {

	Participant::verifyLogin($site);

	$participant = Participant::getFromSession();

	$idparticipant = $participant->getidparticipant();

	$results = Payment::checkPayment($idparticipant);

	var_dump($results);

});


 $app->get("/event/:site/logout", function($site) { 

 	Participant::logout();

	header("Location: /event/".$site."/login");
	exit;

 });

