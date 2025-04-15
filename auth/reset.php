<?php
include("../config/database.php");

if (!empty($_GET['key'])) {
    $key = $_GET['key'];
} else {
    $key = '';
}

if ($key != '') {
    $sql = mysqli_query($conn, "SELECT * FROM signup WHERE activation_key='$key'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        // In a real-world scenario, this should be a form where users input new password
        // Assume a new password is directly set for demonstration purpose
        $newPassword = password_hash("newpassword123", PASSWORD_DEFAULT); // Hashing the new password
        
        $update_sql = "UPDATE signup SET password='$newPassword' WHERE activation_key='$key'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo json_encode(['success' => true, 'message' => 'Password has been updated successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid activation key.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
