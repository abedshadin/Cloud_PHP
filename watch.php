<?php
session_start(); // ← MUST be at the top

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to watch videos.");
}

$directory = "uploads/" . $_SESSION["username"];

// Get the file from query parameter
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$file = basename($_GET['file']); // sanitize
$filePath = $directory . '/' . $file;

if (!file_exists($filePath)) {
    die("File not found.");
}

// Determine MIME type
$ext = pathinfo($filePath, PATHINFO_EXTENSION);
$mime = ($ext == 'mp4') ? 'video/mp4' : 'video/webm';
?>



<?php
// Get the file from query parameter
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$file = $_GET['file'];

// Sanitize path (important for security!)
$file = basename($file); // prevent directory traversal

$directory = "uploads/" . $_SESSION["username"];
$filePath = $directory . '/' . $file;

if (!file_exists($filePath)) {
    die("File not found.");
}

// Determine MIME type for browser playback
$ext = pathinfo($filePath, PATHINFO_EXTENSION);
$mime = ($ext == 'mp4') ? 'video/mp4' : 'video/webm';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Watch <?= htmlspecialchars($file) ?></title>
    <link href="https://vjs.zencdn.net/7.21.1/video-js.css" rel="stylesheet" />
</head>
<body>
    <h3><?= htmlspecialchars($file) ?></h3>
    <video id="my-video" class="video-js" controls preload="auto" width="800" height="450">
        <source src="<?= $filePath ?>" type="<?= $mime ?>">
    </video>

    <script src="https://vjs.zencdn.net/7.21.1/video.min.js"></script>
</body>
</html>
