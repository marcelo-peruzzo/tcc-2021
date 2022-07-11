<?php include '../auth.php'; ?>
<?php include '../conexao.php'; ?>
<?php $page = 'Histórico'; 
$historico = true;  
$query2  = "SELECT COUNT( id )FROM Historico";
$count = mysqli_query($conn, $query2);
$count = mysqli_fetch_array($count);
?>

<!DOCTYPE html>
<html lang="pt-br">
   <?php include 'includes/head.php'; ?>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
   <link rel="stylesheet" href="<?=$url?>/assets/fonts/et-lineicon/et-lineicons.css" />
   <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
   <body>

      <div class="offcanvas-overlay"></div>

      <div class="wrapper">

         <?php include 'includes/header.php'; ?>

         <div class="main-wrapper">

            <?php include 'includes/aside.php'; ?>

            <div class="main-content">
                <div class="container-fluid">

                    <div class="card pb-2">
                        <div class="p-4">
                            <div class="row">
                                <div class="col-xl-12 mb-40">
                                    <h4 class="mb-3">Timeline</h4>

                                </div>
                                <div class="col-xl-12 mb-40">
                                  <input type="button" name="" class="btn" data-toggle="modal" data-target="#contactAddModal" value="Filtros" >
                                </div>
                                <div id="contactAddModal" class="modal fade">
                                  <div class="modal-dialog modal-dialog-centered">
                                     <div class="modal-content">

                                        <div class="modal-body">
                                            <div class="media flex-column flex-sm-row">
                                               <div class="contact-account-setting media-body">
                                                  <h4 class="mb-4">Filtros</h4>
                                                  <?php 
                                                    $URL_ATUAL= "$_SERVER[REQUEST_URI]";
                                                    if (isset($_GET['filter'])) {
                                                      $length = strpos($URL_ATUAL,"filter=");
                                                      $filter = substr($URL_ATUAL, $length);
                                                      if (strpos($filter, '&') !== false ) {
                                                         $length2 = strpos($filter,"&");
                                                         $filter = substr($filter, 0, $length2);
                                                      }
                                                    }

                                                    if (isset($_GET['tabela'])) {
                                                      $length = strpos($URL_ATUAL,"tabela=");
                                                      $tabela = substr($URL_ATUAL, $length);
                                                      if (strpos($tabela, '&') !== false ) {
                                                         $length2 = strpos($tabela,"&");
                                                         $tabela = substr($tabela, 0, $length2);
                                                      }
                                                    }
                                                  ?>

                                                  <span> Açoes    </span>
                                                  <a href="<?=$url?>/pages/historico.php?filter=EDITAR<?=$test = isset($_GET['tabela']) ? '&'.$tabela : '';?>">
                                                     <input class="btn" type="button" value="Editar" <?=$test2 = $_GET['filter']=='EDITAR' ? 'style="background-color: green"': ''?> />
                                                  </a>
                                                  <a href="<?=$url?>/pages/historico.php?filter=ADICIONAR<?=$test = isset($_GET['tabela']) ? '&'.$tabela : '';?>">
                                                     <input class="btn" type="button" value="Adicionar" <?=$test2 = $_GET['filter']=='ADICIONAR' ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  <a  href="<?=$url?>/pages/historico.php?filter=DELETAR<?=$test = isset($_GET['tabela']) ? '&'.$tabela : '';?>">
                                                     <input class="btn" type="button"  value="Deletar" <?=$test2 = $_GET['filter']=='DELETAR' ? 'style="background-color: green"': ''?> />
                                                  </a>
                                                  <br>
                                                  <br>
                                                  <span>Tabelas </span>
                                                  <a href="<?=$url?>/pages/historico.php?tabela=USUARIO<?=$test = isset($_GET['filter']) ? '&'.$filter : '';?>">
                                                     <input class="btn" type="button" value="Usuário" <?=$test2 = $_GET['tabela']=='USUARIO' ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  <a href="<?=$url?>/pages/historico.php?tabela=SFP<?=$test = isset($_GET['filter']) ? '&'.$filter : '';?>">
                                                     <input class="btn" type="button" value="Sfp" <?=$test2 = $_GET['tabela']=='SFP' ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  <a href="<?=$url?>/pages/historico.php?tabela=CHAVE<?=$test = isset($_GET['filter']) ? '&'.$filter : '';?>">
                                                     <input class="btn" type="button" value="Chave" <?=$test2 = $_GET['tabela']=='CHAVE' ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  <a href="<?=$url?>/pages/historico.php?tabela=TECNICO<?=$test = isset($_GET['filter']) ? '&'.$filter : '';?>">
                                                     <input class="btn" type="button" value="Técnico" <?=$test2 = $_GET['tabela']=='TECNICO' ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  <br>
                                                  <br>
                                                  <a href="<?=$url?>/pages/historico.php ">
                                                     <input class="btn" type="button" value="Limpar" <?=$test2 = !isset($_GET['filter']) && !isset($_GET['tabela']) ? 'style="background-color: green"': ''?>/>
                                                  </a>
                                                  
                                               </div>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>

                                <div class="col-xl-12">
                                    
                                	<?php 
                                		$query2  = "SELECT COUNT( id )FROM Historico";
                                        $count = mysqli_query($conn, $query2);
                                        $count = mysqli_fetch_array($count);
                                    ?>

                                    <div id="timeline-wrap">
                                        <ul class="timeline">
                                            
                                            <?php
                                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                            date_default_timezone_set('America/Sao_Paulo');
                                            $query  = "SELECT * FROM Historico ORDER BY id DESC ";
                                            $his = mysqli_query($conn, $query);
                                            while($hist = mysqli_fetch_array($his)){ 

                                              $date = date_create($hist['date']);
                                              $date2 = date_format($date, 'd/m/Y');
                                              $acao = substr($hist['query'], 0, 2);
                                              if($acao[0] == ' ') {
                                                $acao = substr($acao, 1, 1);
                                              }else{
                                                $acao = substr($acao, 0, 1);
                                              }

                                              if ($acao == "I") {
                                                  $mod = 'ADICIONAR';
                                              }elseif ($acao == "U") {
                                                  $mod = 'EDITAR';
                                              }else{
                                                $mod = 'DELETAR';
                                              }
                                              if (isset($_GET['filter']) ) {
                                                  if ($_GET['filter'] != $mod) {
                                                      continue;
                                                  }
                                              }
                                              if (isset($_GET['tabela']) ) {

                                                $tab = ucfirst(strtolower($_GET['tabela']));

                                                  if ($tab != $hist['tabela']) {
                                                      continue;
                                                  }
                                              }

                                              ?>
                                              
                                              <li class="event" data-date="<?php if($date_conf != $date2){echo strftime('%d de %B de %Y', strtotime($hist['date']));}?>">

                                                <span><?php echo date_format($date, 'g:i A')?></span>
                                                <h4 style="text-transform: none;">[<?=$mod?>] <?=$hist['descricao']?></h4>

                                            </li>

                                            <?php $date_conf = $date2;  } ?>

                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

         <?php include 'includes/footer.php'; ?>

      </div>

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