<?php
   include 'auth.php';
   include 'conexao.php';
   $home = true;
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include 'pages/includes/head.php'; ?>

<body>

   <!-- Offcanval Overlay -->
   <div class="offcanvas-overlay"></div>
   <!-- Offcanval Overlay -->

   <!-- Wrapper -->
   <div class="wrapper">

      <!-- Header -->
      <header class="header white-bg fixed-top d-flex align-content-center flex-wrap">
         <!-- Logo -->
         <div class="logo">
            <a href="index.php" class="default-logo"><img src="<?=$url?>/assets/img/logo.png" alt=""></a>
            <a href="index.php" class="mobile-logo"><img src="<?=$url?>/assets/img/mobile-logo.png" alt=""></a>
         </div>
         <!-- End Logo -->

         <!-- Main Header -->
            <?php include 'pages/includes/header.php'; ?>
         <!-- End Header -->

      <!-- Main Wrapper -->
      <div class="main-wrapper">

         <?php include 'pages/includes/aside.php'; ?>

      </div>

      <!-- Footer -->
         <?php include 'pages/includes/footer.php'; ?>
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
   <script src="<?=$url?>/assets/plugins/apex/apexcharts.min.js"></script>
   <script src="<?=$url?>/assets/plugins/apex/custom-apexcharts.js"></script>
   <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
</body>

</html>