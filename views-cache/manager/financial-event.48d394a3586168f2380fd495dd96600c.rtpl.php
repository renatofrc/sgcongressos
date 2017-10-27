<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Escolha o Evento
  </h1>
  <ol class="breadcrumb">
    <li><a href="/manager"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/manager/activities">Activities</a></li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

            <div class="box-body no-padding">
              <table class="table table-striped">
                 <thead>
                <tr>
                  <th>Evento</th>
                  <th>Total de inscritos</th>
                  <th>Pagamentos confirmados</th>
                  <th>Dinheiro disponível</th>
                  <th>#</th>
  
                </tr>
                </thead>
                <tbody>
                
                <tr>
                  <td><?php echo htmlspecialchars( $event["event_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $event["subscribes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $confirmedPayment, ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <?php if( $money["available_money"] == NULL ){ ?>
                  <td>0</td>
                  <?php }else{ ?>
                  <td><?php echo htmlspecialchars( $money["available_money"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <?php } ?>
                  

                  <td>
                    <?php if( $money["available_money"] == NULL ){ ?>
                    <p> Solicitar depósito indisponível </p>
                    <?php }else{ ?>
                    <p> <a href="/manager/financial/request/<?php echo htmlspecialchars( $event["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/bank" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Solicitar Depósito</a></p>
                    <?php } ?>
                    
                  </td>
                </tr>  
                </tbody>
             
              </table>
            </div>
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>