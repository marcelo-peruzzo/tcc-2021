<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $page = 'Chaves'; ?>
<?php $chave = true; ?>
<!DOCTYPE html>
<html lang="pt-br">
   <?php include 'includes/head.php'; ?>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
   <link rel="stylesheet" href="<?=$url?>/assets/fonts/et-lineicon/et-lineicons.css" />
   <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
   <body>
      <!-- Offcanval Overlay -->
      <div class="offcanvas-overlay"></div>
      <!-- Offcanval Overlay -->

      <!-- Wrapper -->
      <div class="wrapper">
         <!-- Header -->

         <?php include 'includes/header.php'; ?>

         <!-- Main Wrapper -->
         <div class="main-wrapper">
            <!-- Sidebar -->

            <?php include 'includes/aside.php'; ?>

            <!-- Main Content -->
            <div class="main-content d-flex flex-column flex-md-row">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <!-- Card -->
                        <div class="card bg-transparent">
                           <?php if($_SESSION['perm'] == '2'){ ?>
                           <div class="contact-header d-flex align-items-sm-center media flex-column flex-sm-row bg-white mb-30 boder-tcc">
                              <div class="contact-header-left media-body d-flex align-items-center mr-4">
                              </div>
                              <div class="contact-header-right d-flex align-items-center justify-content-end mt-3 mt-sm-0">
                                 <div class="delete_mail">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width: 40px; height: 40px; cursor: pointer;"> </lord-icon>
                                 </div>

                                 <div class="add-new-contact mr-20">
                                    <lord-icon
                                       src="https://cdn.lordicon.com/mecwbjnp.json"
                                       id="adicionar"
                                       data-toggle="modal"
                                       data-target="#contactAddModal"
                                       trigger="hover"
                                       colors="primary:#333333,secondary:#16c72e"
                                       stroke="100"
                                       style="width: 50px; height: 50px; cursor: pointer;"
                                    >
                                    </lord-icon>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="table-responsive boder-tcc">
                              <table class="contact-list-table text-nowrap bg-white">
                                 <thead>
                                    <tr>
                                       <?php if($_SESSION['perm'] == '2'){ ?>
                                       <td>
                                          <label class="custom-checkbox">
                                             <input type="checkbox" />
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <?php } ?>
                                       <th class="text-center">Nome</th>
                                       <th>Descrição</th>
                                       <th>Unidade</th>
                                       <th>Disponíbilidade</th>
                                       <?php if($_SESSION['perm'] == '2'){ ?>
                                       <th>Status</th>
                                       <?php } ?>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <form id="check-form" action="?" onsubmit="return false" method="post">
                                       <?php
                                    $users  = "SELECT * FROM Chave WHERE 1 ORDER BY id DESC";
                                    $r = mysqli_query($conn, $users);
                                    while($user = mysqli_fetch_array($r)){
                                    	if($_SESSION['perm'] == '2' || $_SESSION['perm'] == '1' & $user['status']=='A'){
                                  ?>

                                       <tr>
                                          <?php if($_SESSION['perm'] == '2'){ ?>
                                          <td>
                                             <label class="custom-checkbox">
                                                <input type="checkbox" name="check[]" value="<?=$user['id']?>" />
                                                <span class="checkmark"></span>
                                             </label>
                                          </td>
                                          <?php } ?>

                                          <td>
                                             <div class="d-flex align-items-center">
                                                <div class="img mr-20">
                                                   <img src="<?=$url?>/<?=$user['foto']?>" class="img-40" alt="" />
                                                </div>
                                                <div class="name bold">
                                                   <?=$user['nome']?>
                                                </div>
                                             </div>
                                          </td>
                                          <td>
                                             <lord-icon
                                                src="https://cdn.lordicon.com/nocovwne.json"
                                                data-toggle="modal"
                                                data-target="#ModalCenter<?=$user['id']?>"
                                                trigger="hover"
                                                colors="primary:#333333,secondary:#f7402e"
                                                stroke="100"
                                                style="width: 45px; height: 45px; cursor: pointer;"
                                             ></lord-icon>
                                          </td>

                                          <div class="modal fade" id="ModalCenter<?=$user['id']?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="ModalLongTitle">Descrição</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <?=$user['descricao']?>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <td><?=$user['unidade']?></td>

                                          <?php  if($user['disponibilidade']=='D'){ ?>
                                          <td><p class="alert alert-success">Disponível</p></td>
                                          <?php }else{ ?>
                                          <td>
                                             <p class="alert alert-danger" style="padding: 0.25rem 1.25rem;">
                                                Indisponível
                                                <lord-icon
                                                   src="https://cdn.lordicon.com/wxnxiano.json"
                                                   stroke="100"
                                                   data-toggle="modal"
                                                   data-target="#ModalCenter1-<?=$user['id']?>"
                                                   trigger="morph"
                                                   colors="primary:#333333,secondary:#f7402e"
                                                   style="width: 40px; height: 40px; cursor: pointer;"
                                                ></lord-icon>
                                             </p>
                                          </td>

                                          <div class="modal fade" id="ModalCenter1-<?=$user['id']?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="ModalLongTitle">Descrição</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <?php if(!isset($user['Tecnico_id'])){ 
	                                                $query2  = "SELECT * FROM Usuario WHERE id = {$user['Usuario_id']} ";
	                                                $u = mysqli_query($conn, $query2);
	                                                $use = mysqli_fetch_array($u);
	                                                ?>

                                                      Usuario(a)
                                                      <?=$use['nome']?>
                                                      retirou a chave as
                                                      <?=$user['uptime']?>

                                                      <?php } else{
	                                                $query2  = "SELECT * FROM Usuario WHERE id = {$user['Usuario_id']} ";
	                                                $u = mysqli_query($conn, $query2);
	                                                $use = mysqli_fetch_array($u);

	                                                $query3  = "SELECT * FROM Tecnico WHERE id = {$user['Tecnico_id']} ";
	                                                $t = mysqli_query($conn, $query3);
	                                                $tec = mysqli_fetch_array($t);
	                                                ?>

                                                      Usuario(a)
                                                      <?=$use['nome']?>
                                                      retirou a chave e entregou para o técnico
                                                      <?=$tec['nome']?>
                                                      as
                                                      <?=$user['uptime']?>
                                                      <?php } ?>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <?php }  ?>

                                          <?php if($_SESSION['perm'] == '2'){
                                        if($user['status']=='A'){ ?>
                                          <td>Ativo</td>
                                          <?php }else{ ?>
                                          <td>Inativo</td>
                                          <?php } } ?>

                                          <td><?=$user['quantidade']?></td>
                                          <td class="actions">
                                          	<?php
	                                          	if ($user['disponibilidade']=='D') { ?>
	                                             <span class="contact-edit" data-toggle="modal" onclick="PassarId_Ret('<?=$user['id']?>')" data-target="#ModalCenter-2">
                                                   <img src="<?=$url?>/assets/img/svg/key-outlineD.svg" stroke="100" style="width: 40px; height: 40px; cursor: pointer;">
	                                             </span>

                                         	<?php }else{ ?>
                                         		<span class="contact-edit" data-toggle="modal" onclick="PassarId_Dev('<?=$user['id']?>')" data-target="#ModalCenter-3">
	                                                <img src="<?=$url?>/assets/img/svg/key-outline.svg" stroke="100" style="width: 40px; height: 40px; cursor: pointer;">
	                                             </span>

                                         	<?php } ?>
                                             

                                             <?php if($_SESSION['perm'] == '2'){ ?>
                                             <span
                                                class="contact-edit"
                                                data-toggle="modal"
                                                data-target="#contactEditModal"
                                                onclick="Alterar('<?=$user['id']?>','<?=$user['nome']?>','<?=$user['descricao']?>', '<?=$user['unidade']?>', '<?=$user['status']?>','<?=$user['foto']?>')"
                                             >
                                                <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#121331,secondary:#16c72e" stroke="100" style="width: 40px; height: 40px; cursor: pointer;"></lord-icon>
                                             </span>
                                             <span class="contact-close1" onclick=" Remover_chave('<?=$user['id']?>')">
                                                <lord-icon
                                                   src="https://cdn.lordicon.com/mecwbjnp.json"
                                                   trigger="hover"
                                                   colors="primary:#333333,secondary:#f7402e"
                                                   stroke="100"
                                                   style="width: 40px; height: 40px; transform: rotate(45deg); cursor: pointer;"
                                                >
                                                </lord-icon>
                                             </span>
                                          </td>
                                          <?php } ?>
                                       </tr>
                                       <?php } }?>
                                       <input type="hidden" name="modulo" value="exc-all-chave" />
                                    </form>
                                 </tbody>
                              </table>
                              <!-- End Invoice List Table -->
                           </div>
                        </div>
                        <!-- End Card -->

                        <!-- Contact Add New PopUp -->
                        <div id="contactAddModal" class="modal fade">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <!-- Modal Body -->
                                 <div class="modal-body">
                                    <form id="add-chave" action="?" onsubmit="return false" method="post">
                                       <div class="media flex-column flex-sm-row">
                                          <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                             <div class="attach-file style--two mb-3">
                                                <img src="<?=$url?>/assets/img/img-placeholder.png" class="profile-avatar" alt="" />
                                                <div class="upload-button">
                                                   <img src="<?=$url?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2" />
                                                   <span>Selecionar</span>
                                                   <input class="file-input" type="file" id="fileUpload" name="foto" accept="image/*" />
                                                </div>
                                             </div>

                                             <div class="content">
                                                <h4 class="mb-2">Selecionar imagem</h4>
                                                <p class="font-12 c4">
                                                   São permitidas apenas imagens JPG, GIF ou PNG.<br />
                                                   Tamanho máximo permitido: 2 Megabytes.
                                                </p>
                                             </div>
                                          </div>

                                          <div class="contact-account-setting media-body">
                                             <h4 class="mb-4">Dados da Chave</h4>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_name">Nome</label>
                                                <input type="text" id="as_name" class="theme-input-style" name="nome" placeholder="Nome" />
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_descricao">Descrição</label>
                                                <textarea id="as_descricao" class="theme-input-style" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_unidade">Unidade</label>
                                                <input type="text" id="as_unidade" class="theme-input-style" name="unidade" placeholder="Unidade" />
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="">
                                                <input type="hidden" name="modulo" value="add-chave" />
                                                <button type="button" class="btn mr-4" id="enviar">Adicionar</button>
                                                <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                                 <!-- End Modal Body -->
                              </div>
                           </div>
                        </div>
                        <!-- End Contact Add New PopUp -->

                        <!-- Contact Edit PopUp -->
                        <div id="contactEditModal" class="modal fade">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <!-- Modal Body -->
                                 <div class="modal-body">
                                    <form id="edt-chave" action="?" onsubmit="return false" method="post">
                                       <div class="media flex-column flex-sm-row">
                                          <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                             <div class="attach-file style--two mb-3">
                                                <img src="<?=$url?>/assets/img/img-placeholder.png" class="profile-avatar img-edt" alt="" />
                                                <div class="upload-button">
                                                   <img src="<?=$url?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2 img-edt" />
                                                   <span>Selecionar</span>
                                                   <input class="file-input" type="file" id="fileUpload2" name="foto" accept="image/*" />
                                                </div>
                                             </div>

                                             <div class="content">
                                                <h4 class="mb-2">Selecionar imagem</h4>
                                                <p class="font-12 c4">
                                                   São permitidas apenas imagens JPG, GIF ou PNG.<br />
                                                   Tamanho máximo permitido: 2 Megabytes.
                                                </p>
                                             </div>

                                             <div class="mb-2 mt-4">
                                                <label for="as_perm" class="bold black mb-2">Status</label>
                                                <select name="status" class="theme-input-style">
                                                   <option selected="" class="stt_opt_1" value="A">Ativo</option>
                                                   <option selected="" class="stt_opt_2" value="I">Inativo</option>
                                                </select>
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>
                                          </div>

                                          <div class="contact-account-setting media-body">
                                             <h4 class="mb-4">Dados da Chave</h4>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_name">Nome</label>
                                                <input type="text" id="as_name" class="theme-input-style nome-edt" name="nome" placeholder="Nome" />
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_descricao">Descrição</label>
                                                <textarea id="as_descricao" class="theme-input-style descricao-edt" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_unidade">Unidade</label>
                                                <input type="text" id="as_unidade" class="theme-input-style unidade-edt" name="unidade" placeholder="Unidade" />
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>

                                             <div class="">
                                                <input type="hidden" class="edt-input" name="modulo" value="edt-chave" />
                                                <input type="hidden" class="id_usuario" name="id_usuario" value="" />
                                                <button type="button" class="btn mr-4" id="enviar2">Alterar</button>
                                                <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                                 <!-- End Modal Body -->
                              </div>
                           </div>
                        </div>
                        <!-- End Contact Edit PopUp -->
                        <div id="ModalCenter-2" class="modal fade">
	                        <div class="modal-dialog modal-dialog-centered">
	                           <div class="modal-content">
	                              <div class="modal-body" style="padding: 30px 50px 40px 60px;">
	                                 <div class="contact-account-setting media-body">
	                                    <h4 class="mb-4">Retirar Chave</h4>
	                                    <form id="retirar-chave" action="?" onsubmit="return false" method="post">
	                                       <div class="mb-2 mt-4 d-flex flex-column">
	                                          <label for="as_perm" class="bold black mb-2">Retirar chave para:</label>
	                                          <select name="val_id_tecnico" id="val_id_tecnico" class="theme-input-style val_id_tecnico">
	                                             <option value="usuario">
	                                                <?=$_SESSION['usuario']?>
	                                                (EU)
	                                             </option>
	                                             <?php
	                                               $query_tec = "SELECT * FROM `Tecnico` WHERE 1";

	                                               $tec_res = mysqli_query($conn, $query_tec);

	                                               while($tec_w = mysqli_fetch_array($tec_res)){?>

	                                             <option value="<?=$tec_w['id']?>"> <?=$tec_w['nome']?> </option>

	                                             <?php } ?>
	                                          </select>
	                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
	                                       </div>
	                                       <div class="mt-4">
	                                       	  <input type="hidden" class="id_chave_r" id="id_chave_r" name="id_chave_r" value="">
	                                          <button type="button" class="btn mr-4" onclick="Retirar_chave()" id="enviar3">Retirar</button>
	                                          <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
	                                       </div>
	                                    </form>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>

	                     <div id="ModalCenter-3" class="modal fade">
	                        <div class="modal-dialog modal-dialog-centered">
	                           <div class="modal-content">
	                              <div class="modal-body" style="padding: 30px 50px 40px 60px;">
	                                 <div class="contact-account-setting media-body">
	                                    <h4 class="mb-4">Deseja realmente devolver esta chave:</h4>
	                                        <div class="mt-4">
	                                           <input type="hidden" class="id_chave_d" id="id_chave_d" name="id_chave_d" value="">
	                                           <button type="button" class="btn mr-4" onclick="Devolver_chave() " id="enviar4">Devolver chave</button>
	                                           <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
	                                        </div>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>

                     </div>
                  </div>
               </div>
            </div>
            <!-- End Main Content -->
         </div>
         <!-- End Main Wrapper -->

         <!-- Footer -->
         <?php include 'includes/footer.php'; ?>
         <!-- End Footer -->
      </div>
      <!-- End wrapper -->

      <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
      <script src="<?=$url?>/assets/js/jquery.min.js"></script>
      <script src="<?=$url?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?=$url?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script src="<?=$url?>/assets/js/script.js"></script>
      <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

      <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
      <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
      <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/custom-datepicker.js"></script>
      <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
      <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
      <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalerts.js"></script>



      <script>

      	function PassarId_Ret(Id_edt_dev) {
	      document.querySelector(".id_chave_r").value = Id_edt_dev;

	    }


        function Retirar_chave() {
        	var id_rmv = document.getElementById("id_chave_r").value
        	var val_id_tecnico1 = document.getElementById("val_id_tecnico").value


            $.ajax({
               url: "<?=$url?>/action.php",
               data: {
                  modulo: "retirar-chave",
                  id_tecnico: val_id_tecnico1,
                  id: id_rmv,
               },
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Chave retirada com sucesso!",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
               },
               error: function () {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para retirar a chave",
                     type: "error",
                  });
               },
            });
         }
      </script>

      <script>

      	function PassarId_Dev(Id_edt_dev) {
	      document.querySelector(".id_chave_d").value = Id_edt_dev;
	    }

        function Devolver_chave() {

         	var id_rmv = document.getElementById("id_chave_d").value

            $.ajax({
               url: "<?=$url?>/action.php",
               data: {
                  modulo: "dev-chave",
                  id: id_rmv,
               },
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Devolvido chave com sucesso",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
               },
               error: function () {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para retirar a chave",
                     type: "error",
                  });
               },
            });
        }
      </script>

      <script>
         function Remover_chave(id_remover) {
            id_rmv = id_remover;

            $.ajax({
               url: "<?=$url?>/action.php",
               data: {
                  modulo: "exc-unc-chave",
                  id: id_remover,
               },
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Usuário(s) deletado(s) com sucesso!",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
               },
               error: function () {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para deletar o usuário",
                     type: "error",
                  });
               },
            });
         }
      </script>

      <script type="text/javascript">
         function Alterar(id12, nome_edt, descricao_edt, unidade_edt, status_edt, foto_edt) {
            var foto_url = "<?=$url?>" + "/" + foto_edt;

            document.querySelector(".img-edt").src = foto_url;
            document.querySelector(".nome-edt").value = nome_edt;
            document.querySelector(".descricao-edt").value = descricao_edt;
            document.querySelector(".unidade-edt").value = unidade_edt;
            document.querySelector(".id_usuario").value = id12;

            if (status_edt == "A") {
               document.querySelector(".stt_opt_1").selected = "selected";
            } else {
               document.querySelector(".stt_opt_2").selected = "selected";
            }
         }
      </script>

      <script>
         $(document).on("click", "#adicionar", function () {
            var $form_add = $("#add-chave");

            $(document).ready(function () {
               $form_add.find("input, select, textarea").not("#enviar, input[name=modulo]").val("");
            });

            function validateForm($form) {
               var all_inputs = $form_add.find("input, select, textarea").not("input[name=modulo], input[name=foto]");
               var $input;
               var valid = { valid: true, error: "" };

               all_inputs.each(function (index) {
                  $input = $(all_inputs[index]);

                  if ($input.val() == "") {
                     valid.valid = false;
                     valid.error = "form";

                     $input.addClass("is-invalid");
                  } else {
                     $input.removeClass("is-invalid");
                  }
               });

               return valid;
            }

            $(document).on("click", "#enviar", function () {
               var form_valid = validateForm($form_add);

               if (form_valid.valid) {
                  var form_data = new FormData($form_add[0]);

                  $.ajax({
                     url: "<?=$url?>/action.php",
                     data: form_data,
                     type: "POST",
                     processData: false,
                     contentType: false,

                     success: function (response) {
                        response = JSON.parse(response);

                        if (response.status == "success") {
                           swal({
                              title: "Usuário cadastrado com sucesso!",
                              text: "Sua solicitação foi concluída com exito.",
                              type: "success",
                              allowOutsideClick: false,
                           }).then(function () {
                              document.location.reload(true);
                           });
                        }
                        if (response.status == "error") {
                           swal({
                              title: "Erro",
                              text: response.error,
                              type: "error",
                           }).then(function () {
                              document.location.reload(true);
                           });
                        }
                     },
                     error: function () {
                        swal({
                           title: "Erro",
                           text: "Encontramos problemas para cadastrar o usuário",
                           type: "error",
                        });
                     },
                  });
               } else {
                  if (form_valid.error == "form") {
                     swal({
                        title: "Ops!",
                        text: "Certifique-se de completar todos os campos requeridos.",
                        type: "error",
                     });
                  }
               }
            });
         });
      </script>

      <script>
         var $form_edit = $("#edt-chave");

         $(document).ready(function () {
            $form_edit.find("input, select, textarea").not("#enviar2, input[name=modulo]").val("");
         });

         function validateForm($form) {
            var all_inputs = $form_edit.find("input, select, textarea").not("input[name=modulo], input[name=foto], input[name=id_user]");
            var $input;
            var valid = { valid: true, error: "" };

            all_inputs.each(function (index) {
               $input = $(all_inputs[index]);

               if ($input.val() == "") {
                  valid.valid = false;
                  valid.error = "form";

                  $input.addClass("is-invalid");
               } else {
                  $input.removeClass("is-invalid");
               }
            });

            return valid;
         }

         $(document).on("click", "#enviar2", function () {
            var form_valid = validateForm($form_edit);

            if (form_valid.valid) {
               var form_data = new FormData($form_edit[0]);

               $.ajax({
                  url: "<?=$url?>/action.php",
                  data: form_data,
                  type: "POST",
                  processData: false,
                  contentType: false,

                  success: function (response) {
                     response = JSON.parse(response);

                     if (response.status == "success") {
                        swal({
                           title: "Usuário atualizado com sucesso!",
                           text: "Sua solicitação foi concluída com exito.",
                           type: "success",
                           allowOutsideClick: false,
                        }).then(function () {
                           document.location.reload(true);
                        });
                     }
                     if (response.status == "error") {
                        swal({
                           title: "Erro",
                           text: response.error,
                           type: "error",
                        }).then(function () {
                           document.location.reload(true);
                        });
                     }
                  },
                  error: function () {
                     swal({
                        title: "Erro",
                        text: "Encontramos problemas para cadastrar o usuário",
                        type: "error",
                     });
                  },
               });
            } else {
               if (form_valid.error == "form") {
                  swal({
                     title: "Ops!",
                     text: "Certifique-se de completar todos os campos requeridos.",
                     type: "error",
                  });
               }
            }
         });
      </script>

      <script>
         var $check_form = $("#check-form");

         $(document).on("click", ".delete_mail", function () {
            var form_data = $check_form.serialize();

            $.ajax({
               url: "<?=$url?>/action.php",
               data: form_data,
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Usuário(s) deletado(s) com sucesso!",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function () {
                        document.location.reload(true);
                     });
                  }
               },
               error: function () {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para deletar o usuário",
                     type: "error",
                  });
               },
            });
         });
      </script>
   </body>
</html>
