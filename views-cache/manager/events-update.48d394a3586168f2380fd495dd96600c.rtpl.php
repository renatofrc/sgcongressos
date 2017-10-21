<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dados do Evento
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
         
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/manager/events/<?php echo htmlspecialchars( $event["idevent"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">


          <div class="box-body">
            <div class="form-group">
              <label for="desname">Nome do Evento</label>
              <input type="text" class="form-control" id="desname" name="event_name" class="form-control input-lg" value="<?php echo utf8_encode($event["event_name"]); ?>">
            </div>

            <div class="form-group">
              <label>Descrição</label>
                <textarea class="form-control" rows="3" placeholder="" name="description" ><?php echo utf8_encode($event["description"]); ?></textarea>
            </div>

             <div class="form-group">
              <label>Site do evento</label>
              <div class="input-group">
                <span class="input-group-addon">sgcongressos.com/event/</span>
                <input type="text" class="form-control" name="site" value="<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
         

              <div class="form-group">
                <label>Data inicial:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="date1" name="initial_date" value="<?php echo htmlspecialchars( $event["initial_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Data final:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="date2" name="end_date" value="<?php echo htmlspecialchars( $event["end_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Inicio das inscrições:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="regs1" name="regs_start" value="<?php echo htmlspecialchars( $event["regs_start"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Fim das inscrições:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="regs2" name="regs_end" value="<?php echo htmlspecialchars( $event["regs_end"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label for="desname">Limite de vagas</label>
                <input type="text" class="form-control" id="vacancies" name="vacancies" value="<?php echo htmlspecialchars( $event["vacancies"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control input-lg" type="text" placeholder="Deixe vazio para vagas ilimitadas">
              </div>

            <div class="form-group">
              <label for="desname">Local</label>
              <input type="text" class="form-control" id="" name="local"  value="<?php echo utf8_encode($event["local"]); ?>" class="form-control input-lg" type="text" placeholder="Ex: Universidade de São Paulo">
            </div>

            <div class="form-group">
              <label for="desname">Endereço</label>
              <input type="text" class="form-control" id="" name="address" value="<?php echo utf8_encode($event["address"]); ?>" class="form-control input-lg" type="text" placeholder="Rua, número, bairro, cidade, estado, país">
            </div>

            <div class="form-group">
              <label for="desname">CEP</label>
              <input type="text" class="form-control" id="" name="cep" value="<?php echo htmlspecialchars( $event["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control input-lg" type="text">
            </div>

            <div class="form-group">
              <label for="price">Preço da inscrição</label>
              <input type="text" class="form-control" id="" name="price" value="<?php echo htmlspecialchars( $event["price"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control input-lg" type="text">
            </div>

            <div class="form-group">
              <label>Facebook do evento</label>
              <div class="input-group">
                <span class="input-group-addon">facebook.com/</span>
                <input type="text" class="form-control" placeholder="Deixe vazio se não houver" name="fb_id" value="<?php echo htmlspecialchars( $event["fb_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>

            <div class="form-group">
              <label>Instagram do evento</label>
              <div class="input-group">
                <span class="input-group-addon">instagram.com/</span>
                <input type="text" class="form-control" placeholder="deixe vazio se não houver" name="instagram_id" value="<?php echo htmlspecialchars( $event["instagram_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $event["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $event["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                </div>
              </div>
            </div>
           
           
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Atualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
document.querySelector('#file').addEventListener('change', function(){
  
    var file = new FileReader();

    file.onload = function() {
      
      document.querySelector('#image-preview').src = file.result;

    }

  file.readAsDataURL(this.files[0]);

});
</script>