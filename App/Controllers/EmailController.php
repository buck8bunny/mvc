<?php

namespace App\Controllers;


class EmailController
{
    public static function checkEmail()
    {
        $config = require 'config.php';
        $host = $config['host'];
        $port = $config['port'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        // Get the email from the AJAX request
        $email = $_POST["email"];
        $connection = new \mysqli($host,$username, $password, $dbname, $port);

        // Prepare and execute the query
        $query = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();

        // Check if a row with the email exists
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            // Email already exists in the database
            echo "exists";
        } else {
            // Email doesn't exist
            echo "not_exists";
        }
        // Close the database connection
        $connection->close();

    }
}
?>
