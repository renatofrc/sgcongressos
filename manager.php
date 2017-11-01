<?php 

use \SG\PageManager;
use \SG\PageManagerError;
use \SG\Model\User;
use \SG\Model\Event;
use \SG\Model\Message;
use \SG\Model\Payment;

$app->get('/manager', function() {
    
	User::verifyLogin();

	$user = User::getFromSession();

	$iduser = $user->getiduser();

	$events = Event::listAll($iduser);

	$subscribes = Event::totalSubs($iduser);

	$payments = Payment::searchAllPayments();

	$page = new PageManager();

	$page->setTpl("index",[
		'events' => count($events),
		'subscribes' => $subscribes,
		'payments' => $payments
	]);

});

$app->get('/manager/profile/:iduser', function($iduser) {
    
	User::verifyLogin();

	$user = new User();

	$users = User::getFromSession();

	$userid = $users->getiduser();

		if($userid == $iduser){

			$page = new PageManager();

			$page->setTpl("profile",[
			'user' => $users->getValues()
			]);

		}
		else{

			$page = new PageManagerError();

			$page->setTpl("404");

		}

});

$app->post('/manager/profile/:iduser', function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->setData($_POST);

	$user->updateUser($iduser);

	header('Location: /manager/profile/'.$iduser);
	exit;

});


$app->get('/manager/login', function() {


	$page = new PageManager([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

});

$app->get('/manager/register', function() {

	$page = new PageManager([
		"header"=>false,
		"footer"=>false,
	]);

	$page->setTpl("register", [
		'registerError'=>Message::getErrorRegister(),
		'registerSuccess'=>Message::getRegisterSuccess()
	]);

});

$app->post("/manager/register", function() {

	if(isset($_POST['submit'])){
	

		if (!isset($_POST['desname']) || $_POST['desname']=='') {
			Message::setErrorRegister("Preencha o nome completo.");
			header('Location: /manager/register');
			exit;
			
		}

		if (!isset($_POST['desemail']) || $_POST['desemail']=='') {
			Message::setErrorRegister("Preencha o e-mail.");
			header('Location: /manager/register');
			exit;
		}

		if (!isset($_POST['despassword']) || $_POST['despassword']=='') {
			Message::setErrorRegister("Preencha a senha.");
			header('Location: /manager/register');
			exit;
		}

		if (User::checkLoginExist($_POST['deslogin'])) {
			Message::setErrorRegister("Este usuário já está cadastrado. Use a opção esqueci a senha.");
			header('Location: /manager/register');
			exit;
		}
	}

	$user = new User();

	$user->createUser(
		utf8_decode($_POST['desname']),
		$_POST['desemail'],
		$_POST['nrphone'],
		$_POST['deslogin'],
		User::getPasswordHash($_POST['despassword'])
	);

	if(User::checkLoginExist($_POST['deslogin'])){
		Message::setRegisterSuccess("Cadastro realizado com sucesso!");
			header('Location: /manager/register');
			exit;
	}

});


$app->post('/manager/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /manager");
	exit;

});

$app->get('/manager/logout', function() {

	User::logout();

	header("Location: /manager/login");
	exit;

});

$app->get("/manager/forgot", function() {

	$page = new PageManager([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});

$app->post("/manager/forgot", function(){

	$user = User::getForgot($_POST["email"]);

	header("Location: /manager/forgot/sent");
	exit;

});

$app->get("/manager/forgot/sent", function(){

	$page = new PageManager([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});


$app->get("/manager/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageManager([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desname"],
		"code"=>$_GET["code"]
	));

});

$app->post("/manager/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setFogotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new PageManager([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");

});

 ?>