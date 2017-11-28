<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Profile
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Perfil</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/manager/profile/<?php echo htmlspecialchars( $user["iduser"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="email" name="desname" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desemail">Email</label>
              <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o login"  value="<?php echo htmlspecialchars( $user["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Digite o telefone"  value="<?php echo htmlspecialchars( $user["nrphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="login" class="form-control" id="login" name="deslogin" placeholder="Digite o login" value="<?php echo htmlspecialchars( $user["deslogin"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

            <div class="checkbox">
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->