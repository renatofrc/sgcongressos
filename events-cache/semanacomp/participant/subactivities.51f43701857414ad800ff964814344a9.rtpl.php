<?php if(!class_exists('Rain\Tpl')){exit;}?><li class="dropdown user user-menu">
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
        <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel/subactivities/"><i class="fa fa-bookmark"></i> <span>Atividades</span></a></li>
        <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel/submit/"><i class="fa fa-briefcase"></i> <span>Submeter</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>



<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Atividades inscritas
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/activities">Activities</a></li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

                <div class="box-header">
              <a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel/activities/" class="btn btn-success">Ver atividades</a>
            </div>
             

            <div class="box-body no-padding">
              <table class="table table-striped">
                 <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Tipo</th>
                  <th>Data</th>
                  <th>Inicio às</th>
                  <th>Término às</th>
                </tr>
                </thead>
                <tbody>
                 <?php $counter1=-1;  if( isset($listActivities) && ( is_array($listActivities) || $listActivities instanceof Traversable ) && sizeof($listActivities) ) foreach( $listActivities as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo htmlspecialchars( $value1["activity_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo utf8_encode($value1["description"]); ?></td>
                  <td><?php echo htmlspecialchars( $value1["activity_type"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["data_activity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["initial_hour"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["end_hour"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>        
                </tr>

           
                </tbody>  
                <?php } ?>
              </table>
            </div>
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>