<?php include '../auth.php'; ?>
<?php include '../conexao.php'; 
if ($_SESSION["perm"] != 2) {
  header('Location: '.$url.'/home.php');
}
?>
<?php $fabricante = true; ?>

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
                                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" id="adicionar_fab" data-toggle="modal" data-target="#contactAddModal" trigger="hover" colors="primary:#333333,secondary:#16c72e" stroke="100" style="width:50px;height:50px; cursor: pointer;">
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
                                        <th>Status</th>
                                        <?php } else{?>
                                        <th>Nome</th>
                                        <?php } ?>

                                    </tr>
                                </thead>
                                <tbody>
                                 <form id="check-form" action="?" onsubmit="return false" method="post">
                                  <?php
                                    $users  = "SELECT * FROM Fabricante WHERE 1";
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
                                    <?php if($_SESSION['perm'] == '2'){
                                        if($user['status']=='A'){ ?>
                                          <td>Ativo</td>
                                        <?php }else{ ?>
                                          <td>Inativo</td>
                                        <?php } ?>
                                        <td class="actions">

                                            <span class="contact-edit" onclick="Alterar('<?=$user['id']?>','<?=$user['nome']?>','<?=$user['status']?>')" data-toggle="modal" data-target="#contactEditModal" id="<?=$user['id']?>" data-toggle="modal" data-target="#contactEditModal">
                                                <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#121331,secondary:#16c72e" stroke="100" style="width:40px;height:40px; cursor: pointer"></lord-icon>
                                             </span>
                                             <span class="contact-close" onclick=" Remover_fab('<?=$user['id']?>')">
                                                   <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#333333,secondary:#f7402e" stroke="100" style="width:40px;height:40px; transform: rotate(45deg); cursor: pointer;"> </lord-icon>
                                             </span>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                  <?php } }?>
                                  <input type="hidden" name="modulo" value="exc-all-fab">
                                 </form>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                     <div id="contactAddModal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <!-- Modal Body -->
                              <div class="modal-body">
                                 <form id="add-fab" action="?" onsubmit="return false" method="post">
                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                       </div>
                                       <div class="contact-account-setting media-body">
                                          <h4 class="mb-4">Adicionar Fabricante</h4>
                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Nome</label>
                                             <input type="text" id="as_name" class="theme-input-style" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>
                                          <div class="">
                                             <input type="hidden" name="modulo" value="add-fab">
                                             <a href="#" type="button" class="btn mr-4" id="enviar">Adicionar</a>
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
                                 <form id="edt-fab" action="?" onsubmit="return false" method="post">
                                    <div class="media flex-column flex-sm-row">
                                       <div class="modal-upload-avatar mr-0 mr-sm-3 mr-md-5 mb-5 mb-sm-0">
                                       </div>
            
            
                                       <div class="contact-account-setting media-body">

                                          <h4 class="mb-4">Editar</h4>

                                          <div class="mb-4">
                                             <label class="bold black mb-2" for="as_name">Nome</label>
                                             <input type="text" class="nome-edt theme-input-style" name="nome" placeholder="Nome">
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mb-2 mt-4">
                                             <label  for="as_perm" class="bold black mb-2">Status</label>
                                             <select name="status" class="theme-input-style">
                                                <option selected="" class="stt_opt_1" value="A">Ativo</option>
                                                <option selected="" class="stt_opt_2" value="I" >Inativo</option>
                                             </select>
                                             <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                          </div>

                                          <div class="mt-4">
                                             <input type="hidden" class="edt-input" name="modulo" value="edt-fab">
                                             <input type="hidden" class="id_fab" name="id_fab" value="">
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

        function Remover_fab(id_remover){
        id_rmv = id_remover;
                
         $.ajax({
            url: '<?=$url?>/action.php',
            data: {
              "modulo" : 'exc-unc-fab',
              "id" : id_remover},
            type: 'POST',

            success: function(response){

               response = JSON.parse(response);

               if(response.status == 'success')
               {
                  swal({
                        title: 'Fabricante(s) deletado(s) com sucesso!',
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
                     text: 'Encontramos problemas para deletar o fabricante',
                     type: 'error'
               });                        
            }        
         })   
                 
        }
      </script>

   <script type="text/javascript">         

        function Alterar(id12, nome_edt, status_edt){



          document.querySelector(".nome-edt").value = nome_edt;
          document.querySelector(".id_fab").value = id12;

          if(status_edt == "A"){
            document.querySelector(".stt_opt_1").selected="selected";
          } else{
            document.querySelector(".stt_opt_2").selected="selected";
          }
        }

        
  </script>

   <script>
      $(document).on('click', '#adicionar_fab', function(){
        var $form_add = $('#add-fab');
        
        $(document).ready(function(){
            $form_add.find('input, select').not('#enviar, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_add.find('input, select, textarea').not("input[name=modulo]");               
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
                                title: 'Fabricante cadastrado com sucesso!',
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
                            text: 'Encontramos problemas para cadastrar o fabricante',
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
        var $form_edit = $('#edt-fab');
        
        $(document).ready(function(){
            $form_edit.find('input, select, textarea').not('#enviar2, input[name=modulo]').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_edit.find('input, select, textarea').not('input[name=modulo], input[name=id_fab]');               
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
                                title: 'Fabricante atualizado com sucesso!',
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
                            text: 'Encontramos problemas para cadastrar o fabricante',
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
                        title: 'Fabricante(s) deletado(s) com sucesso!',
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
                     text: 'Encontramos problemas para deletar o fabricante',
                     type: 'error'
               });                        
            }        
         })            
        })
    </script> 


</body>


</html>