<!-- File: upload.php -->
<?php
if (isset($_POST['submit'])) {
    $targetDir = "upload/";
    $fileName = basename($_FILES["myfile"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only image file types
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetFilePath)) {
            echo "Upload successful.";
            echo "<script>window.location.href='profile.html';</script>";
        } else {
            echo "Upload failed.";
        }
    } else {
        echo "Only image files are allowed.";
    }
}
?>
