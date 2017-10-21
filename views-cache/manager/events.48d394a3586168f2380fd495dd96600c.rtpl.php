<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Todos os Eventos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/manager"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/manager/events">Events</a></li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <div class="box-header">
              <a href="/manager/events/new/" class="btn btn-success">Novo Evento</a>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                 <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Local</th>
                  <th>Início do evento</th>
                  <th>Fim do evento</th>
                  <th>Inicio das inscrições</th>
                  <th>Fim das inscrições</th>
                  <th>Url do evento</th>
                  <th>Total de inscritos</th>
                  <th>Limite de vagas</th>
                  <th>Preço inscrição</th>
                  <th>Facebook</th>
                  <th>Instagram</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($event) && ( is_array($event) || $event instanceof Traversable ) && sizeof($event) ) foreach( $event as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo utf8_encode($value1["event_name"]); ?></td>
                  <td><?php echo utf8_encode($value1["description"]); ?></td>
                  <td><?php echo utf8_encode($value1["local"]); ?></td>
                  <td><?php echo htmlspecialchars( $value1["initial_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["end_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["regs_start"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["regs_end"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><a href="http://sgcongressos.com/event/<?php echo htmlspecialchars( $value1["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="_blank">Clique aqui</a></td>
                  <td><?php echo htmlspecialchars( $value1["subscribes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <?php if( $value1["vacancies"]==='0' ){ ?>
                    <td>Ilimitadas</td>
                 <?php }else{ ?>
                    <td><?php echo htmlspecialchars( $value1["vacancies"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                 <?php } ?>
                 <td><?php echo htmlspecialchars( $value1["price"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                 <td><?php echo htmlspecialchars( $value1["fb_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                 <td><?php echo htmlspecialchars( $value1["instagram_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    
                  <td>
                   <p> <a href="/manager/events/<?php echo htmlspecialchars( $value1["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a></p>
                     <p> <a href="/manager/events/<?php echo htmlspecialchars( $value1["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Uma vez excluido, todos os dados serão perdidos. Deseja realmente excluir este evento?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a></p>
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