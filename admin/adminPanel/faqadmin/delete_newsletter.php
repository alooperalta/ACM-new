<?php
// Process delete operation after confirmation
if(isset($_GET["id"])) {

    // Database connection
    require('../../blogAdmin/database.php');
    $database = new Database();
    $conn = $database->connect();

    // 'id' obtained from the newsletter admin panel
    $id = $_GET['id'];

    // Deleting newsletter_email row
    $sql = "DELETE FROM newsletter_email WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Successfully Deleted";
            header("location: .../../../index.php?table=Newsletter"); 
        } else {
            echo "ERROR: Execution failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ERROR: Prepare statement failed: " . $conn->error;
    }

    $conn->close();
} else {
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php"); 
        exit();
    }
}
?>
