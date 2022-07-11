<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $perfil = true; ?>
<?php $page = 'Perfil'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>

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
            <div class="main-content">
                
            	<?php
            		$id_user = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '';
	                $users  = "SELECT * FROM Usuario WHERE id = '" . addslashes($id_user) ."' ";
	                $r = mysqli_query($conn, $users);
	                while($user = mysqli_fetch_array($r)){
	            ?>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="mx-2 mx-lg-4 mx-xl-5">
                            	<form action="?" id="edt-user" onsubmit="return false" method="post">
                                <div class="card mb-30 mt-1">
                                    <!-- User Profile Nav -->
                                    <div class="user-profile-nav d-flex justify-content-xl-between align-items-xl-center flex-column flex-xl-row">
                                        <!-- Profile Info -->
                                        <div class="profile-info d-flex align-items-center">
                                            <div class="profile-pic mr-3 ">
                                                <img src="<?=$url?>/<?=$user['foto']?>" alt="">
        
                                                <!-- Upload Photo -->
                                                <div class="upload-button">
                                                    <img src="<?=$url?>/assets/img/svg/gallery.svg" alt="" class="svg mr-2">
                                                    <span>Upload Photo</span>
                                                    <input class="file-input" type="file" id="fileUpload2" name="fileUpload2" accept="image/*">
                                                </div>
                                                <!-- End Upload Photo -->
                                            </div>

                                            <div>
                                                <h3><?=$user['nome']?></h3>
                                                <p class="font-14"><?=$user['funcao']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- Form -->
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!-- Card -->
                                            <div class="card">
                                                <div class="card-body p-30">
                                                    <!-- Edit Personal Info -->
                                                    <div class="edit-personal-info mb-5">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4 class="mb-3">Informações Pessoais</h4>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-fname">Nome</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="edit-fname" class="form-control" name="nome" value="<?=$user['nome']?>">
                                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-funcao">Função</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="edit-funcao" class="form-control" name="funcao" value="<?=$user['funcao']?>">
                                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-unidade">Unidade</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="edit-unidade" class="form-control" name="unidade" value="<?=$user['unidade']?>">
                                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-celular">Celular</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="edit-celular" name="edit-celular" class="form-control tel2 edit-celular" value="<?=$user['telefone']?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-telefone">Telefone</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="edit-telefone" name="edit-telefone" class="form-control tel1 edit-telefone" value="<?=$user['celular']?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <label for="edit-email">Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="email" id="edit-email" class="form-control" name="email" value="<?=$user['email']?>">
                                                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                                                            </div>
                                                        </div>
                                                        <!-- End Form Group -->

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="card mb-30">
                                                <div class="card-body p-30">
                                                    <!-- Change Password -->
                                                    <div class="change-password">

                                                        <div><h4 class="mb-4 pt-2">Mudar senha</h4></div>

                                                        <!-- Form Group -->
                                                        <div class="form-group mb-4">
                                                            <label for="old-pass" class="bold font-14 mb-2 black">Senha antiga</label>
                                                            <input type="password" class="theme-input-style old-pass" name="old-pass" id="old-pass" placeholder="********">
                                                        </div>
                                                        <!-- End Form Group -->

                                                        <!-- Form Group -->
                                                        <div class="form-group mb-4">
                                                            <label for="new-pass" class="bold font-14 mb-2 black">Nova senha</label>
                                                            <input type="password" class="theme-input-style new-pass" name="new-pass" id="new-pass" value="" placeholder="********">
                                                        </div>
                                                        <!-- End Form Group -->

                                                        <!-- Form Group -->
                                                        <div class="form-group mb-10">
                                                            <label for="retype-pass" class="bold font-14 mb-2 black">Repetir nova senha</label>
                                                            <input type="password" class="theme-input-style retype-pass" name="retype-pass" id="retype-pass" value="" placeholder="********">
                                                        </div>
                                                        <!-- End Form Group -->

                                                    </div>
                                                    <!-- End Change Password -->
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>

                                        <div class="col-12 text-right">
                                            <!-- Button Group -->
                                            <div class="button-group pt-1">
                                            	<input type="hidden" class="edt-input" name="modulo" value="edt-usuario">
                                            	<input type="hidden" class="id_usuario" name="id_usuario" value="<?=$user['id']?>">
                                                <button type="button" class="btn" id="enviar2">Salvar</button>
                                            </div>
                                            <!-- End Button Group -->
                                        </div>
                                    </div>
                                </form>
                                <!-- End Form -->



                            </div>

                            
                        </div>
                    </div>
                </div>            
                <?php } ?>       
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Main Wrapper -->


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

   <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalerts.js"></script>
   <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="<?=$url?>/assets/js/mask-vanilla.js"></script>

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


      </script>
      <script>
        var $form_edit = $('#edt-user');
        
       /*$(document).ready(function(){
            $form_edit.find('input, select, textarea').not('#enviar2, input[name=modulo]').val('');                
        })  */                                                      
        
        function validateForm($form)
        {
            var all_inputs = $form_edit.find('input, select, textarea').not('input[name=modulo], input[name=id_usuario], input[name=fileUpload2], input[name=edit-telefone], input[name=edit-celular], input[name=id_user], input[name=old-pass], input[name=new-pass], input[name=retype-pass]');               
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
</body>

</html>