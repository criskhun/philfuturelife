<?php 
include('../authentication.php');
$page_title = "Dashboard";
include('../includes/headerAuth.php');


?>

<div class="wrapper">
    <aside id="sidebar">
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="#">PhilFutureLife</a>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Admin Element
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-file-lines pe-2"></i>
                        Pages
                    </a>
                    <ul id="pages" class="sidebar-dropdown list-unstyled-collapse show" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Page 1</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Page 2</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="true">
                        <i class="fa-solid fa-sliders pe-2"></i>
                        Post
                    </a>
                    <ul id="posts" class="sidebar-dropdown list-unstyled-collapse show" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Post 1</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Post 2</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Post 3</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" data-bs-target="#reports" data-bs-toggle="collapse" aria-expanded="true">
                        <i class="fa-regular fa-user pe-2"></i>
                        Reports
                    </a>
                    <ul id="reports" class="sidebar-dropdown list-unstyled-collapse show" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Sales</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Employee</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Inventory</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-header">
                    Multi Level Menu
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" data-bs-target="#multi" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-share-nodes pe-2"></i>
                        Multi Dropdown
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled-collapse show" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1" data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                            <ul id="level-1" class="sidebar-dropdown list-unstyled-collapse show">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Level 1.1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Level 1.2</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Level 1.3</a>
                                </li>
                            </ul>
                            
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <button class="btn fa-solid fa-bars" id="sidebar-toggle" type="button">
                <span class="navbar-toggle-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <img src="../images/sklogo.png" class="avatar img-fluid rounded" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="mb-3">
                    <h4>Admin Dashboard</h4>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill border-0 illustration">
                            <div class="card-body p-0 d-flex flex-fill">
                                <div class="row g-0 w-100">
                                    <div class="col-6">
                                        <div class="p-3 m-1">
                                            <h4>Welcome Back Admin</h4>
                                            <p class="mb-0">Admin Dashboard, NinjaCris</p>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-end text-end">
                                        <img src="../images/social.png" alt="" class="img-fluid illustration-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-item-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                            P 78.00
                                        </h4>
                                        <p class="mb-2">
                                            Total earnings
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="text-muted">
                                                Since last month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table elements -->
                <div class="card border-0">
                    <div class="card-header">
                        <h5 class="card-title">
                            Basic Table
                        </h5>
                        <h6 class="card-subtitle text-muted">
                            lorem ipsum dolor sit amet consectetur adispistisicing elts. Voluptutatum dacimutation
                            neccesities tibus reprehepibus itaque!
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <a href="#" class="theme-toggler">
            <i class="fa-regular fa-moon"></i>
            <i class="fa-regular fa-sun"></i>
        </a>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a href="#" class="text-muted">
                                <strong>NinjaCris</strong>
                            </a>
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
                            <div class="list-inline-item">
                                <a href="#" class="text-muted">Contact</a>
                            </div>
                            <div class="list-inline-item">
                                <a href="#" class="text-muted">About us</a>
                            </div>
                            <div class="list-inline-item">
                                <a href="#" class="text-muted">Terms</a>
                            </div>
                            <div class="list-inline-item">
                                <a href="#" class="text-muted">Business</a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>



<?php include('../includes/footer.php'); ?>