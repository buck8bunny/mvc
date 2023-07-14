<?php

namespace App\Controllers;

class ImageController
{
    public static function checkImage()
    {
        if (is_array($_FILES)) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $sourcePath = $_FILES['file']['tmp_name'];
                $targetPath = "uploads/" . $_FILES['file']['name'];
                $fileType = pathinfo($targetPath,PATHINFO_EXTENSION);

                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        echo 'valid';
                    } else {
                        // File format is not valid
                        echo 'invalid';
                    }
                }
            }
        }
    }
}

