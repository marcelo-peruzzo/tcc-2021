<header class="header white-bg fixed-top d-flex align-content-center flex-wrap">
         <!-- Logo -->
         <div class="logo">
            <a href="<?=$url?>/index.php" class="default-logo"><img src="<?=$url?>/assets/img/logo_b.png" alt=""></a>
            <a href="<?=$url?>/index.php" class="mobile-logo"><img src="<?=$url?>/assets/img/logo_mob.png" alt=""></a>
         </div>
         <!-- End Logo -->

         <!-- Main Header -->
         <div class="main-header">
            <div class="container-fluid">
               <div class="row justify-content-between">
                  <div class="col-3 col-lg-1 col-xl-4">
                     <!-- Header Left -->
                     <div class="main-header-left h-100 d-flex align-items-center">
                        <!-- Main Header User -->
                        <div class="main-header-user">
                           <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                              <div class="menu-icon">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </div>

                              <div class="user-profile d-xl-flex align-items-center d-none">
                                 <!-- User Avatar -->
                                 <div class="user-avatar">
                                    <img src="<?=$url . "/" . $_SESSION['foto']?>" alt="Perfil">
                                 </div>
                                 <!-- End User Avatar -->

                                 <!-- User Info -->
                                 <div class="user-info">
                                    <h4 class="user-name"><?=$_SESSION['usuario']?></h4>
                                    <p class="user-email"><?=$_SESSION['email']?></p>
                                 </div>
                                 <!-- End User Info -->
                              </div>
                           </a>
                           <div class="dropdown-menu">
                              <a href="<?=$url?>/pages/edit-user.php">Perfil</a>
                              <a href="<?=$url?>/destroy.php">Sair</a>
                           </div>
                        </div>
                        <!-- End Main Header User -->

                        <!-- Main Header Menu -->
                        <div class="main-header-pin d-block d-lg-none">
                           <div class="header-toogle-menu">
                              <img src="<?=$url?>/assets/img/menu.png" alt="">
                           </div>
                        </div>
                        <!-- End Main Header Menu -->
                     </div>
                     <!-- End Header Left -->
                  </div>
                  <div class="col-9 col-lg-11 col-xl-8">
                     <!-- Header Right -->
                     <div class="main-header-right d-flex justify-content-end">
                        <ul class="nav">
                           <!-- <li class="ml-0 d-none d-lg-flex">
                              <div class="main-header-print">
                                 <a href="#">
                                    <img src="<?=$url?>/assets/img/svg/print-icon.svg" alt="">
                                 </a>
                              </div>
                           </li> -->
                           <li class="d-none d-lg-flex">
                              <!-- Main Header Time -->
                              <div class="main-header-date-time text-right">
                                 <h3 class="time">
                                    <span id="hours">21</span>
                                    <span id="point">:</span>
                                    <span id="min">06</span>
                                 </h3>
                                 <span class="date"><span id="date">Tue, 12 October 2019</span></span>
                              </div>
                              <!-- End Main Header Time -->
                           </li>
                           
                           <!-- <li>
                              <div class="main-header-notification">
                                 <a href="#" class="header-icon notification-icon" data-toggle="dropdown">
                                    <span class="count" data-bg-img="<?=$url?>/assets/img/count-bg.png">22</span>
                                    <img src="<?=$url?>/assets/img/svg/notification-icon.svg" alt="" class="svg">
                                 </a>
                                 <div class="dropdown-menu style--two dropdown-menu-right">
                                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                                       <h5>5 New notifications</h5>
                                       <a href="#" class="text-mute d-inline-block">Clear all</a>
                                    </div>

                                    <div class="dropdown-body">
                                       <a href="#" class="item-single d-flex align-items-center">
                                          <div class="content">
                                             <div class="mb-2">
                                                <p class="time">2 min ago</p>
                                             </div>	
                                             <p class="main-text">Donec dapibus mauris id odio ornare tempus amet.</p>
                                          </div>
                                       </a>

                                       <a href="#" class="item-single d-flex align-items-center">
                                          <div class="content">
                                             <div class="mb-2">
                                                <p class="time">2 min ago</p>
                                             </div>	
                                             <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                          </div>
                                       </a>

                                       <a href="#" class="item-single d-flex align-items-center">
                                          <div class="content">
                                             <div class="mb-2">
                                                <p class="time">2 min ago</p>
                                             </div>	
                                             <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                          </div>
                                       </a>

                                       <a href="#" class="item-single d-flex align-items-center">
                                          <div class="content">
                                             <div class="mb-2">
                                                <p class="time">2 min ago</p>
                                             </div>	
                                             <p class="main-text">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo.</p>
                                          </div>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </li> -->
                        </ul>
                     </div>
                     <!-- End Header Right -->
                  </div>
               </div>
            </div>
         </div>
         <!-- End Main Header -->
      </header>
      <!-- End Header -->