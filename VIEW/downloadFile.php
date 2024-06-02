<?php
// Check if the file parameter is set
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];

    // Specify the path to the files directory
    $filePath = $fileName;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        // File not found
        echo 'File not found.';
    }
} else {
    // File parameter not provided
    echo 'File parameter missing.';
}
