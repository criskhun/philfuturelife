<?php
session_start();
include '../../dbconn.php';

if (isset($_POST["ssstableInsert"])) {
    $range1 = $_POST["compRange1"];
    $range2 = $_POST["compRange2"];
    $er = $_POST["rSER"];
    $ee = $_POST["rSEE"];
    $ec = $_POST["EC"];
    $wispER = isset($_POST["wispER"]) ? (float)$_POST["wispER"] : 0;
    $wispEE = isset($_POST["wispEE"]) ? (float)$_POST["wispEE"] : 0;

    $creator = "Crispin Jose Uriarte";

    $wistTotal = $wispER + $wispEE;
    $t_er = $er + $ec + $wispER;
    $t_ee = $ee + $wispEE;
    $total = $t_er + $t_ee;
    
    $sql = "INSERT INTO sss_table (range1, range2, er, ee, ec, wispER, wispEE, wispTotal, t_er, t_ee, total, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssssss", $range1, $range2, $er, $ee, $ec, $wispER, $wispEE, $wistTotal, $t_er, $t_ee, $total, $creator);

        if ($stmt->execute()) {
            $_SESSION['success'] = "New row added successfully.";
            header("Location: ../humanResource/mandatoryBen.php?activeTab=sss");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }



    $conn->close();
}

