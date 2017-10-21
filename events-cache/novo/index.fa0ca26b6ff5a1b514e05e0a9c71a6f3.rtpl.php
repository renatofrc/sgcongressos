<?php if(!class_exists('Rain\Tpl')){exit;}?><head>
		<title><?php echo htmlspecialchars( $event["event_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/res/event/css/skel.css" />
		<link rel="stylesheet" href="/res/event/css/style.css" />
		<link rel="stylesheet" href="/res/event/css/style-xlarge.css" />
		<link rel="stylesheet" type="text/css" href="/res/event/css/bootstrap.min.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class="landing">

		<!-- Header -->

<!-- Banner -->
			<header id="header">
				
				<h1><?php echo htmlspecialchars( $event["event_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
				
				<nav id="nav">
					<ul>
						<li><a href="#home" class="scrolly">Home</a></li>
						<li><a href="#about" class="scrolly">Sobre</a></li>
						<li><a href="#subscribe" class="scrolly">Inscrições</a></li>
						<li><a href="#contact" class="scrolly">Contato</a></li>
						
					</ul>
				</nav>
			</header>

			<section id="home" style="background-image: url(<?php echo htmlspecialchars( $event["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)">
				
			</section>

		<!-- One -->
			<section id="about" class="wrapper style1">
				<div class="center">
					<div class="container">
					    <div class="row">

					        <div class="col-sm-1"><i class="fa fa-bookmark fa-3x" aria-hidden="true"></i></div>
					        <div class="col-sm-2">
					        	<h3>Sobre o Evento</h3> 
					        	<p><?php echo htmlspecialchars( $event["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					        </div>

					       <div class="col-sm-1"><i class="fa fa-calendar fa-3x" aria-hidden="true"></i></div>
					        <div class="col-sm-2">
					       		<h3>Data</h3>
					       		<p>Inicio do Evento: <?php echo htmlspecialchars( $event["initial_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					       		<p>Fim do Evento: <?php echo htmlspecialchars( $event["end_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?> </p>
					    	</div>

					         <div class="col-sm-1"><i class="fa fa-sign-in fa-3x" aria-hidden="true"></i></div>
					        <div class="col-sm-2">
					        	<h3>Inscrições</h3>
					        	<?php if( $event["regs_start"] == '' && $event["regs_end"] == '' ){ ?>
					       			<p>Fechadas</p>
					       		<?php }else{ ?>
					       			<p>De: <?php echo htmlspecialchars( $event["regs_start"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					       			<p>Até: <?php echo htmlspecialchars( $event["regs_end"], ENT_COMPAT, 'UTF-8', FALSE ); ?> </p>
								<?php } ?>
					    	</div>

					         <div class="col-sm-1"><i class="fa fa-address-book fa-3x" aria-hidden="true"></i></div>
					        <div class="col-sm-2">
					        	<h3>Endereço e Local</h3>
					        	<p><?php echo htmlspecialchars( $event["address"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					        	<p>Cep:<?php echo htmlspecialchars( $event["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					        	<p><?php echo htmlspecialchars( $event["local"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
					        </div>

					    </div>
					   
					</div>



				</div>
			</section>
			
		
			
		<!-- CTA -->
			<section id="subscribe" class="wrapper style3">
				<h2>Inscreva-se</h2>
				<ul class="actions">

					<li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/subscribe" class="button big">aqui</a></li>
					
				</ul>
			</section>

			<section id="contact" class="wrapper style1">
				<div class="container">
					<header class="center">
						<h2>Contato</h2>
						<p>E-mail do organizador: </p>
						<p>Telefone: </p>
					</header>
					
				</div>
			</section>
			