<?php
if (isset($_FILES['image'])) {
    $uploadDirectory = '../images/photos/';
    $targetFile = $uploadDirectory . basename($_FILES['image']['name']);    

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo json_encode(["status" => "success", "path" => $targetFile]);
    } else {
        echo json_encode(["status" => "error", "message" => "Upload failed"]);
    }
}
?>
