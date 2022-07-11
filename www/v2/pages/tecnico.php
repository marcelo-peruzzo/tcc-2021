<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $tecnico = true; ?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link rel="stylesheet" href="<?=$url?>/assets/fonts/et-lineicon/et-lineicons.css">
 <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
<body>

   <div class="offcanvas-overlay"></div>
   <div class="wrapper">

      <?php include 'includes/header.php'; ?>

      <div class="main-wrapper">
         
         <?php include 'includes/aside.php'; ?>

         <div class="main-content d-flex flex-column flex-md-row">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
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
                                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" id="adicionar_tec" data-toggle="modal" data-target="#contactAddModal" trigger="hover" colors="primary:#333333,secondary:#16c72e" stroke="100" style="width: 50px; height: 50px; cursor: pointer;">
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
                                        <th>
                                            <label class="custom-checkbox">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th class="text-center">Nome</th>
                                        <?php } else{?>
                                        <th>Nome</th>
                                        <?php } ?>

                                        <th>Telefone</th>
                                        <th>Celular</th>
                                        <th>Função</th>
                                        <th>Unidade</th>

                                        <?php if($_SESSION['perm'] == '2'){ ?>
                                        <th>Status</th>
                                        <?php } ?>

                                    </tr>
                                </thead>
                                <tbody>
                                  <form id="check-form" action="?" onsubmit="return false" method="post">
                                    <?php
                                      $users  = "SELECT * FROM Tecnico WHERE 1 ORDER BY id DESC";
                                      $r = mysqli_query($conn, $users);
                                      while($user = mysqli_fetch_array($r)){
                                        if($_SESSION['perm'] == '2' || $_SESSION['perm'] == '1' & $user['status']=='A'){
                                    ?>
                                      <tr>
                                        <?php if($_SESSION['perm'] == '2'){ ?>
                                            <td>
                                                <label class="custom-checkbox" >
                                                    <input type="checkbox"  name="check[]" value="<?=$user['id']?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                         <?php } ?>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                  <div class="name bold">
                                                  <?=$user['nome']?>
                                                </div>
                                              </div>
                                            </td>
                                            <td><?=$user['telefone']?></td>
                                            <td><?=$user['celular']?></td>
                                            <td><?=$user['funcao']?></td>
                                            <td><?=$user['unidade']?></td>
                                            <?php
                                            if($_SESSION['perm'] == '2'){
                                              if($user['status']=='A'){ ?>
                                                <td>Ativo</td>
                                              <?php }else{ ?>
                                                <td>Inativo</td>
                                              <?php } ?>
                                              <td class="actions">
                                                <span class="contact-edit" onclick="Alterar('<?=$user['id']?>','<?=$user['nome']?>', '<?=$user['telefone']?>','<?=$user['celular']?>','<?=$user['funcao']?>','<?=$user['unidade']?>','<?=$user['status']?>')" data-toggle="modal" data-target="#contactEditModal" id="<?=$user['id']?>">
                                                    <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#121331,secondary:#16c72e" stroke="100" style="width:40px;height:40px; cursor: pointer"></lord-icon>
                                                </span>
                                                <span class="contact-close1" onclick=" Remover_tec('<?=$user['id']?>') ">
                                                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width:40px;height:40px; transform: rotate(45deg); cursor: pointer;"> </lord-icon>
                                                </span>
                                              </td>
                                           <?php } ?>
                                            
                                        </tr>
                                  <?php } }?>
                                   <input type="hidden" name="modulo" value="exc-all-tec">
                                  </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div id="contactAddModal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content" >

                              <div class="modal-body boder-tcc">
                                 <form id="add-tec" action="?" onsubmit="return false" method="post">

                                    <div class="media flex-column flex-sm-row">
            
                                       <div class="contact-account-setting media-body">

                                          <h4 class="mb-4">Dados do usuário</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Nome</label>
                                             <input type="text" id="as_name" class="theme-input-style" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                            
                                          
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_phone">Telefone</label>
                                             <input type="text" id="as_phone" class="theme-input-style tel1" name="telefone" placeholder="Telefone">
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_cell">Celular</label>
                                             <input type="text" id="as_cell" class="theme-input-style tel2" name="celular" placeholder="Celular">
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Função</label>
                                             <input type="text" id="as_funcao" class="theme-input-style" name="funcao" placeholder="Função">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_unidade">Unidade</label>
                                             <input type="text" id="as_unidade" class="theme-input-style" name="unidade" placeholder="Unidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="">
                                             <input type="hidden" name="modulo" value="add-tec">
                                             <button type="button" class="btn mr-4" id="enviar">Adicionar</button>
                                             <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div id="contactEditModal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-body">
                                  <form id="edt-tec" action="?" onsubmit="return false" method="post">

                                    <div class="media flex-column flex-sm-row">

                                      <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">

                                          <div class="mb-2 mt-4">
                                             <label  for="as_perm" class="bold black mb-2">Status</label>
                                             <select name="status" class="theme-input-style">
                                                <option selected="" class="stt_opt_1" value="A">Ativo</option>
                                                <option selected="" class="stt_opt_2" value="I" >Inativo</option>
                                             </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                       </div>
            
                                       <div class="contact-account-setting media-body">

                                          <h4 class="mb-4">Dados do usuário</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Nome</label>
                                             <input type="text" class="nome-edt theme-input-style" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                          
                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_phone">Telefone</label>
                                             <input type="text" class="theme-input-style telefone-edt tel3" name="telefone" placeholder="Telefone">
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_cell">Celular</label>
                                             <input type="text" class="celular-edt theme-input-style tel4" name="celular" placeholder="Celular">
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_funcao">Função</label>
                                             <input type="text" class="theme-input-style funcao-edt" name="funcao" placeholder="Função">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-4">
                                             <label class="bold black mb-2"  for="as_unidade">Unidade</label>
                                             <input type="text" class="theme-input-style unidade-edt" name="unidade" placeholder="Unidade">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="">
                                             <input type="hidden" class="edt-input" name="modulo" value="edt-tec">
                                             <input type="hidden" class="id_tec" name="id_tec" value="">
                                             <button type="button" class="btn mr-4" id="enviar2">Alterar</button>
                                             <a href="#" class="cancel font-14 bold" data-dismiss="modal">Cancelar</a>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <?php include 'includes/footer.php'; ?>
   </div>

   <script src="<?=$url?>/assets/js/jquery.min.js"></script>
   <script src="<?=$url?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?=$url?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="<?=$url?>/assets/js/script.js"></script>
   <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
   <script src="<?=$url?>/assets/plugins/bootstrap-datepicker/custom-datepicker.js"></script>
   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalerts.js"></script>
   <script src="<?=$url?>/assets/js/mask-vanilla.js"></script>

   <script>

        function Remover_tec(id_remover){
        id_rmv = id_remover;
                
         $.ajax({
            url: '<?=$url?>/action.php',
            data: {
              "modulo" : 'exc-unc-tec',
              "id" : id_remover},
            type: 'POST',

            success: function(response){

               response = JSON.parse(response);

               if(response.status == 'success')
               {
                  swal({
                        title: 'Usuário(s) deletado(s) com sucesso!',
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
                     text: 'Encontramos problemas para deletar o usuário',
                     type: 'error'
               });                        
            }        
         })   
                 
        }
      </script>

   <script type="text/javascript">         

        function Alterar(id12, nome_edt, telefone_edt, celular_edt, funcao_edt, unidade_edt, status_edt){



          document.querySelector(".nome-edt").value = nome_edt;
          document.querySelector(".telefone-edt").value = telefone_edt;
          document.querySelector(".celular-edt").value = celular_edt;
          document.querySelector(".funcao-edt").value = funcao_edt;
          document.querySelector(".unidade-edt").value = unidade_edt;

          document.querySelector(".id_tec").value = id12;

          if(status_edt == "A"){
            document.querySelector(".stt_opt_1").selected="selected";
          } else{
            document.querySelector(".stt_opt_2").selected="selected";
          }
        }

        
  </script>

   <script>
         function inputHandler(masks, max, event) {
         var c = event.target;
         var v = c.value.replace(/\D/g, '');
         var m = c.value.length > max ? 1 : 0;
         VMasker(c).unMask();
         VMasker(c).maskPattern(masks[m]);
         c.value = VMasker.toPattern(v, masks[m]);
         }

         var telMask = ['(99) 9999-99999', '(99) 99999-9999'];

         var tel1 = document.querySelector('.tel1');
         VMasker(tel1).maskPattern(telMask[0]);
         tel1.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);

         var tel2 = document.querySelector('.tel2');
         VMasker(tel2).maskPattern(telMask[0]);
         tel2.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);

         var tel3 = document.querySelector('.tel3');
         VMasker(tel3).maskPattern(telMask[0]);
         tel3.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);

         var tel4 = document.querySelector('.tel4');
         VMasker(tel4).maskPattern(telMask[0]);
         tel4.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);
      </script>

   <script>
      $(document).on('click', '#adicionar_tec', function(){
        var $form_add = $('#add-tec');
        
        $(document).ready(function(){
            $form_add.find('input, select, textarea').not('#enviar, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_add.find('input, select, textarea').not("input[name=modulo], input[name=telefone], input[name=celular]");               
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
        var $form_edit = $('#edt-tec');
        
        $(document).ready(function(){
            $form_edit.find('input, select, textarea').not('#enviar2, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_edit.find('input, select, textarea').not('input[name=modulo], input[name=telefone], input[name=celular], input[name=id_tec]');               
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
                        title: 'Usuário(s) deletado(s) com sucesso!',
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
                     text: 'Encontramos problemas para deletar o usuário',
                     type: 'error'
               });                        
            }        
         })            
        })
    </script> 






</body>

</html>