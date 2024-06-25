<?php
include('../../authentication.php');
$page_title = "Public";
include("../header.php");
include("../../dbconn.php");


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
}

$queryJP = "SELECT COUNT(*) AS active_count FROM job_posting WHERE active = 1";
$result = $conn->query($queryJP);

if ($result) {
    $row = $result->fetch_assoc();
    $activeCount = $row['active_count'];
} else {
    echo "Error: " . $conn->error;
}

?>

<link rel="stylesheet" href="../../includes/publicStyle.css">

<?php
    include("../public/public_navbar.php");
?>
<div style="width: 100%; background-color: #f8f9fa; text-align: center; padding: 20px 0;">
    <div class="content" style="display: inline-block;">
        Win on PhilFutureLife with the #1 Insurance Training Course
        <button type="button" class="btn btn-primary glow">Explore Freedom Ticket</button>
    </div>
</div>
<div class="container mt-2 mb-2">
    <div class="row align-items-center">
        <div class="col-md-10">
            <h4 class="text-secondary"><strong>Welcome, <?php echo $name ?></strong></h4>
        </div>
        <div class="col-md-2 d-flex justify-content-end align-items-end">
            <button class="btn btn-light"><i class="fa-solid fa-video"></i> Learn</button>
        </div>
    </div>
    <div class="container mt-2 mb-2" style="background-color: #f8f9fa; padding: 10px">
        <div class="row align-items-center">
            <div class="col-md-2">
                <div style="display: flex; align-items: center;">
                    <img src="../../images/pfl_favbicon.png" alt="" style="width: 20%;">
                    <i class="fa-solid fa-equals mx-2"></i>
                    <img src="../../images/apple-logo.png" alt="" style="width: 20%;">
                    <i class="fa-solid fa-plus mx-2"></i>
                    <img src="../../images/computer.png" alt="" style="width: 20%;">
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div style="display: flex; flex-direction: column;">
                    <h6><strong>Accessible Using Any Compatible Browser</strong></h6>
                    <p style="color: gray;">Use freely using your mobile devices</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-end">
                <div class="text-right">
                    <button class="btn btn-outline-primary"><i class="fa-solid fa-video"></i> Learn</button>
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i> Save in your browser</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-2 mb-2">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><strong>Find and Subscribe Your First Insurance</strong></h4>
            <p class="card-text text-secondary">We've analyzed your partner.</p>
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 1</h5>
                                <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quia ut at, beatae possimus repudiandae corporis explicabo quibusdam sunt modi voluptate. Dolor totam ipsa natus, illo vero itaque reprehenderit autem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 2</h5>
                                <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quia ut at, beatae possimus repudiandae corporis explicabo quibusdam sunt modi voluptate. Dolor totam ipsa natus, illo vero itaque reprehenderit autem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 3</h5>
                                <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quia ut at, beatae possimus repudiandae corporis explicabo quibusdam sunt modi voluptate. Dolor totam ipsa natus, illo vero itaque reprehenderit autem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 4</h5>
                                <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quia ut at, beatae possimus repudiandae corporis explicabo quibusdam sunt modi voluptate. Dolor totam ipsa natus, illo vero itaque reprehenderit autem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 5</h5>
                                <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quia ut at, beatae possimus repudiandae corporis explicabo quibusdam sunt modi voluptate. Dolor totam ipsa natus, illo vero itaque reprehenderit autem.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <div class="container mb-4">
            <div class="row align-items-center">
                <div class="col-auto">
                    <p class="text-secondary mb-0">2/5 Completed</p>
                </div>
                <div class="col">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 40%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container mt-2 mb-2">
    <div class="row mt-2">
        <div class="col-sm-6 mt-2 d-flex align-items-stretch">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><strong>Try out our Service</strong></h5>
                    <p class="card-text text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi, laudantium nulla quae quis aliquid rerum iste fuga doloribus atque odio dicta qui? Possimus ea provident, et debitis sapiente qui at?</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2 d-flex align-items-stretch">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><strong>Find our nearest service</strong></h5>
                    <p class="card-text text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, sapiente iste. Architecto possimus, qui nulla explicabo itaque inventore repellat minus sequi! Fuga corporis consequuntur accusantium autem excepturi possimus omnis. Porro.</p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container mt-2 mb-2">
    <div class="row mt-2">
        <div class="col-sm-8 mt-2 mb-2 d-flex align-items-stretch">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><strong>Try out our Service</strong></h5>
                    <p class="card-text text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur sequi eum accusantium repudiandae consequatur optio asperiores iste velit voluptatem saepe eius culpa harum excepturi totam cupiditate quos, minima laudantium cumque.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2 mb-2 d-flex align-items-stretch">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><strong>Join our community and learn the latest financial strategies</strong></h5><br>
                    <p class="card-text text-secondary">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis repellendus recusandae adipisci nesciunt quasi? Asperiores hic blanditiis modi accusantium soluta. Porro dolore dicta ullam laboriosam quam exercitationem dolorum! Eveniet, architecto?</p><br>
                    <button type="button" class="btn btn-outline-primary btn-lg mb-2 mt-2"><i class="fa-brands fa-facebook"></i><strong> Join our facebook group</strong></button><br>
                    <button type="button" class="btn btn-outline-primary btn-lg mb-2 mt-2"><i class="fa-solid fa-arrow-up-right-from-square"></i><strong> Listen to our Podcast</strong></button>
                </div>
            </div>
        </div>
    </div>
</div>







<?php

include("../footer.php");

?>