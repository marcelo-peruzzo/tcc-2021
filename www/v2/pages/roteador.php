<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $page = 'Roteador'; ?>
<?php $roteador = true; ?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/head.php'; ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link rel="stylesheet" href="<?= $url ?>/assets/fonts/et-lineicon/et-lineicons.css" />
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

         <?php include 'includes/aside.php';?>

         <!-- Main Content -->
         <div class="main-content d-flex flex-column flex-md-row">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
                     <!-- Card -->
                     <div class="card bg-transparent">
                        <?php if ($_SESSION['perm'] == '2') { ?>
                           <div class="contact-header d-flex align-items-sm-center media flex-column flex-sm-row bg-white mb-30 boder-tcc">
                              <div class="contact-header-left media-body d-flex align-items-center mr-4">
                              </div>
                              <div class="contact-header-right d-flex align-items-center justify-content-end mt-3 mt-sm-0">
                                 <div class="delete_mail">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width: 40px; height: 40px; cursor: pointer;"> </lord-icon>
                                 </div>

                                 <div class="add-new-contact mr-20">
                                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" id="adicionar" data-toggle="modal" data-target="#contactAddModal" trigger="hover" colors="primary:#333333,secondary:#16c72e" stroke="100" style="width: 50px; height: 50px; cursor: pointer;">
                                    </lord-icon>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                        <div class="table-responsive boder-tcc">
                           <table class="contact-list-table text-nowrap bg-white">
                              <thead>
                                 <tr>
                                    <?php if ($_SESSION['perm'] == '2') { ?>
                                       <td>
                                          <label class="custom-checkbox">
                                             <input type="checkbox" />
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                    <?php } ?>
                                    <th class="text-center">Modelo</th>
                                    <th>Local</th>
                                    <th>Fabricante</th>
                                    <th>Descrição</th>
                                    <th>Numero Serial</th>
                                    <th>Disponíbilidade</th>
                                    <?php if ($_SESSION['perm'] == '2') { ?>
                                       <th>Status</th>
                                    <?php } ?>
                                 </tr>
                              </thead>
                              <tbody>
                                 <form id="check-form" action="?" onsubmit="return false" method="post">
                                    <?php
                                    $users  = "SELECT * FROM Roteador WHERE 1 ORDER BY id DESC";
                                    $r = mysqli_query($conn, $users);
                                    while ($user = mysqli_fetch_array($r)) {
                                       if ($_SESSION['perm'] == '2' || $_SESSION['perm'] == '1' & $user['status'] == 'A') {
                                    ?>

                                          <tr>
                                             <?php if ($_SESSION['perm'] == '2') { ?>
                                                <td>
                                                   <label class="custom-checkbox">
                                                      <input type="checkbox" name="check[]" value="<?= $user['id'] ?>" />
                                                      <span class="checkmark"></span>
                                                   </label>
                                                </td>
                                             <?php } ?>

                                             <td>
                                                <div class="d-flex align-items-center">
                                                   <div class="img mr-20">
                                                      <img src="<?= $url ?>/<?= $user['foto'] ?>" class="img-40" alt="" />
                                                   </div>
                                                   <div class="name bold">
                                                      <?= $user['modelo'] ?>
                                                   </div>
                                                </div>
                                             </td>

                                             <?php if ($user['local'] == 'I') { ?>
                                                <td>Interno</td>
                                             <?php } else { ?>
                                                <td>Externo</td>
                                             <?php } ?>

                                              <?php
                                                $query2  = "SELECT * FROM Fabricante WHERE id = {$user['fabricante_id']} ";

                                                $f = mysqli_query($conn, $query2);
                                                $fab = mysqli_fetch_array($f);
                                                ?>
                                             <td><?=$fab['nome']?></td>
                                             <td>
                                                <lord-icon src="https://cdn.lordicon.com/nocovwne.json" data-toggle="modal" data-target="#ModalCenter<?= $user['id'] ?>" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width: 45px; height: 45px; cursor: pointer;"></lord-icon>
                                             </td>

                                             <div class="modal fade" id="ModalCenter<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                   <div class="modal-content">
                                                      <div class="modal-header">
                                                         <h5 class="modal-title" id="ModalLongTitle">Descrição</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <?= $user['descricao'] ?>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                              <td><?=$user['serial']?></td>
                                             <?php if ($user['disponibilidade'] == 'D') { ?>
                                                <td>
                                                   <p class="alert alert-success">Disponível</p>
                                                </td>
                                             <?php } else { ?>
                                                <td>
                                                   <p class="alert alert-danger" style="padding: 0.25rem 1.25rem;">
                                                      Indisponível
                                                      <lord-icon src="https://cdn.lordicon.com/wxnxiano.json" stroke="100" data-toggle="modal" data-target="#ModalCenter1-<?= $user['id'] ?>" trigger="morph" colors="primary:#333333,secondary:#f7402e" style="width: 40px; height: 40px; cursor: pointer;"></lord-icon>
                                                   </p>
                                                </td>

                                                <div class="modal fade" id="ModalCenter1-<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLongTitle">Descrição</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                               <span aria-hidden="true">&times;</span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <?php if (!isset($user['Tecnico_id'])) {
                                                               $query2  = "SELECT * FROM Usuario WHERE id = {$user['Usuario_id']} ";
                                                               $u = mysqli_query($conn, $query2);
                                                               $use = mysqli_fetch_array($u);
                                                            ?>
                                                               Retirado dia <b><?= $user['uptime'] ?> </b> por <br>
                                                               Evento <b><?= $user['evento'] ?></b>  <br>
                                                               Data de Inicio <b><?= $user['data_inicio'] ?></b>  <br>
                                                               Data de Fim <b><?= $user['data_fim'] ?></b>  <br>
                                                               Responsavel <b><?= $user['responsavel'] ?></b>  <br>
                                                               Descrição Evento <b><?= $user['descricao_evento'] ?></b>  <br>


                                                            <?php } else {
                                                               $query2  = "SELECT * FROM Usuario WHERE id = {$user['Usuario_id']} ";
                                                               $u = mysqli_query($conn, $query2);
                                                               $use = mysqli_fetch_array($u);
                                                            ?>
                                                               Retirado dia <b><?= $user['uptime'] ?> </b> por <br>
                                                               Evento <b><?= $user['evento'] ?></b>  <br>
                                                               Data de Inicio <b><?= $user['data_inicio'] ?></b>  <br>
                                                               Data de Fim <b><?= $user['data_fim'] ?></b>  <br>
                                                               Responsavel <b><?= $user['responsavel'] ?></b>  <br>
                                                               Descrição Evento <b><?= $user['descricao_evento'] ?></b>  <br>
                                                            

                                                                     
                                                            <?php } ?>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                             <?php }  ?>

                                             <?php if ($_SESSION['perm'] == '2') {
                                                if ($user['status'] == 'A') { ?>
                                                   <td>Ativo</td>
                                                <?php } else { ?>
                                                   <td>Inativo</td>
                                             <?php }
                                             } ?>

                                             
                                             <td class="actions">
                                                <?php
                                                if ($user['disponibilidade'] == 'D') { ?>
                                                   <span class="contact-edit" data-toggle="modal" name="retirar" onclick="PassarId_Ret('<?= $user['id'] ?>')"  data-target="#ModalCenter-2">
                                                      <img src="<?= $url ?>/assets/img/svg/retirar-seta.svg" stroke="100" style="width: 40px; height: 40px; cursor: pointer;">
                                                   </span>

                                                <?php } else { ?>
                                                   <span class="contact-edit" data-toggle="modal" onclick="PassarId_Dev('<?= $user['id'] ?>')" data-target="#ModalCenter-3">
                                                      <img src="<?= $url ?>/assets/img/svg/devolver-router.svg" stroke="100" style="width: 40px; height: 40px; cursor: pointer;">
                                                   </span>

                                                <?php } ?>


                                                <?php if ($_SESSION['perm'] == '2') { ?>
                                                   <span class="contact-edit" data-toggle="modal" data-target="#contactEditModal" onclick="Alterar('<?= $user['id'] ?>','<?= $user['modelo'] ?>','<?= $user['descricao'] ?>', '<?= $user['local'] ?>', '<?= $user['fabricante_id'] ?>', '<?= $user['serial'] ?>', '<?= $user['status'] ?>','<?= $user['foto'] ?>')">
                                                      <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#121331,secondary:#16c72e" stroke="100" style="width: 40px; height: 40px; cursor: pointer;"></lord-icon>
                                                   </span>
                                                   <span class="contact-close1" onclick=" Remover_roteador('<?= $user['id'] ?>')">
                                                      <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width: 40px; height: 40px; transform: rotate(45deg); cursor: pointer;">
                                                      </lord-icon>
                                                   </span>
                                             </td>
                                          <?php } ?>
                                          </tr>
                                    <?php }
                                    } ?>
                                    <input type="hidden" name="modulo" value="exc-all-roteador" />
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
                                 <form id="add-roteador" action="?" onsubmit="return false" method="post">
                                 
                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                          <div class="attach-file style--two mb-3">
                                             <img src="<?= $url ?>/assets/img/img-placeholder.png" class="profile-avatar" alt="" />
                                             <div class="upload-button">
                                                <img src="<?= $url ?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2" />
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
                                          

                                          <div class="mb-4 mt-3">
                                             <label class="bold black mb-2"  for="as_local">Local</label>
                                              <select name="local" class="theme-input-style perm local-edt">
                                                <option value="">Selecione...</option>
                                                <option value="I" class="local_Interno">Interno</option>
                                                <option value="E" class="local_Externo">Externo</option>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                       </div>

                                       <div class="contact-account-setting media-body">
                                          <h4 class="mb-4">Dados do Roteador</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_modelo">Modelo</label>
                                             <input type="text" id="as_modelo" class="theme-input-style" name="modelo" placeholder="modelo" />
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="content">
                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_perm">Fabricante</label>
                                                <select name="fabricante" class="theme-input-style perm">
                                                   <option value="">Selecione...</option>

                                                   <?php
                                                   $query4 = "SELECT * FROM `Fabricante` WHERE status = 'A' ";
                                                   $fab_res = mysqli_query($conn, $query4);

                                                   while ($fab_w = mysqli_fetch_array($fab_res)) { ?>

                                                      <option value="<?= $fab_w['id'] ?>"> <?= $fab_w['nome'] ?> </option>

                                                   <?php } ?>

                                                </select>
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Descrição</label>
                                             <textarea id="as_descricao" class="theme-input-style" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_serial">Serial Number</label>
                                             <input type="text" id="as_serial" class="theme-input-style " name="serial" placeholder="Serial Number" />
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>


                                          <div class="">
                                             <input type="hidden" name="modulo" value="add-roteador">
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
                                 <form id="edt-roteador" action="?" onsubmit="return false" method="post">
                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                          <div class="attach-file style--two mb-3">
                                             <img src="<?= $url ?>/assets/img/img-placeholder.png" class="profile-avatar foto-edt" alt="" />
                                             <div class="upload-button">
                                                <img src="<?= $url ?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2 foto-edt" />
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
                                          <div class="mb-4 mt-3">
                                             <label class="bold black mb-2"  for="as_local">Local</label>
                                              <select name="local" class="theme-input-style perm local-edt">
                                                <option value="">Selecione...</option>
                                                <option value="I" class="local_Interno_ed">Interno</option>
                                                <option value="E" class="local_Externo_ed">Externo</option>
                                              </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
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
                                          <h4 class="mb-4">Dados do Roteador</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_modelo">Modelo</label>
                                             <input type="text" id="as_modelo" class="theme-input-style modelo-edt" name="modelo" placeholder="modelo" />
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="content">
                                             <div class="mb-4">
                                                <label class="bold black mb-2" for="as_perm">Fabricante</label>
                                                <select name="fabricante" class="theme-input-style perm fabricante-edt">
                                                   <option value="">Selecione...</option>

                                                   <?php
                                                   $query4 = "SELECT * FROM `Fabricante` WHERE status = 'A' ";
                                                   $fab_res = mysqli_query($conn, $query4);

                                                   while ($fab_w = mysqli_fetch_array($fab_res)) { ?>

                                                      <option value="<?= $fab_w['id'] ?>"> <?= $fab_w['nome'] ?> </option>

                                                   <?php } ?>

                                                </select>
                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                             </div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Descrição</label>
                                             <textarea id="as_descricao" class="theme-input-style descricao-edt" name="descricao" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_serial">Serial Number</label>
                                             <input type="text" id="as_serial" class="theme-input-style serial-edt" name="serial" placeholder="Serial Number" />
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>


                                          <div class="">
                                             <input type="hidden" class="edt-input" name="modulo" value="edt-roteador" />
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
                                    <h4 class="mb-4">Retirar Roteador</h4>
                                    <form id="ret-roteador" action="?" onsubmit="return false" method="post">
                                       <div class="mb-2 mt-4 d-flex flex-column">
                                          <label for="as_perm" class="bold black mb-2">Retirar roteador para:</label>
                                          <select name="val_id_tecnico" id="val_id_tecnico" class="theme-input-style val_id_tecnico">
                                             <option value="usuario">
                                                <?= $_SESSION['usuario'] ?>
                                                (EU)
                                             </option>
                                             <?php
                                             $query_tec = "SELECT * FROM `Tecnico` WHERE 1";

                                             $tec_res = mysqli_query($conn, $query_tec);

                                             while ($tec_w = mysqli_fetch_array($tec_res)) { ?>

                                                <option value="<?= $tec_w['id'] ?>"> <?= $tec_w['nome'] ?> </option>

                                             <?php } ?>
                                          </select>
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>
                                       <div class="mb-4">
                                          <label class="bold black mb-2" for="as_evento">Evento</label>
                                          <input type="text" id="as_evento" class="theme-input-style unidade-edt" name="evento_ret" placeholder="Evento" />
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>
                                       <div class="mb-4">
                                          <label class="bold black mb-2" for="as_evento">Data de inicio do evento</label>
                                          <input type="date" id="as_evento" class="theme-input-style unidade-edt" name="data_inicio_ret" placeholder="Evento" />
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>
                                       <div class="mb-4">
                                          <label class="bold black mb-2" for="as_evento">Evento finaliza dia</label>
                                          <input type="date" id="as_evento" class="theme-input-style unidade-edt" name="data_fim_ret" placeholder="Evento" />
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>
                                       <div class="mb-4">
                                          <label class="bold black mb-2" for="as_evento">Responsavel</label>
                                          <input type="text" id="as_evento" class="theme-input-style unidade-edt" name="resposavel_ret" placeholder="Evento" />
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>
                                       <div class="mb-4">
                                          <label class="bold black mb-2"  for="as_funcao">Descrição</label>
                                          <textarea id="as_descricao" class="theme-input-style descricao-edt" name="descricao_ret" rows="4" cols="50" placeholder="Descrição"> </textarea>
                                          <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                       </div>

                                       <div class="mt-4">
                                          <input type="hidden" class="edt-input" name="modulo" value="ret-roteador" />
                                          <input type="hidden" class="id_roteador_r" id="id_roteador_r" name="id_roteador_r" value="ret-roteador">
                                          <button type="button" class="btn mr-4" id="enviar3">Retirar</button>
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
                                    <h4 class="mb-4">Deseja realmente devolver este roteador:</h4>
                                    <div class="mt-4">
                                       <input type="hidden" class="id_roteador_d" id="id_roteador_d" name="id_roteador_d" value="">
                                       <button type="button" class="btn mr-4" onclick="Devolver_roteador() " id="enviar4">Devolver roteador</button>
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
   <script src="<?= $url ?>/assets/js/jquery.min.js"></script>
   <script src="<?= $url ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?= $url ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="<?= $url ?>/assets/js/script.js"></script>
   <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

   <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?= $url ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
   <script src="<?= $url ?>/assets/plugins/bootstrap-datepicker/custom-datepicker.js"></script>
   <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?= $url ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="<?= $url ?>/assets/plugins/sweetalert2/sweetalerts.js"></script>



    <script>
      function PassarId_Ret(Id_edt_dev) {
         document.querySelector(".id_roteador_r").value = Id_edt_dev;

      }

      var $form_ret = $("#ret-roteador");


      $(document).ready(function() {
         $form_ret.find("input[name= evento_ret], textarea[name= descricao_ret], input[name= resposavel_ret], input[name= data_inicio_ret], input[name= data_fim_ret]").val("");
      });

      function validateForm2($form) {
         var all_inputs2 = $form_ret.find("input[name= evento_ret], textarea[name= descricao_ret], input[name= resposavel_ret], input[name= data_inicio_ret], input[name= data_fim_ret]").not("textarea[name=modulo]");
         var $input2;
         var valid2 = {
            valid: true,
            error: ""
         };

         all_inputs2.each(function(index) {
            $input2 = $(all_inputs2[index]);

            if ($input2.val() == "") {
               valid2.valid = false;
               valid2.error = "form";

               $input2.addClass("is-invalid");
            } else {
               $input2.removeClass("is-invalid");
            }
         });

         return valid2;
      }

      $(document).on("click", "#enviar3", function() {
         var form_valid2 = validateForm2($form_ret);

         if (form_valid2.valid) {
            var form_data2 = new FormData($form_ret[0]);

            $.ajax({
               url: "<?= $url ?>/action.php",
               data: form_data2,
               type: "POST",
               processData: false,
               contentType: false,

               success: function(response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Roteador retirado com sucesso!",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function() {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function() {
                        document.location.reload(true);
                     });
                  }
               },
               error: function() {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para retirar o roteador",
                     type: "error",
                  });
               },
            });
         } else {
            if (form_valid2.error == "form") {
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
      function PassarId_Dev(Id_edt_dev) {
         document.querySelector(".id_roteador_d").value = Id_edt_dev;
      }

      function Devolver_roteador() {

         var id_rmv = document.getElementById("id_roteador_d").value

         $.ajax({
            url: "<?= $url ?>/action.php",
            data: {
               modulo: "dev-roteador",
               id: id_rmv,
            },
            type: "POST",

            success: function(response) {
               response = JSON.parse(response);

               if (response.status == "success") {
                  swal({
                     title: "Devolvido roteador com sucesso",
                     text: "Sua solicitação foi concluída com exito.",
                     type: "success",
                     allowOutsideClick: false,
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
               if (response.status == "error") {
                  swal({
                     title: "Erro",
                     text: response.error,
                     type: "error",
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
            },
            error: function() {
               swal({
                  title: "Erro",
                  text: "Encontramos problemas para devolver o roteador",
                  type: "error",
               });
            },
         });
      }
   </script>

   <script>
      function Remover_roteador(id_remover) {
         id_rmv = id_remover;

         $.ajax({
            url: "<?= $url ?>/action.php",
            data: {
               modulo: "exc-unc-roteador",
               id: id_remover,
            },
            type: "POST",

            success: function(response) {
               response = JSON.parse(response);

               if (response.status == "success") {
                  swal({
                     title: "Roteador(es) deletado(s) com sucesso!",
                     text: "Sua solicitação foi concluída com exito.",
                     type: "success",
                     allowOutsideClick: false,
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
               if (response.status == "error") {
                  swal({
                     title: "Erro",
                     text: response.error,
                     type: "error",
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
            },
            error: function() {
               swal({
                  title: "Erro",
                  text: "Encontramos problemas para deletar o roteador",
                  type: "error",
               });
            },
         });
      }
   </script>

   <script type="text/javascript">
      function Alterar(id12, modelo_edt, descricao_edt, local_edt, fabricante_edt, serial_edt, status_edt, foto_edt) {
         var foto_url = "<?= $url ?>" + "/" + foto_edt;

         document.querySelector(".foto-edt").src = foto_url;
         document.querySelector(".modelo-edt").value = modelo_edt;
         document.querySelector(".fabricante-edt").value = fabricante_edt;
         document.querySelector(".descricao-edt").value = descricao_edt;
         document.querySelector(".serial-edt").value = serial_edt;
         document.querySelector(".id_usuario").value = id12;

         if (status_edt == "A") {
            document.querySelector(".stt_opt_1").selected = "selected";
         } else {
            document.querySelector(".stt_opt_2").selected = "selected";
         }
         if (local_edt == "I") {
            document.querySelector(".local_Interno_ed").selected = "selected";
         } else {
            document.querySelector(".local_Externo_ed").selected = "selected";
         }
      }
   </script>

   <script>
      $(document).on("click", "#adicionar", function() {
         var $form_add = $("#add-roteador");

         $(document).ready(function() {
            $form_add.find("input, select, textarea").not("#enviar, input[name=modulo]").val("");
         });

         function validateForm($form) {
            var all_inputs = $form_add.find("input, select, textarea").not("input[name=modulo], input[name=foto]");
            var $input;
            var valid = {
               valid: true,
               error: ""
            };

            all_inputs.each(function(index) {
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

         $(document).on("click", "#enviar", function() {
            var form_valid = validateForm($form_add);

            if (form_valid.valid) {
               var form_data = new FormData($form_add[0]);

               $.ajax({
                  url: "<?= $url ?>/action.php",
                  data: form_data,
                  type: "POST",
                  processData: false,
                  contentType: false,

                  success: function(response) {
                     response = JSON.parse(response);

                     if (response.status == "success") {
                        swal({
                           title: "Roteador adicionado com sucesso!",
                           text: "Sua solicitação foi concluída com exito.",
                           type: "success",
                           allowOutsideClick: false,
                        }).then(function() {
                           document.location.reload(true);
                        });
                     }
                     if (response.status == "error") {
                        swal({
                           title: "Erro",
                           text: response.error,
                           type: "error",
                        }).then(function() {
                           document.location.reload(true);
                        });
                     }
                  },
                  error: function() {
                     swal({
                        title: "Erro",
                        text: "Encontramos problemas para adicionar o roteador",
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
      var $form_edit = $("#edt-roteador");

      $(document).ready(function() {
         $form_edit.find("input, select, textarea").not("#enviar2, input[name=modulo]").val("");
      });

      function validateForm($form) {
         var all_inputs = $form_edit.find("input, select, textarea").not("input[name=modulo], input[name=foto], input[name=id_user]");
         var $input;
         var valid = {
            valid: true,
            error: ""
         };

         all_inputs.each(function(index) {
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

      $(document).on("click", "#enviar2", function() {
         var form_valid = validateForm($form_edit);

         if (form_valid.valid) {
            var form_data = new FormData($form_edit[0]);

            $.ajax({
               url: "<?= $url ?>/action.php",
               data: form_data,
               type: "POST",
               processData: false,
               contentType: false,

               success: function(response) {
                  response = JSON.parse(response);

                  if (response.status == "success") {
                     swal({
                        title: "Roteador atualizado com sucesso!",
                        text: "Sua solicitação foi concluída com exito.",
                        type: "success",
                        allowOutsideClick: false,
                     }).then(function() {
                        document.location.reload(true);
                     });
                  }
                  if (response.status == "error") {
                     swal({
                        title: "Erro",
                        text: response.error,
                        type: "error",
                     }).then(function() {
                        document.location.reload(true);
                     });
                  }
               },
               error: function() {
                  swal({
                     title: "Erro",
                     text: "Encontramos problemas para editar o roteador",
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

      $(document).on("click", ".delete_mail", function() {
         var form_data = $check_form.serialize();

         $.ajax({
            url: "<?= $url ?>/action.php",
            data: form_data,
            type: "POST",

            success: function(response) {
               response = JSON.parse(response);

               if (response.status == "success") {
                  swal({
                     title: "Roteador(es) deletado(s) com sucesso!",
                     text: "Sua solicitação foi concluída com exito.",
                     type: "success",
                     allowOutsideClick: false,
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
               if (response.status == "error") {
                  swal({
                     title: "Erro",
                     text: response.error,
                     type: "error",
                  }).then(function() {
                     document.location.reload(true);
                  });
               }
            },
            error: function() {
               swal({
                  title: "Erro",
                  text: "Encontramos problemas para deletar o roteador",
                  type: "error",
               });
            },
         });
      });
   </script>
</body>

</html>