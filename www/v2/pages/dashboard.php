<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $dash = true; ?>
<!DOCTYPE html>
<html lang="pt-br">


<?php include 'includes/head.php'; ?>

<script type="text/javascript">
    jan = 0;
    fev = 0;
    mar = 0;
    abr = 0;
    mai = 0;
    jun = 0;
    jul = 0;
    ago = 0;
    set = 0;
    out = 0;
    nov = 0;
    dez = 0;
    jan2 = 0;
    fev2 = 0;
    mar2 = 0;
    abr2 = 0;
    mai2 = 0;
    jun2 = 0;
    jul2 = 0;
    ago2 = 0;
    set2 = 0;
    out2 = 0;
    nov2 = 0;
    dez2 = 0;
    jan3 = 0;
    fev3 = 0;
    mar3 = 0;
    abr3 = 0;
    mai3 = 0;
    jun3 = 0;
    jul3 = 0;
    ago3 = 0;
    set3 = 0;
    out3 = 0;
    nov3 = 0;
    dez3 = 0;
</script>
<?php
        $users  = mysqli_query($conn, "SELECT data, quantidade FROM Dashboard WHERE YEAR(data) = YEAR(CURRENT_DATE()) AND tabela = 'Sfp'");

        while($user = mysqli_fetch_array($users)){
            $quant = $user['quantidade'];
            $rest = substr($user['data'], 5, -12);
            if($rest == 1){
                echo "<script type='text/javascript'> jan += " . $quant . " ; </script>";
            }elseif ($rest == 2) {
                echo "<script type='text/javascript'> fev += " . $quant . " ; </script>";
            }elseif ($rest == 3) {
                echo "<script type='text/javascript'> mar += " . $quant . " ; </script>";
            }elseif ($rest == 4) {
                echo "<script type='text/javascript'> abr += " . $quant . " ; </script>";
            }elseif ($rest == 5) {
                echo "<script type='text/javascript'> mai += " . $quant . " ; </script>";
            }elseif ($rest == 6) {
                echo "<script type='text/javascript'> jun += " . $quant . " ; </script>";
            }elseif ($rest == 7) {
                echo "<script type='text/javascript'> jul += " . $quant . " ; </script>";
            }elseif ($rest == 8) {
                echo "<script type='text/javascript'> ago += " . $quant . " ; </script>";
            }elseif ($rest == 9) {
                echo "<script type='text/javascript'> set += " . $quant . " ; </script>";
            }elseif ($rest == 10) {
                echo "<script type='text/javascript'> out += " . $quant . " ; </script>";
            }elseif ($rest == 11) {
                echo "<script type='text/javascript'> nov += " . $quant . " ; </script>";
            }elseif ($rest == 12) {
                echo "<script type='text/javascript'> dez += " . $quant . " ; </script>";
            }
        }
                         
?>

<?php
        $users  = mysqli_query($conn, "SELECT data FROM Dashboard WHERE YEAR(data) = YEAR(CURRENT_DATE()) AND tabela = 'Chave' AND acao = 'R' ");

        while($user = mysqli_fetch_array($users)){
            $rest = substr($user['data'], 5, -12);
            if($rest == 1){
                echo "<script type='text/javascript'> jan2 += 1; </script>";
            }elseif ($rest == 2) {
                echo "<script type='text/javascript'> fev2 += 1; </script>";
            }elseif ($rest == 3) {
                echo "<script type='text/javascript'> mar2 += 1; </script>";
            }elseif ($rest == 4) {
                echo "<script type='text/javascript'> abr2 += 1; </script>";
            }elseif ($rest == 5) {
                echo "<script type='text/javascript'> mai2 += 1; </script>";
            }elseif ($rest == 6) {
                echo "<script type='text/javascript'> jun2 += 1; </script>";
            }elseif ($rest == 7) {
                echo "<script type='text/javascript'> jul2 += 1; </script>";
            }elseif ($rest == 8) {
                echo "<script type='text/javascript'> ago2 += 1; </script>";
            }elseif ($rest == 9) {
                echo "<script type='text/javascript'> set2 += 1; </script>";
            }elseif ($rest == 10) {
                echo "<script type='text/javascript'> out2 += 1; </script>";
            }elseif ($rest == 11) {
                echo "<script type='text/javascript'> nov2 += 1; </script>";
            }elseif ($rest == 12) {
                echo "<script type='text/javascript'> dez2 += 1; </script>";
            }
        }
        $users  = mysqli_query($conn, "SELECT data FROM Dashboard WHERE YEAR(data) = YEAR(CURRENT_DATE()) AND tabela = 'Chave' AND acao = 'D' ");

        while($user = mysqli_fetch_array($users)){
            $rest = substr($user['data'], 5, -12);
            if($rest == 1){
                echo "<script type='text/javascript'> jan3 += 1; </script>";
            }elseif ($rest == 2) {
                echo "<script type='text/javascript'> fev3 += 1; </script>";
            }elseif ($rest == 3) {
                echo "<script type='text/javascript'> mar3 += 1; </script>";
            }elseif ($rest == 4) {
                echo "<script type='text/javascript'> abr3 += 1; </script>";
            }elseif ($rest == 5) {
                echo "<script type='text/javascript'> mai3 += 1; </script>";
            }elseif ($rest == 6) {
                echo "<script type='text/javascript'> jun3 += 1; </script>";
            }elseif ($rest == 7) {
                echo "<script type='text/javascript'> jul3 += 1; </script>";
            }elseif ($rest == 8) {
                echo "<script type='text/javascript'> ago3 += 1; </script>";
            }elseif ($rest == 9) {
                echo "<script type='text/javascript'> set3 += 1; </script>";
            }elseif ($rest == 10) {
                echo "<script type='text/javascript'> out3 += 1; </script>";
            }elseif ($rest == 11) {
                echo "<script type='text/javascript'> nov3 += 1; </script>";
            }elseif ($rest == 12) {
                echo "<script type='text/javascript'> dez3 += 1; </script>";
            }
        }
                         
