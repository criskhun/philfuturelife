<?php
include('../authentication.php');
$page_title = "Dashboard";
include('../includes/headerAuth.php');
include('../dbconn.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($userData = $result->fetch_assoc()) {
        // User found
    } else {
        // No user found with the provided email address.
        $_SESSION['status'] = "User not found.";
        header('Location: ../login.php');
        exit(0);
    }

    switch ($userData['account_stat']) {
        case '0':
            header('Location: ../users/public/index.php?email=' . urlencode($email));
            exit(0);
        case '1':
            header('Location: ../users/subscriber/index.php?email=' . urlencode($email));
            exit(0);
        case '2':
            header('Location: ../users/employee/dashboard.php?email=' . urlencode($email));
            exit(0);
        case '3':
            header('Location: officer_page.php?email=' . urlencode($email));
            exit(0);
        case '4':
            header('Location: board_page.php?email=' . urlencode($email));
            exit(0);
        case '5':
            // Admin page, stay on the same page
            break;
        default:
            // Unknown account status
            $_SESSION['status'] = "Invalid account status.";
            header('Location: ../login.php');
            exit(0);
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['status'] = "Email not set in session.";
    header('Location: ../login.php');
    exit(0);
}
?>

<div class="wrapper">
    <!--Side Bar -->
    <?php include('../includes/sidebar.php') ?>
    <div class="main">
        <!-- navbar -->
        <?php include('../includes/adminNavbar.php') ?>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="m-3 admin-header">
                    <span>
                        <h6>Admin Dashboard |</h6>
                    </span>
                    <span>
                        <h6>Welcome back admin: <?= htmlspecialchars($name); ?></h6>
                    </span>
                    <span>
                        <h6>Account Stat: <?= htmlspecialchars($userData['account_stat']); ?></h6>
                    </span>
                </div>
                <!-- dashboard content -->
                <?php include('dashboard.php') ?>
            </div>
        </main>
        <!-- Theme toggler -->
        <?php include('../includes/themeToggler.php') ?>
        <!-- Footer -->
        <?php include('../includes/adminFooter.php') ?>
    </div>
</div>

<script src="../includes/chart.js"></script>

<?php include('../includes/footer.php'); ?>
