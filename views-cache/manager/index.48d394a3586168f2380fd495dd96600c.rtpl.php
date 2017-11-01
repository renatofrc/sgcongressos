<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Home
    </h1>
    <ol class="breadcrumb">
      <li><a href="/manager"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo htmlspecialchars( $events, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

              <p>Meus Eventos</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <p class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></p>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php if( $subscribes==NULL ){ ?>
              <h3>0</h3>
              <?php }else{ ?>
              <h3><?php echo htmlspecialchars( $subscribes, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
              <?php } ?>
              <p>Total de Cadastrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <p class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></p>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo htmlspecialchars( $payments, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

              <p>Pagamentos Confirmados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <p class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></p>
          </div>
        </div>

        
        <!-- ./col -->
      </div>
    <!-- Your Page Content Here -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper