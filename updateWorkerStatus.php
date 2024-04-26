<?php


class Database {
    private static $conn; 

    public static function connect() {
        self::$conn = new mysqli("localhost","root","Ab2#*De#","workdb","3306");

        // Check the connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }
    }

    public static function search($query) {
        // Perform the database search
        $result = self::$conn->query($query);

        if (!$result) {
            die("Error executing query: " . self::$conn->error);
        }

        return $result;
    }
}

// Call the connect method to establish the database connection
Database::connect();

if (isset($_POST['updateStatus'])) {
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Update the status in the database
    $updateQuery = "UPDATE `worker` SET `status_s_id` = '$status' WHERE `email` = '$email'";
    // Execute the query
    $result = Database::search($updateQuery);

    // Return a response if needed
    echo json_encode(['status' => 'success']);
    exit;
}
?>
