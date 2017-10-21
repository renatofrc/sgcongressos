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
                  <th>Atividades</th>
                  <th>#</th>
  
                </tr>
                </thead>
                <tbody>
                 <?php $counter1=-1;  if( isset($event) && ( is_array($event) || $event instanceof Traversable ) && sizeof($event) ) foreach( $event as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo utf8_encode($value1["event_name"]); ?></td>
                  <td><?php echo htmlspecialchars( $value1["activities"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><p> <a href="/manager/activities/<?php echo htmlspecialchars( $value1["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Ver Lista</a></p></td>
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