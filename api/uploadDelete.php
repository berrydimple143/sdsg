<?php
        $data = json_decode(file_get_contents('php://input'), true);
        $img = $data['image'];
        $filename = $data['filename'];
        $filePath = '../images/photos/';
        $file = $filePath . $filename;        

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $decodedData = base64_decode($img);
        
        if (file_put_contents($file, $decodedData)) {
            echo "Image saved successfully!";
        } else {
            echo "Failed to save image.";
        }

        // if (file_exists($file)) {
        //     if (unlink($file)) {
        //         echo "File deleted successfully.";
        //     } else {
        //         echo "Error: The file could not be deleted.";
        //     }
        // } else {
        //     echo "Error: The file does not exist.";
        // }
?>