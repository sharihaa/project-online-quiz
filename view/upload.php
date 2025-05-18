<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {
    $targetDir = 'upload/';
    $fileName = basename($_FILES['myfile']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only image file types
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Check if the file is an actual image
        $check = getimagesize($_FILES['myfile']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $targetFilePath)) {
                // Redirect to profile.html after successful upload
                header('Location: profile.html');
                exit();
            } else {
                echo 'Upload failed.';
            }
        } else {
            echo 'File is not a valid image.';
        }
    } else {
        echo 'Only JPG, JPEG, PNG, and GIF files are allowed.';
    }
}
?>
