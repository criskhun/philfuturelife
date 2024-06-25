<?php
include('../../authentication.php');
$page_title = "Officer";
include("../header.php");


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
}

?>

<nav class="navbar navbar-expand-lg navbar-light px-4 py-3 nav-stick">
    <div class="input-group input-group-navbar">
        <img src="../../images/mainlogo.png" style="width: 12%;" alt="" class="me-3">
                
    </div>
    <div class="d-flex align-items-center">        
        <a href="#" class="me-3 text-nowrap" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-bs-toggle="offcanvas" data-bs-target="#demo">What's New?</a>
        <button class="btn btn-light me-2"><i class="fa-regular fa-circle-question"></i></button>
        <button class="btn btn-light me-2"><i class="fa-brands fa-facebook"></i></button>
        <button class="btn btn-primary me-3" >Subscribe</button>
    </div>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0 me-3" data-bs-toggle="dropdown">
                    <img src="../../images/motorcyclist.png" class="avatar img-fluid" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <div class="dropdown-diverder"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>Help</span>
                    </a>
                    <hr>
                    <a href="../../includes/logoutSession.php" class="dropdown-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
<h4 class="text-primary">Welcome <?php echo $name ?></h4>
</div>

<!-- offcanvass what's new -->
<div class="offcanvas offcanvas-end" id="demo">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Heading</h1>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <button class="btn btn-secondary" type="button">A Button</button>
  </div>
</div>

<?php

include("../footer.php");

?>