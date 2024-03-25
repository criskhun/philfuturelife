<?php
    if (isset($_SESSION['status'])) {
?>
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong> <?= $_SESSION['status'] ?>
    </div>
    <?php 
        unset($_SESSION['status']);
    }
?>

<?php
    if (isset($_SESSION['status2'])) {
?>
    <div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Warning!</strong> <?= $_SESSION['status2'] ?>
    </div>
    <?php 
        unset($_SESSION['status2']);
    }
?>

<?php
    if (isset($_SESSION['status3'])) {
?>
    <div class="alert alert-warning alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Info!</strong> <?= $_SESSION['status3'] ?>
    </div>
    <?php 
        unset($_SESSION['status3']);
    }
?>