if (isset($_POST['ssstableUpdate'])) {
    $id = $_POST['idUp'];
    $range1 = $_POST['compRange1up'];
    $range2 = $_POST['compRange2up'];
    $rser = $_POST['rSERup'];
    $rsee = $_POST['rSEEup'];
    $ec = $_POST['ECup'];
    $wisper = $_POST['wispERup'];
    $wispee = $_POST['wispEEup'];

    // Calculate total values if needed
    $wisptotal = $wisper + $wispee;
    $ter = $rser + $ec + $wisper;
    $tee = $rsee + $wispee;
    $total = $ter + $tee;

    $query = "UPDATE sss_table SET 
                range1 = '$range1', 
                range2 = '$range2', 
                er = '$rser', 
                ee = '$rsee', 
                ec = '$ec', 
                wispER = '$wisper', 
                wispEE = '$wispee', 
                wispTotal = '$wisptotal', 
                t_er = '$ter', 
                t_ee = '$tee', 
                total = '$total' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Updated row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=sss");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteRecord'])) {
    $delete_id = $_POST['delete_id'];

    echo "Deleting record" . $delete_id;

    $query = "DELETE FROM sss_table WHERE id = '$delete_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Deleted row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=sss");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST["hdmftableInsert"])) {
    $max = $_POST["max"];
    $range1 = $_POST["fundRange1"];
    $range2 = $_POST["fundRange2"];
    $er = $_POST["pER"];
    $ee = $_POST["pEE"];

    $creator = "Crispin Jose Uriarte";

    $t_er = ($er / 100) * $max;
    $t_ee = ($ee / 100) * $max;

    $total = $t_er + $t_ee;

    
    
    $sql = "INSERT INTO hdmf_table (max_fund, range1, range2, ps_er, ps_ee, t_er, t_ee, total, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssss", $max, $range1, $range2, $er, $ee, $t_er, $t_ee, $total, $creator);

        if ($stmt->execute()) {
            $_SESSION['success2'] = "New row added successfully.";
            header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['hdmftableUpdate'])) {
    $id = $_POST['idhdmfUp'];
    $max = $_POST['maxUp'];
    $range1 = $_POST['fundRange1up'];
    $range2 = $_POST['fundRange2up'];
    $rser = $_POST['pERup'];
    $rsee = $_POST['pEEup'];

    // Calculate total values if needed
    $t_er = ($rser / 100) * $max;
    $t_ee = ($rsee / 100) * $max;

    $total = $t_er + $t_ee;

    $query = "UPDATE hdmf_table SET 
                max_fund = '$max',
                range1 = '$range1', 
                range2 = '$range2', 
                ps_er = '$rser', 
                ps_ee = '$rsee', 
                t_er = '$t_er', 
                t_ee = '$t_ee', 
                total = '$total' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success2'] = "Updated row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteHMDF'])) {
    $delete_id = $_POST['delete_idHMDF'];

    echo "Deleting record" . $delete_id;

    $query = "DELETE FROM hdmf_table WHERE id = '$delete_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success2'] = "Deleted row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST["phictableInsert"])) {
    $range1 = $_POST["fundRange1"];
    $range2 = $_POST["fundRange2"];
    $er = $_POST["pER"];
    $ee = $_POST["pEE"];
    $minEE = $_POST["minEE"];
    $maxEE = $_POST["maxEE"];
    $minER = $_POST["minER"];
    $maxER = $_POST["maxER"];

    $creator = "Crispin Jose Uriarte";

    $total = $ee + $ee;

    $sql = "INSERT INTO phic_table (range1, range2, er, ee, total, min_ee, max_ee, min_er, max_er, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $range1, $range2, $er, $ee, $total, $minEE, $maxEE, $minER, $maxER, $creator);

        if ($stmt->execute()) {
            $_SESSION['success3'] = "New row added successfully.";
            header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['phictableUpdate'])) {
    $id = $_POST['idUpph'];
    $range1 = $_POST['phicRange1up'];
    $range2 = $_POST['phicRange2up'];
    $per = $_POST['phERup'];
    $pee = $_POST['phEEup'];
    $minEEup = $_POST['minEEup'];
    $maxEEup = $_POST['maxEEup'];
    $minERup = $_POST['minERup'];
    $maxERup = $_POST['maxERup'];

    // Calculate total values if needed
    $total = $pee + $per;

    $query = "UPDATE phic_table SET 
                range1 = '$range1', 
                range2 = '$range2', 
                er = '$per', 
                ee = '$pee', 
                total = '$total',
                min_ee = '$minEEup', 
                max_ee = '$maxEEup',
                min_er = '$minERup', 
                max_er = '$maxERup' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success3'] = "Updated row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deletePHIC'])) {
    $delete_id = $_POST['delete_idPHIC'];

    echo "Deleting record" . $delete_id;

    $query = "DELETE FROM phic_table WHERE id = '$delete_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success3'] = "Deleted row successfully.";
        header("Location: ../humanResource/mandatoryBen.php?activeTab=hdmf_phic");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST["birtableInsert"])) {
    $p_fq = $_POST["sellist"];
    $fix = $_POST["birFix"];
    $rate = $_POST["birRate"];

    $range1 = isset($_POST["birRange1"]) ? (float)$_POST["birRange1"] : 0;
    $range2 = isset($_POST["birRange2"]) ? (float)$_POST["birRange2"] : 0;
    $fix = isset($_POST["birFix"]) ? (float)$_POST["birFix"] : 0;
    $rate = isset($_POST["birRate"]) ? (float)$_POST["birRate"] : 0;

    $creator = "Crispin Jose Uriarte";

    $sql = "INSERT INTO bir_table (payroll_fq, range1, range2, fix, rate, creator) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $p_fq, $range1, $range2, $fix, $rate, $creator);

        if ($stmt->execute()) {
            $_SESSION['success'] = "New row added successfully.";
            header("Location: ../humanResource/bir.php?activeTab=bir");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['birtableUpdate'])) {
    $id = $_POST['idUpBIR'];
    $fq = $_POST['sellistup'];
    $range1 = $_POST['birRange1up'];
    $range2 = $_POST['birRange2up'];
    $fix = $_POST['birFixup'];
    $rate = $_POST['birRateup'];

    $query = "UPDATE bir_table SET 
                payroll_fq = '$fq',
                range1 = '$range1', 
                range2 = '$range2', 
                fix = '$fix', 
                rate = '$rate'
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Updated row successfully.";
        header("Location: ../humanResource/bir.php?activeTab=bir");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST['deleteBIR'])) {
    $delete_idBIR = $_POST['delete_idBIR'];

    echo "Deleting record" . $delete_idBIR;

    $query = "DELETE FROM bir_table WHERE id = '$delete_idBIR'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Deleted row successfully.";
        header("Location: ../humanResource/bir.php?activeTab=bir");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>