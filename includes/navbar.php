


    <div class="alerthome alert alert-primary alert-dismissible fade show"> 
        <strong>Serbisyong maasahan at may puso.</strong> Professional, 24/7 available and perfectly affordable
        Mortuary Care Services for every Filipino Family. Dahil ang paghahanda ay hindi kailangang mahal.
        <a class="" href="index.php">0938-899-2534!</a>
        <i class="fa-solid fa-xmark button" data-bs-dismiss="alert"></i>
    </div>
    <div class="bg-navbar12" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg bg-navbar12">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="<?php echo isset($_SESSION['authenticated']) ? 'dashboard.php' : 'index.php'; ?>">
                                <img src="images/mainlogo.png" class="imagelogosize" alt="PhilFutureLife Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
                                    <?php if(!isset($_SESSION['authenticated'])): ?>
                                        <li class="nav-item <?php if($currentPage == 'index.php'){ echo 'active'; } ?>">
                                            <a class="btnlog btn btn-outline-primary" href="index.php">Contact Us</a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if(isset($_SESSION['authenticated'])): ?>
                                        <li class="nav-item <?php if($currentPage == 'dashboard.php'){echo 'active';} ?>">
                                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item <?php if($currentPage == 'register.php'){echo 'active';} ?>">
                                            <a class="btnlog btn btn-primary" href="register.php">Sign Up</a>
                                        </li>
                                        <li class="nav-item <?php if($currentPage == 'login.php'){echo 'active';} ?>">
                                            <a class="nav-link" href="login.php">Login</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(isset($_SESSION['authenticated'])): ?>
                                        <li class="nav-item">
                                            <a class="nav-link"  href="../logout.php">Logout</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