?>


<body>

   <!-- Offcanval Overlay -->
   <div class="offcanvas-overlay"></div>
   <!-- Offcanval Overlay -->

   <!-- Wrapper -->
   <div class="wrapper">
      <!-- Header -->

      <?php include 'includes/header.php'; ?>
      <link rel="stylesheet" href="<?=$url?>/assets/fonts/et-lineicon/et-lineicons.css" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

      <!-- Main Wrapper -->
      <div class="main-wrapper">
         
         <!-- Sidebar -->
         
        <?php include 'includes/aside.php'; ?>

        <div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-8">
                <!-- Card -->
                <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="increase">
                            <div class="card-title d-flex align-items-end mb-2">
                            <h2>Seja Bem-vindo!</h2>                            
                            </div>
                            <h3 class="card-subtitle mb-2"><?= $_SESSION['usuario'] ?></h3>
                            <p class="font-16">Visualização rápida dos principais indicadores de desempenho relevantes em nosso sistema.</p>
                        </div>
                        <div class="congratulation-img">
                            <img src="../assets/img/svg/dash.svg" alt="Dashboard">
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card area-chart-box mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="mb-1">Usuários</h4>
                            <p class="font-14 c3">Novos usuários nesse mês.</p>
                        </div>
                        <div class="icon-dash">
                            <figure>
                                <img src="../assets/img/svg/user_dash.svg">
                            </figure>
                        </div>
                    </div>
                    <div class="card-qtd">
                    
                       <?php
                            $users  = mysqli_query($conn, "SELECT id FROM Usuario WHERE MONTH(data) = MONTH(CURRENT_DATE()) AND YEAR(data) = YEAR(CURRENT_DATE())");
                            $qtd_user = mysqli_num_rows($users);
                       ?>
                        <h2><?=$qtd_user?></h2>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card area-chart-box mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="mb-1">Técnicos</h4>
                            <p class="font-14 c3">Novos técnicos nesse mês.</p>
                        </div>
                        <div class="icon-dash">
                            <figure>
                                <img src="../assets/img/svg/tec.svg">
                            </figure>
                        </div>
                    </div>
                    <div class="card-qtd">
                    
                       <?php
                            $users  = mysqli_query($conn, "SELECT id FROM Tecnico WHERE MONTH(data) = MONTH(CURRENT_DATE()) AND YEAR(data) = YEAR(CURRENT_DATE())");
                            $qtd_user = mysqli_num_rows($users);
                       ?>
                        <h2><?=$qtd_user?></h2>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card area-chart-box mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="mb-1">SFP</h4>
                            <p class="font-14 c3">Novos SFP's nesse mês.</p>
                        </div>
                        <div class="icon-dash">
                            <figure>
                                <img src="../assets/img/svg/sfp_dash.svg">
                            </figure>
                        </div>
                    </div>
                    <div class="card-qtd">
                    
                       <?php
                            $users  = mysqli_query($conn, "SELECT id FROM Sfp WHERE MONTH(data) = MONTH(CURRENT_DATE()) AND YEAR(data) = YEAR(CURRENT_DATE())");
                            $qtd_user = mysqli_num_rows($users);

                       ?>
                        <h2><?=$qtd_user?></h2>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card area-chart-box mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="mb-1">Chaves</h4>
                            <p class="font-14 c3">Novas chaves nesse mês.</p>
                        </div>
                        <div class="icon-dash">
                            <figure>
                                <img src="../assets/img/svg/key_dash.svg">
                            </figure>
                        </div>
                    </div>
                    <div class="card-qtd">
                    
                       <?php
                            $users  = mysqli_query($conn, "SELECT id FROM Chave WHERE MONTH(data) = MONTH(CURRENT_DATE()) AND YEAR(data) = YEAR(CURRENT_DATE())");
                            $qtd_user = mysqli_num_rows($users);
                       ?>
                        <h2><?=$qtd_user?></h2>
                    </div>
                </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-12 mb-4">
                <!-- Card -->
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3">
                        <div class="title-content mb-4 mb-sm-0">
                            <h4 class="mb-2">SFP's</h4>
                            <p class="mb-3">Sfp's retirados</p>
                        </div>
                        <!-- <div class="">
                            <ul class="list-inline list-button m-0">
                            <li>2020</li>
                            <li class="active">2021</li>
                            <li>2022</li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div id="apex_line3-chart"></div>
                </div>
                <!-- End Card -->
            </div>

            <!-- <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3">
                        <div class="title-content mb-4 mb-sm-0">
                            <h4 class="mb-2">Chaves</h4>
                            <p>Solicitude announcing as to sufficient my</p>
                        </div>
                        <div class="">
                            <ul class="list-inline list-button m-0">
                            <li>2020</li>
                            <li class="active">2021</li>
                            <li>2022</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="apex_line4-chart"></div>
                </div>
            </div> -->
            
            <div class="col-xl-12">
                <!-- Card -->
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3">
                        <div class="title-content mb-4 mb-sm-0">
                            <h4 class="mb-2">Chaves</h4>
                            <p class="mb-3">Atualizações das chaves</p>
                        </div>
                        <!-- <div class="">
                            <ul class="list-inline list-button m-0">
                            <li>2020</li>
                            <li class="active">2021</li>
                            <li>2022</li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div id="apex_bar-chart"></div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
</div>

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

    <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
    <script src="<?=$url?>/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=$url?>/assets/plugins/apex/custom-apexcharts.js"></script>
    <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
</body>

</html>