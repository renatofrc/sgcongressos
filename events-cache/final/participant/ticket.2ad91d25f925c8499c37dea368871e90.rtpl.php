<?php if(!class_exists('Rain\Tpl')){exit;}?><script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script type="text/javascript">
 // public_key_production  APP_USR-4eeafa3d-0cc1-4b29-bff5-fd8979e79436 
 // public_key_Sandbox TEST-f31cc86f-c8ad-4620-829b-29e765bbfac8
Mercadopago.setPublishableKey("APP_USR-4eeafa3d-0cc1-4b29-bff5-fd8979e79436");
</script>

<!-- User Account Menu -->
          <li class="dropdown user user-menu">
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
        <li><a href="#"><i class="fa fa-bookmark"></i> <span>Atividades</span></a></li>
        <li><a href="#"><i class="fa fa-briefcase"></i> <span>Submeter</span></a></li>
        
      </ul> 
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pagamento por boleto
    </h1>
    <ol class="breadcrumb">
      <li><a href="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/panel"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
   <section class="content">


  <div class="row">

    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">

             <form role="form" action="/event/<?php echo htmlspecialchars( $event["site"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/ticket" method="post">
              <div class="box-body">
                 <?php if( $msgError!='' ){ ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>
                    
                  <div class="form-group">
                      <label for="first_name">Nome</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" value="" class="form-control input-md" type="text" >
                    </div>

                     <div class="form-group">
                      <label for="last_name">Sobrenome</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" value="" class="form-control input-md" type="text" >
                    </div>

                    <div class="form-group">
                      <label for="cpf">CPF</label>
                      <input type="cpf" class="form-control" id="cpf" name="cpf" value="" class="form-control input-md" type="text" placeholder="20143567689">
                    </div>

                  <div class="form-group">
                      <label for="email">E-mail</label>
                      <input type="email" class="form-control" id="email" name="email" value="" class="form-control input-md" type="text" placeholder="E-mail de cadastro">
                    </div>

                   <!--  <div class="form-group col-md-4">
                      <label for="tel">DDD</label>
                      <input type="tel" class="form-control " id="tel" name="ddd" value="" class="form-control input-md" type="text" placeholder="34">
                    </div>

                    <div class="form-group col-md-8">
                      <label for="phone">Telefone</label>
                      <input type="tel" class="form-control" id="phone" name="phone" value="" class="form-control input-md" type="text" placeholder="999999999">
                    </div> -->

                     <div class="form-group">
                      <label for="street_name">Endereço</label>
                      <input type="text" class="form-control" id="street_name" name="street_name" value="" class="form-control input-md" type="text" placeholder="Rua">
                    </div>

                    <div class="form-group">
                      <label for="neighborhood">Bairro</label>
                      <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="" class="form-control input-md" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                      <label for="street_number">Número da casa</label>
                      <input type="text" class="form-control" id="street_number" name="street_number" value="" class="form-control input-md" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                      <label for="city">Cidade</label>
                      <input type="text" class="form-control" id="city" name="city" value="" class="form-control input-md" type="text" placeholder="">
                    </div>

                    <div class="form-group">  
                      <select class="form-control" id="state" name="state">
                        <option value="" selected disabled>Selecione o estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="cep">CEP</label>
                      <input type="cep" class="form-control" id="cep" name="cep" value="" class="form-control input-md" type="text" placeholder="38300-120">
                    </div>

                    <div class="form-group">
                      <label for="price">Preço</label>
                      <input type="text" class="form-control" id="price" name="" value="R$ <?php echo htmlspecialchars( $event["price"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control input-md" type="text" disabled>
                    </div>

                    <div class="box-footer">
                    <button id ="generate" type="submit" name="button" class="btn btn-success">Gerar Boleto</button>
                  </div>

              </form>
            </div>


        </div>
      </div>
    </div>
 </div>
</section>
</div>