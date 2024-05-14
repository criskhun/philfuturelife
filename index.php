<?php 
$page_title = "Home Page";
include('includes/header.php');
?>
<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

    
<?php
include('includes/navbar.php');
?>
</div>
<div class="py-5 backgroundimage" id="background-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                
            </div>
        </div>
    </div>
</div>

    <div class="alertfoot alert alert-primary alert-dismissible fade show"> 
        This website uses cookies to improve your experience. We'll assume you're ok with this, but you can opt-out if you wish.
        <a class="" href="index.php">Cookie settings</a>
        <button type="button" class="btn btn-primary" data-bs-dismiss="alert">Accept</button>
    </div>

<?php include('includes/footer.php'); ?>
