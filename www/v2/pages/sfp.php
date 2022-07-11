<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $page = 'SFP'; ?>
<?php $sfp = true; ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link rel="stylesheet" href="<?=$url?>/assets/fonts/et-lineicon/et-lineicons.css">
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
                                  <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width:40px; height:40px; cursor: pointer;"> </lord-icon>
	                              </div>
	                              <div class="add-new-contact mr-20">
                                  <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" id="adicionar" data-toggle="modal" data-target="#contactAddModal" trigger="hover" colors="primary:#333333,secondary:#16c72e" stroke="100" style="width:50px;height:50px; cursor: pointer;"> </lord-icon>            
	                              </div>
	                           </div>
                        </div>
                      <?php } ?>
                        <div class="table-responsive boder-tcc">

                            <table class="contact-list-table text-nowrap bg-white">
                                <thead>
                                    <tr>
                                         <?php if($_SESSION['perm'] == '2'){ ?>
                                        <th>
                                            <label class="custom-checkbox">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <?php } ?>
                                        <th class="text-center">Nome</th>
                                        <th>Descrição</th>
                                        <th>Alcance</th>
                                        <th>Velocidade</th>
                                        <th>Transmissao</th>
                                        <th>Fabricante</th>
                                        <th>Modelo</th>
                                        <?php if($_SESSION['perm'] == '2'){ ?>
                                        <th>Status</th>
                                        <?php } ?>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <form id="check-form" action="?" onsubmit="return false" method="post">
                                  <?php
                                    $users  = "SELECT * FROM Sfp WHERE 1 ORDER BY id DESC";
                                    $r = mysqli_query($conn, $users);
                                    while($user = mysqli_fetch_array($r)){
                                    	if($_SESSION['perm'] == '2' || $_SESSION['perm'] == '1' && $user['status']=='A' && $user['quantidade'] >= 1 ){
                                  ?>

                                  <tr>
                                  	<?php if($_SESSION['perm'] == '2'){ ?>
                                        <td>
                                            <label class="custom-checkbox">
                                                <input type="checkbox" name="check[]" value="<?=$user['id']?>">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    <?php } ?>

                                        <td>
                                          <div class="d-flex align-items-center">
                                            <div class="img mr-20">
                                                <img src="<?=$url?>/<?=$user['foto']?>" class="img-40" alt="Usuário">
                                            </div>
                                            <div class="name bold">
                                              <?=$user['nome']?>
                                            </div>
                                          </div>
                                        </td>
                                        <td><lord-icon src="https://cdn.lordicon.com/nocovwne.json" data-toggle="modal" data-target="#modal_<?=$user['id']?>" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width:45px;height:45px; cursor: pointer;"></lord-icon></td>
                                        <div class="modal fade" id="modal_<?=$user['id']?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
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
                                        <td><?=$user['alcance']?></td>
                                        <td><?=$user['velocidade']?></td>
                                        <td><?=$user['transmissao']?></td>
                                        <?php
  		                                    $query2  = "SELECT * FROM Fabricante WHERE id = {$user['fabricante_id']} ";

  		                                    $f = mysqli_query($conn, $query2);
  		                                    $fab = mysqli_fetch_array($f);
		                                    ?>
                                        <td><?=$fab['nome']?></td>
                                        <?php
		                                    $query3  = "SELECT * FROM Modelo WHERE id = {$user['modelo_id']} ";

		                                    $m = mysqli_query($conn, $query3);
		                                    $mod = mysqli_fetch_array($m);
		                                ?>
                                        <td><?=$mod['nome']?></td>

                                        <?php if($_SESSION['perm'] == '2'){
                                        if($user['status']=='A'){ ?>
                                          <td>Ativo</td>
                                        <?php }else{ ?>
                                          <td>Inativo</td>
                                        <?php } } ?>

                                        <td><?=$user['quantidade']?></td>
                                        <td class="actions">
                                            <span class="contact-edit" data-toggle="modal" onclick="PassarId('<?=$user['id']?>')" data-target="#retirar-sfp">
                                              <lord-icon src="https://cdn.lordicon.com/dnoiydox.json" trigger="hover" colors="primary:#333333,secondary:#515df3" stroke="100" style="width:40px;height:40px; cursor: pointer"></lord-icon>
                                            </span>
                                        <?php if($_SESSION['perm'] == '2'){ ?>
	                                           <span class="contact-edit" onclick="Alterar('<?=$user['id']?>','<?=$user['nome']?>', '<?=$user['descricao']?>', '<?=$user['alcance']?>','<?=$user['velocidade']?>','<?=$user['quantidade']?>','<?=$user['modelo_id']?>','<?=$user['fabricante_id']?>','<?=$user['transmissao']?>','<?=$user['foto']?>')" data-toggle="modal" data-target="#contactEditModal">
                                                <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#121331,secondary:#16c72e" stroke="100" style="width:40px;height:40px; cursor: pointer"></lord-icon>
	                                            </span>
	                                            <span class="contact-close1" onclick="Remover_user('<?=$user['id']?>')">
	                                                <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width:40px;height:40px; transform: rotate(45deg); cursor: pointer;"> </lord-icon>
	                                            </span>
	                                        </td>
                                    	<?php } ?>
                                    </tr>
                                  <?php } }?>
                                  <input type="hidden" name="modulo" value="exc-all-sfp">
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
                                 <form id="add-sfp" action="?" onsubmit="return false" method="post">

                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">

                                          <div class="attach-file style--two mb-3">
                                             <img src="<?=$url?>/assets/img/img-placeholder.png" class="profile-avatar" alt="">
                                             <div class="upload-button">
                                                <img src="<?=$url?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2">
                                                <span>Selecionar</span>
                                                <input class="file-input" type="file" id="fileUpload" name="foto" accept="image/*">
                                             </div>
                                          </div>

                                          <div class="content">
                                             <h4 class="mb-2">Selecionar imagem</h4>
                                             <p class="font-12 c4">São permitidas apenas imagens JPG, GIF ou PNG.<br> Tamanho máximo permitido: 2 Megabytes.</p>
                                          </div>
                                       

                                       <div class="content">
                                          <div class="mb-4 mt-3">
                                             <label class="bold black mb-2"  for="as_perm">Transmissao</label>
                                              <select name="transmissao" class="theme-input-style perm">
                                                <option value="">Selecione...</option>
                                                <option value="Unidirecional">Unidirecional</option>
                                                <option value="Bidirecional">Bidirecional</option>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>

                                       <div class="content">
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_perm">Fabricante</label>
                                              <select name="fabricante" class="theme-input-style perm">
                                                <option value="">Selecione...</option>

                                                <?php
                                                  $query4 = "SELECT * FROM `Fabricante` WHERE status = 'A' ";
                                                  $fab_res = mysqli_query($conn, $query4);

                                                  while($fab_w = mysqli_fetch_array($fab_res)){?>

                                                  <option value="<?=$fab_w['id']?>"> <?=$fab_w['nome']?> </option>

                                                <?php } ?>

                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>

                                       <div cclass="content">
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_perm">Modelo</label>
                                              <select name="modelo" class="theme-input-style perm">
                                                <option value="">Selecione...</option>
                                                <?php
                                                  $query5 = "SELECT * FROM `Modelo` WHERE 1";
                                                  $mod_res = mysqli_query($conn, $query5);

                                                  while($mod_w = mysqli_fetch_array($mod_res)){?>

                                                  <option value="<?=$mod_w['id']?>"> <?=$mod_w['nome']?> </option>

                                                <?php } ?>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>
                                       </div>
            
                                       <div class="contact-account-setting media-body">

                                          <h4 class="mb-4">Informações</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Título</label>
                                             <input type="text" id="as_name" class="theme-input-style" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                          
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Descrição</label>
                                             <textarea id="as_descricao" class="theme-input-style" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_unidade">Alcance</label>
                                             <input type="text" id="as_alcance" class="theme-input-style" name="alcance" placeholder="Alcance">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_unidade">Velocidade</label>
                                             <input type="text" id="as_velocidade" class="theme-input-style" name="velocidade" placeholder="Velocidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  >Quantidade</label>
                                             <input type="number"  onpaste="return false" ondrop="return false" min="0" class="theme-input-style formata_qtd" name="quantidade" placeholder="Quantidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>


                                          <div class="">
                                             <input type="hidden" name="modulo" value="add-sfp">
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
                                 <form id="edt-sfp" action="?" onsubmit="return false" method="post">

                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">

                                          <div class="attach-file style--two mb-3">
                                             <img src="<?=$url?>/assets/img/img-placeholder.png" class="profile-avatar foto-edt" alt="">
                                             <div class="upload-button">
                                                <img src="<?=$url?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2 foto-edt">
                                                <span>Selecionar</span>
                                                <input class="file-input foto-edt" type="file" id="fileUpload" name="foto" accept="image/*">
                                             </div>
                                          </div>

                                          <div class="content">
                                             <h4 class="mb-2">Selecionar imagem</h4>
                                             <p class="font-12 c4">São permitidas apenas imagens JPG, GIF ou PNG.<br> Tamanho máximo permitido: 2 Megabytes.</p>
                                          </div>
                                       

                                       <div class="content">
                                          <div class="mb-4 mt-3">
                                             <label class="bold black mb-2"  for="as_perm">Transmissao</label>
                                              <select name="transmissao" class="theme-input-style perm transmissao-edt">
                                                <option value="">Selecione...</option>
                                                <option value="Unidirecional" class="trans_Unidirecional">Unidirecional</option>
                                                <option value="Bidirecional" class="trans_Bidirecional">Bidirecional</option>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>

                                       <div class="content">
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_perm">Fabricante</label>
                                              <select name="fabricante" class="theme-input-style perm fabricante-edt">
                                                <option value="">Selecione...</option>

                                                <?php
                                                  $query4 = "SELECT * FROM `Fabricante` WHERE status = 'A' ";
                                                  $fab_res = mysqli_query($conn, $query4);

                                                  while($fab_w = mysqli_fetch_array($fab_res)){?>

                                                  <option value="<?=$fab_w['id']?>" class="fab_<?=$fab_w['id']?>"> <?=$fab_w['nome']?> </option>

                                                <?php } ?>

                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>

                                       <div cclass="content">
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_perm">Modelo</label>
                                              <select name="modelo" class="theme-input-style perm modelo-edt">
                                                <option value="">Selecione...</option>
                                                <?php
                                                  $query5 = "SELECT * FROM `Modelo` WHERE 1";
                                                  $mod_res = mysqli_query($conn, $query5);

                                                  while($mod_w = mysqli_fetch_array($mod_res)){?>

                                                  <option value="<?=$mod_w['id']?>" class="mod_<?=$mod_w['id']?>"> <?=$mod_w['nome']?> </option>

                                                <?php } ?>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>
                                       </div>
            
                                       <div class="contact-account-setting media-body">

                                          <h4 class="mb-4">Informações</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Título</label>
                                             <input type="text" id="as_name" class="theme-input-style nome-edt" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                          
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Descrição</label>
                                             <textarea id="as_descricao" class="theme-input-style descricao-edt" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_unidade">Alcance</label>
                                             <input type="text" id="as_alcance" class="theme-input-style alcance-edt" name="alcance" placeholder="Alcance">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_velocidade">Velocidade</label>
                                             <input type="text" id="as_velocidade" class="theme-input-style velocidade-edt" name="velocidade" placeholder="Velocidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  >Quantidade</label>
                                             <input type="number"  onpaste="return false" ondrop="return false" min="0" class="theme-input-style quantidade-edt formata_qtd2" name="quantidade" placeholder="Quantidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>


                                          <div class="">
                                             <input type="hidden" name="modulo" value="edt-sfp">
                                             <input type="hidden" name="id_usuario" class="id-edt"> 
                                             <button type="button" class="btn mr-4" id="enviar2">Salvar</button>
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
                     <div id="retirar-sfp" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-body" style="padding: 30px 50px 40px 60px;">
                                 <div class="contact-account-setting media-body">
                                    <h4 class="mb-4">Retirar SFP</h4>
                                    <form id="retirar-sfp" action="?" onsubmit="return false" method="post">

                                       <div class="mb-2 mt-4 d-flex flex-column">

                                          <label for="as_perm" class="bold black mb-2">Retirar equipamento para:</label>

                                          <select name="val_id_tecnico" id="sel_id_tec" class="theme-input-style val_id_tecnico" required>
                                             <option value="usuario"><?=$_SESSION['usuario']?></option>
                                             <?php
                                              $query_tec = "SELECT * FROM `Tecnico` WHERE 1";

                                              $tec_res = mysqli_query($conn, $query_tec);

                                              while($tec_w = mysqli_fetch_array($tec_res)){?>

                                                <option value="<?=$tec_w['id']?>"> <?=$tec_w['nome']?> </option>

                                              <?php } ?>
                                          </select>

                                       </div>

                                       <div class="mb-2 mt-4 d-flex flex-column">
                                          <label for="qtdadea" class="bold black mb-2">Quantidade:</label>
                                          <input type="number"  onpaste="return false" ondrop="return false" min="0" class="theme-input-style retirar_qtd qtd_sfp formata_qtd3" name="quantidade" value="" required>
                                       </div>

                                       <div class="mb-2 mt-4 d-flex flex-column">
                                          <label for="uni" class="bold black mb-2">Unidade:</label>
                                          <input type="text" id="uni_ret" class="theme-input-style unidade_sfp" name="unidade" value=""  required>
                                       </div>

                                       <div class="mb-2 mt-4 d-flex flex-column">
                                          <label for="motiv" class="bold black mb-2">Motivo:</label>
                                          <textarea name="motivo" class="theme-input-style desc_sfp" id="motiv" cols="30" rows="10"></textarea>
                                       </div>

                                       <div class="mt-4">
                                          <input type="hidden" class="id_sft_ret" id="id_sft_ret" name="id_sft_ret" value="">
                                          <button type="button" class="btn mr-4" onclick="capt()" id="ret_sfp">Retirar</button>
                                          <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
                                       </div>

                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- End Contact Edit PopUp -->
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

   <!-- ======= BEGIN sfp LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
   <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/custom-datepicker.js"></script>

   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalerts.js"></script>
   <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?=$url?>/assets/js/mask-vanilla.js"></script>


   <script>
    function PassarId(Id_edt_remv){
      document.querySelector(".id_sft_ret").value = Id_edt_remv;
    }

    function capt(){
     var quantidade = document.querySelector(".retirar_qtd").value
     var unidade_sfp = document.getElementById("uni_ret").value
     var desc_sfp = document.getElementById("motiv").value
     var sel_id_tec = document.getElementById("sel_id_tec").value
     var id_rmv = document.getElementById("id_sft_ret").value
     $.ajax({
               url: "<?=$url?>/action.php",
               data: {
                  modulo: "retirar-sfp",
                  id_tecnico: sel_id_tec,
                  qtd: quantidade,
                  unidade: unidade_sfp,
                  desc: desc_sfp,
                  id: id_rmv
               },
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Equipamento retirado com sucesso!",
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
                     text: "Encontramos problemas para retirar o equipamento.",
                     type: "error",
                  });
               },
            });
     
    }
   </script>

   <script>
      $(document).on('click', '#adicionar', function(){
        var $form_add = $('#add-sfp');
        
        $(document).ready(function(){
            $form_add.find('input, select, textarea').not('#enviar, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_add.find('input, select, textarea').not("input[name=modulo], input[name=foto]");               
            var $input;
            var valid = {valid: true, error: ''};

            all_inputs.each(function(index){
                $input = $(all_inputs[index]);

                if($input.val() == '')
                {
                    valid.valid = false;
                    valid.error = 'form';

                    $input.addClass('is-invalid');                                            
                }
                else
                {
                    $input.removeClass('is-invalid');
                }
            })    
            
            return valid;
        }            
        
        $(document).on('click', '#enviar', function(){                
            var form_valid = validateForm($form_add);

            if(form_valid.valid)    
            {                
                var form_data = new FormData($form_add[0]);
                
                $.ajax({
                    url: '<?=$url?>/action.php',
                    data: form_data,
                    type: 'POST',
                    processData: false,
                    contentType: false,

                    success: function(response){

                        response = JSON.parse(response);

                        if(response.status == 'success')
                        {
                           swal({
                                title: 'Usuário cadastrado com sucesso!',
                                text: 'Sua solicitação foi concluída com exito.',
                                type: 'success',
                                allowOutsideClick: false                               
                            }).then(function() {
                              document.location.reload(true);
                           });  
                        }
                        if(response.status == 'error')
                        {
                           swal({
                              title: 'Erro',
                              text: response.error,
                              type: 'error'
                           }).then(function() {
                              document.location.reload(true);
                           }); 
                        }
                    },
                    error: function()
                    {
                        swal({
                            title: 'Erro',
                            text: 'Encontramos problemas para cadastrar o usuário',
                            type: 'error'
                        });                        
                    }        
                })
            }
            else
            {
                if(form_valid.error == 'form')
                {
                    swal({
                        title: 'Ops!',
                        text: 'Certifique-se de completar todos os campos requeridos.',
                        type: 'error'
                    });      
                }
            }
            
        })
      });
        
    </script> 

   <script>

   function Remover_user(id_remover){
   id_rmv = id_remover;
         
   $.ajax({
      url: '<?=$url?>/action.php',
      data: {
      "modulo" : 'exc-unc-sfp',
      "id" : id_remover},
      type: 'POST',

      success: function(response){

         response = JSON.parse(response);

         if(response.status == 'success')
         {
            swal({
                  title: 'Equipamento(s) deletado(s) com sucesso!',
                  text: 'Sua solicitação foi concluída com exito.',
                  type: 'success',
                  allowOutsideClick: false                               
               }).then(function() {
               document.location.reload(true);
            });  
         }
         if(response.status == 'error')
         {
            swal({
               title: 'Erro',
               text: response.error,
               type: 'error'
            }).then(function() {
               document.location.reload(true);
            }); 
         }
      },
      error: function()
      {
         swal({
               title: 'Erro',
               text: 'Encontramos problemas para deletar o equipamento.',
               type: 'error'
         });                        
      }        
   })   
            
   }
   </script>

   <script>
        var $form_edit = $('#edt-sfp');
        
        $(document).ready(function(){
            $form_edit.find('input, select, textarea').not('#enviar2, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_edit.find('input, select, textarea').not('input[name=modulo], input[name=id_user], input[name=foto]');               
            var $input;
            var valid = {valid: true, error: ''};

            all_inputs.each(function(index){
                $input = $(all_inputs[index]);

                if($input.val() == '')
                {
                    valid.valid = false;
                    valid.error = 'form';

                    $input.addClass('is-invalid');                                            
                }
                else
                {
                    $input.removeClass('is-invalid');
                }
            })    
            
            return valid;
        }            
        
        $(document).on('click', '#enviar2', function(){                
            var form_valid = validateForm($form_edit);

            if(form_valid.valid)    
            {                
                var form_data = new FormData($form_edit[0]);
                
                $.ajax({
                    url: '<?=$url?>/action.php',
                    data: form_data,
                    type: 'POST',
                    processData: false,
                    contentType: false,

                    success: function(response){

                        response = JSON.parse(response);

                        if(response.status == 'success')
                        {
                           swal({
                                title: 'Usuário atualizado com sucesso!',
                                text: 'Sua solicitação foi concluída com exito.',
                                type: 'success',
                                allowOutsideClick: false                               
                            }).then(function() {
                              document.location.reload(true);
                           });  
                        }
                        if(response.status == 'error')
                        {
                           swal({
                              title: 'Erro',
                              text: response.error,
                              type: 'error'
                           }).then(function() {
                              document.location.reload(true);
                           }); 
                        }
                    },
                    error: function()
                    {
                        swal({
                            title: 'Erro',
                            text: 'Encontramos problemas para cadastrar o usuário',
                            type: 'error'
                        });                        
                    }        
                })
            }
            else
            {
                if(form_valid.error == 'form')
                {
                    swal({
                        title: 'Ops!',
                        text: 'Certifique-se de completar todos os campos requeridos.',
                        type: 'error'
                    });      
                }
            }
            
        })
    </script> 
    <script>
        var $check_form = $('#check-form');        
        
        $(document).on('click', '.delete_mail', function(){
           
         var form_data = $check_form.serialize();
                
         $.ajax({
            url: '<?=$url?>/action.php',
            data: form_data,
            type: 'POST',

            success: function(response){

               response = JSON.parse(response);

               if(response.status == 'success')
               {
                  swal({
                        title: 'Equipamento(s) deletado(s) com sucesso!',
                        text: 'Sua solicitação foi concluída com exito.',
                        type: 'success',
                        allowOutsideClick: false                               
                     }).then(function() {
                     document.location.reload(true);
                  });  
               }
               if(response.status == 'error')
               {
                  swal({
                     title: 'Erro',
                     text: response.error,
                     type: 'error'
                  }).then(function() {
                     document.location.reload(true);
                  }); 
               }
            },
            error: function()
            {
               swal({
                     title: 'Erro',
                     text: 'Encontramos problemas para deletar o equipamento.',
                     type: 'error'
               });                        
            }        
         })            
        })
    </script> 

      <script>

      </script>

<!-- <script>
         $(document).on("click","#ret_sfp",function() {

            // val_id_tecnico1 = $(".val_id_tecnico").val();
            // qtd_sfp = $('.qtd_sfp').val();
            // unidade_sfp = $('.unidade_sfp').val();
            // desc_sfp = $('.desc_sfp').val();

            


            id_rmv = $('.id_sfp').val();

            $.ajax({
               url: "<?=$url?>/action.php",
               data: {
                  modulo: "retirar-sfp",
                  id_tecnico: val_id_tecnico1,
                  qtd: qtd_sfp,
                  unidade: unidade_sfp,
                  desc: desc_sfp,
                  id: id_rmv
               },
               type: "POST",

               success: function (response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Equipamento retirado com sucesso!",
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
                     text: "Encontramos problemas para retirar o equipamento.",
                     type: "error",
                  });
               },
            });
         });
      </script> -->

      <script type="text/javascript">         

      function Alterar(id, nome, descricao, alcance, velocidade, quantidade, modelo, fabricante, transmissao, foto){
      var foto_url = '<?=$url?>'+ '/' + foto;

      document.querySelector(".id-edt").value = id;
      document.querySelector(".nome-edt").value = nome;
      document.querySelector(".descricao-edt").value = descricao;
      document.querySelector(".alcance-edt").value = alcance;
      document.querySelector(".velocidade-edt").value = velocidade;
      document.querySelector(".quantidade-edt").value = quantidade;
      document.querySelector(".foto-edt").src = foto_url;
      document.querySelector(".trans_" + transmissao).selected="selected";
      document.querySelector(".fab_" + fabricante).selected="selected";
      document.querySelector(".mod_" + modelo).selected="selected";
      
      }


      </script>

      <!-- <script>
         document.querySelector('.formata_qtd').onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if ("1234567890".indexOf(chr) < 0)
            return false;
         };      
      </script>
      <script>
         $(".formata_qtd").bind('paste', function(e) {
         e.preventDefault();
         });
         $(".formata_qtd").bind('drop', function(e) {
         e.preventDefault();
         });
      </script>
      <script>
         document.querySelector('.formata_qtd').autocomplete = "off";
      </script> -->

      <script>
         function inputHandler(masks, max, event) {
         var c = event.target;
         var v = c.value.replace(/\D/g, '');
         var m = c.value.length > max ? 1 : 0;
         VMasker(c).unMask();
         VMasker(c).maskPattern(masks[m]);
         c.value = VMasker.toPattern(v, masks[m]);
         }

         var telMask = ['999', '999'];

         var tel1 = document.querySelector('.formata_qtd');
         VMasker(tel1).maskPattern(telMask[0]);
         tel1.addEventListener('input', inputHandler.bind(undefined, telMask, 3), false);

         var tel2 = document.querySelector('.formata_qtd2');
         VMasker(tel2).maskPattern(telMask[0]);
         tel2.addEventListener('input', inputHandler.bind(undefined, telMask, 3), false);

         var tel3 = document.querySelector('.formata_qtd3');
         VMasker(tel3).maskPattern(telMask[0]);
         tel3.addEventListener('input', inputHandler.bind(undefined, telMask, 3), false);

      </script>


</body>

</html>