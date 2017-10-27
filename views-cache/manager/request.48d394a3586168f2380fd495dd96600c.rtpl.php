<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dados bancários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/manager"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/manager/financial">Financial</a></li>
    
  </ol>
</section>

<!-- Main content -->
<section class="content">

      <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <?php $counter1=-1;  if( isset($bank) && ( is_array($bank) || $bank instanceof Traversable ) && sizeof($bank) ) foreach( $bank as $key1 => $value1 ){ $counter1++; ?>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo htmlspecialchars( $value1["holder_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                
                <li><a href="#">Banco <span class="pull-right badge"><?php echo htmlspecialchars( $value1["bank_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></a></li>
                <li><a href="#">Agência<span class="pull-right badge"><?php echo htmlspecialchars( $value1["agency"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></a></li>
                <li><a href="#">Conta <span class="pull-right badge"><?php echo htmlspecialchars( $value1["account"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></a></li>
                <li><a href="#">CPF <span class="pull-right badge"><?php echo htmlspecialchars( $value1["cpf_cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></a></li>
                <li><a href="#">Telefone <span class="pull-right badge"><?php echo htmlspecialchars( $value1["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></a></li>
               
              </ul>
              <?php $counter2=-1;  if( isset($event) && ( is_array($event) || $event instanceof Traversable ) && sizeof($event) ) foreach( $event as $key2 => $value2 ){ $counter2++; ?>
              <form role="form" action="/manager/financial/request/<?php echo htmlspecialchars( $value2["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
              <?php } ?>
                <input type="hidden" name="holder_name" value="<?php echo htmlspecialchars( $value1["holder_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="bank_name" value="<?php echo htmlspecialchars( $value1["bank_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="agency" value="<?php echo htmlspecialchars( $value1["agency"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="account" value="<?php echo htmlspecialchars( $value1["account"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="cpf_cnpj" value="<?php echo htmlspecialchars( $value1["cpf_cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars( $value1["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="create_user_id" value="<?php echo htmlspecialchars( $value1["create_user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                 <?php $counter2=-1;  if( isset($event) && ( is_array($event) || $event instanceof Traversable ) && sizeof($event) ) foreach( $event as $key2 => $value2 ){ $counter2++; ?>
               
                <input type="hidden" name="idevent" value="<?php echo htmlspecialchars( $value2["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <?php } ?>
                <div class="box-footer">
                  <button type="submit" class="btn btn-success">Solicitar depósito</button>
                </div>
              </form>
              <?php } ?>
           
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->