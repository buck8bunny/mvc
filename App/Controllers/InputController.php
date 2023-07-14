<?php
namespace App\Controllers;
use \DateTime;

class InputController
{
    public static function form_submission()
    {
        if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthday"]) && isset($_POST["report"])
            && isset($_POST["country"]) && isset($_POST["phone"]) && isset($_POST["email"])) {
            $config = require ('config.php');
            $conn = new \mysqli("localhost", "root", "root", "test");
            if($conn->connect_error){
                die("Ошибка: " . $conn->connect_error);
            }
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INTEGER AUTO_INCREMENT PRIMARY KEY, 
                fullname VARCHAR(60), 
                date_of_birth DATE, 
                report VARCHAR(30), 
                country VARCHAR(20),
                phone VARCHAR(20),
                email VARCHAR(30),
                file_name VARCHAR(100),
                uploaded_on DATETIME,
                сompany VARCHAR(50),
                position VARCHAR(50),
                about VARCHAR(170)
                );";

            $conn->query($sql);

            $fullname = $conn->real_escape_string($_POST["firstName"]) . " " . $conn->real_escape_string($_POST["lastName"]);

            $date_of_birth = $conn->real_escape_string($_POST["birthday"]);
            $date_of_birth = str_replace(" ", '', $date_of_birth);
            $dateObj = DateTime::createFromFormat('d-m-Y', $date_of_birth);
            $dateFormatted = $dateObj->format('Y-m-d');

            $report = $conn->real_escape_string($_POST["report"]);

            $country = $conn->real_escape_string($_POST["country"]);

            $phone = $conn->real_escape_string($_POST["phone"]);
            $phone = "+" . preg_replace('/[^0-9]/', '', $phone);
            $email = $conn->real_escape_string($_POST["email"]);
            $сompany = $conn->real_escape_string($_POST["сompany"]);
            $position = $conn->real_escape_string($_POST["position"]);
            $about = $conn->real_escape_string($_POST["about"]);
            $statusMsg = '';

            // File upload path
            $targetDir = "uploads/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


            // Check if a file is uploaded
            if(!empty($_FILES["file"]["name"])){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        // File uploaded successfully
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
                }
            }else{
                // No file uploaded, use default photo
                $fileName = "avatar2.png";
                $statusMsg = "No file uploaded. Using default photo.";
            }

            // Insert data into database
            $sql = "INSERT INTO users (fullname, report, date_of_birth, country, phone, email, сompany, position, about, file_name, uploaded_on) VALUES 
                ('$fullname', '$report', '$dateFormatted', '$country', '$phone', '$email', '$сompany', '$position', '$about', '$fileName', NOW())";

            if($conn->query($sql)){
                echo "Data successfully added. ".$statusMsg;
            }else{
                echo "Error: " . $conn->error;
            }


            $conn->close();
        }
    }
}

