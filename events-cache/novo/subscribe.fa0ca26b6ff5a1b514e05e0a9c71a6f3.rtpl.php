<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo htmlspecialchars( $event["event_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/res/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/res/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
   <b>Crie sua Conta
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Formulário</p>
     <?php if( $registerError!='' ){ ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars( $registerError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
    
    <form action="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/subscribe" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nome Completo" name="pname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="cpf" class="form-control" placeholder="CPF" name="cpf">
        <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="tel" class="form-control" placeholder="Telefone" name="phone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="E-mail" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group">	
		  <select class="form-control" id="sel1" name="category">
		  	<option value="" selected disabled>Selecione a categoria</option>
		    <option value="Estudante">Estudante</option>
		    <option value="Professor">Professor</option>
		    <option value="Outros">Outros</option>
		  </select>
		</div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Login" name="login">
        <span class="glyphicon glyphicon-play-circle form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" placeholder="Senha" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Repita a senha" oninput="checkPass(this)">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
  
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Registre-se</button>
        </div>
        
        <!-- /.col -->
      </div>
     	<br>
     	 <?php if( $registerSuccess!='' ){ ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars( $registerSuccess, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
    </form>


    <a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/login" class="text-center">Já tenho uma conta</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="/res/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/res/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/res/admin/plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function checkPass (input){ 
    if (input.value != document.getElementById('password').value) {
    input.setCustomValidity('As senhas não conferem');
  } else {
    input.setCustomValidity('');
  }
} 
</script>
</body>
</html>
