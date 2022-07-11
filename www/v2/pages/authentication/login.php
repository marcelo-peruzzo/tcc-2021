<!DOCTYPE html>
<html lang="pt-br">

<?php 
include '../../conexao.php';
include '../includes/head.php'; 
?>

<body>

    <div class="mn-vh-100 d-flex align-items-center">
        <div class="container">
            <!-- Card -->
            <div class="card justify-content-center auth-card">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-12 log">
                        
                        <figure class="logo-login">
                            <img src="<?=$url?>/assets/img/logo.png">
                        </figure>

                        <h4 class="mb-5 font-20" >Faça login para iniciar sua sessão</h4>
                        
                        <form id="form-login" action="?" onsubmit="return false" method="post">
                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="email" class="mb-2 font-14 bold black">Endereço de e-mail</label>
                                <input type="email" id="email" name="email" class="theme-input-style" placeholder="Endereço de e-mail">
                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                            </div>
                            <!-- End Form Group -->
                            
                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="password" class="mb-2 font-14 bold black">Senha</label>
                                <input type="password" id="password" name="password" class="theme-input-style" placeholder="********">
                                <div class="invalid-feedback">* Campo de preenchimento obrigatório.</div>
                            </div>
                            <!-- End Form Group -->

                            <!-- <div class="d-flex justify-content-between mb-20">
                                <div class="d-flex align-items-center">
                                    <label class="custom-checkbox position-relative mr-2">
                                        <input type="checkbox" name="lembrar" id="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    
                                    <label for="checkbox" class="font-14">Lembrar de mim</label>
                                </div>

                               <a href="forget-pass.html" class="font-12 text_color">Esqueceu sua senha?</a> 
                            </div> -->

                            <div class="d-flex align-items-center">
                                <button type="button" class="btn long mr-20" id="enviar">Log In</button>
                                <!-- <span class="font-12 d-block"><a href="register.html" class="bold">Registre-se</a>, caso ainda não tenha uma conta.</span> -->
                            </div>
                        </form>
                    </div>                                    
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer" style="justify-content: center; display: flex; padding: 0;">
        Ampernet © <?=date('Y')?>. Todos os direitos reservados.</a>
    </footer>
    <!-- End Footer -->

    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
    <script src="<?=$url?>/assets/js/jquery.min.js"></script>
    <script src="<?=$url?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$url?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=$url?>/assets/js/script.js"></script>
    
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

    <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
    <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?=$url?>/assets/plugins/sweetalert2/sweetalerts.js"></script>
    <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->

    <script>
        var $form_login = $('#form-login');
        
        $(document).ready(function(){
            $form_login.find('input, select, textarea').not('#enviar').val('');                
        })                                                        
        
        function validateForm($form)
        {
            var all_inputs = $form_login.find('input, select, textarea').not('input[name=lembrar]');               
            var $input;
            var valid = {valid: true, error: ''};

            all_inputs.each(function(index){
                $input = $(all_inputs[index]);

                if($input.val() == '')
                {
                    console.log($input);
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
            var form_valid = validateForm($form_login);

            if(form_valid.valid)    
            {                
                var form_data = new FormData($form_login[0]);
                
                $.ajax({
                    url: '<?=$url?>/session.php',
                    data: form_data,
                    type: 'POST',
                    processData: false,
                    contentType: false,

                    success: function(response){

                        response = JSON.parse(response);

                        if(response.status == 'success')
                        {
                            window.location.replace("../../home.php"); 
                        }
                        else
                        {
                            swal({
                                title: 'Login inválido',
                                text: 'Verifique seus dados e certifique-se de preencher todos os campos corretamente.',
                                type: 'error'
                            });                    
                        }
                    },
                    error: function()
                    {
                        swal({
                            title: 'Login inválido',
                            text: 'Verifique seus dados e certifique-se de preencher todos os campos corretamente.',
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