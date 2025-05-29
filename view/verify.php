<?php
$certificateId = isset($_GET['id']) ? $_GET['id'] : '';
$name = "Test User"; // In a real app, fetch from database using $certificateId
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #e0f7fa;
            color: #333;
        }
        h1 {
            color: #ff4081;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Certificate Verification</h1>
    <?php if ($certificateId): ?>
        <p>Certificate ID: <?php echo htmlspecialchars($certificateId); ?></p>
        <p>Issued to: <?php echo htmlspecialchars($name); ?></p>
        <p>Status: Valid</p>
    <?php else: ?>
        <p>No certificate ID provided!</p>
    <?php endif; ?>
</body>
</html>