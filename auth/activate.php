<?php  
include("../config/database.php");

if (!empty($_GET['key'])) {
    $key = $_GET['key'];
    
    $stmt = $conn->prepare("SELECT * FROM signup WHERE activation_key = ?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['is_active'] == 0) {
            $update = $conn->prepare("UPDATE signup SET is_active = 1 WHERE activation_key = ?");
            $update->bind_param("s", $key);
            $update->execute();

            // Redirect to home (index.php)
            header("Location: ../index.php?activated=true");
            exit();
        } else {
            // Already activated
            header("Location: ../index.php?already_active=true");
            exit();
        }
    } else {
        // Invalid key
        header("Location: ../index.php?invalid_key=true");
        exit();
    }
} else {
    // Key is missing
    header("Location: ../index.php?error=missing_key");
    exit();
}
?>
