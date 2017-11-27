<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Todos os Participantes
  </h1>
  <ol class="breadcrumb">
    <li><a href="/manager"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/manager/participants">Participants</a></li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header">
              <a href="/manager/participants/<?php echo htmlspecialchars( $idevent, ENT_COMPAT, 'UTF-8', FALSE ); ?>/export" class="btn btn-success">Exportar dados</a>
            </div>
            <div class="box-body no-padding">
              <table class="table table-striped">
                 <thead>
                <tr>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Telefone</th>
                  <th>E-mail</th>
                  <th>Status(Pago/Não Pago)</th>
                  <th>Categoria</th>
                 
                </tr>
                </thead>
                <tbody>
                   <?php $counter1=-1;  if( isset($participant) && ( is_array($participant) || $participant instanceof Traversable ) && sizeof($participant) ) foreach( $participant as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo utf8_decode($value1["pname"]); ?></td>
                  <td><?php echo htmlspecialchars( $value1["cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <?php if( $value1["status"]==='0' ){ ?>
                  <td>Não Pago</td>
                  <?php }else{ ?>
                  <td>Pago</td>
                  <?php } ?>
                  <td><?php echo htmlspecialchars( $value1["category"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  
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