<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Todas as Atividades
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

         <div class="box-header">
              <a href="/manager/activities/<?php echo htmlspecialchars( $idevent, ENT_COMPAT, 'UTF-8', FALSE ); ?>/new/" class="btn btn-success">Nova Atividade</a>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                 <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Tipo</th>
                  <th>Data</th>
                  <th>Horário inicial</th>
                  <th>Horário final</th>
                  <th>Inscritos</th>
                  <th>Vagas</th>
                  <th>Ações</th>

                </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($activity) && ( is_array($activity) || $activity instanceof Traversable ) && sizeof($activity) ) foreach( $activity as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo utf8_encode($value1["activity_name"]); ?></td>
                  <td><?php echo utf8_encode($value1["description"]); ?></td>
                  <td><?php echo htmlspecialchars( $value1["activity_type"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["data_activity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["initial_hour"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["end_hour"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["subscribes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["vacancies"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

                   <td>
                   <p> <a href="/manager/activities/<?php echo htmlspecialchars( $idevent, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idactivity"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a></p>
                     <p> <a href="/manager/activities/<?php echo htmlspecialchars( $idevent, ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a></p>
                  </td>
                  
                </tr>

                <?php } ?>
                </tbody>            
              </table>
            </div>
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>