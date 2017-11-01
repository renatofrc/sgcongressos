<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/res/admin/dist/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo htmlspecialchars( $participant["pname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/res/admin/dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  
                  <small>Membro desde <?php echo htmlspecialchars( $participant["dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-left">
                  <a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel/<?php echo htmlspecialchars( $participant["idparticipant"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-flat">Editar dados</a>
                </div>
                
                <div class="pull-right">
                  <a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      

      

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
      
        <!-- Optionally, you can add icons to the links -->
        <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/payment"><i class="fa fa-bookmark"></i> <span>Pagamento</span></a></li>
        <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/activities"><i class="fa fa-bookmark"></i> <span>Atividades</span></a></li>
        <li><a href="#"><i class="fa fa-briefcase"></i> <span>Submeter</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Home
    </h1>
    <ol class="breadcrumb">
      <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
   <section class="content">


  <div class="row">

        <?php if( $participant["status"]==1 ){ ?>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Status</h3>
         
              <p>Pago</p>
            </div>
            <div class="icon">
              <i class="ion ion-plus"></i>
            </div>
            <p class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></p>
          </div>    
         </div>  
         <?php }else{ ?>
         <?php if( $participant["status"]=='' ){ ?>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Status</h3>
         
              <p>Não Pago</p>
            </div>
            <div class="icon">
              <i class="ion ion-minus"></i>
            </div>
            <p class="small-box-footer"><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/payment" style="color: #fff">Clique aqui para pagar</a></p>
          </div>  
        </div>
        <?php } ?>  
      <?php } ?> 



    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Bem vindo <?php echo htmlspecialchars( $participant["pname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
         <div class="box-header">
          <p>Dados Cadastrais</p>
        </div>
        <form role="form" action="/panel/profile/<?php echo htmlspecialchars( $participant["idparticipant"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group col-md-6">
              <label for="pname">Nome</label>
              <input type="text" class="form-control" id="pname" name="pname" placeholder="" value="<?php echo htmlspecialchars( $participant["pname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
            <div class="form-group col-md-6">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control" id="cpf" name="cpf" placeholder=""  value="<?php echo htmlspecialchars( $participant["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
            <div class="form-group col-md-6">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder=""  value="<?php echo htmlspecialchars( $participant["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
            <div class="form-group col-md-6">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php echo htmlspecialchars( $participant["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
            <div class="form-group col-md-6">
              <label for="categoria">Categoria</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php echo htmlspecialchars( $participant["category"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
          
            <div class="form-group col-md-6">
              <label for="login">Login</label>
              <input type="text" class="form-control" id="login" name="login" placeholder="" value="<?php echo htmlspecialchars( $participant["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="">
            </div>
        </form>
      </div>
    </div>





  </div>
        

        
     

    </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper