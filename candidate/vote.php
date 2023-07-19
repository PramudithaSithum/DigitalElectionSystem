<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_button'])) {
    $selectedCandidateId = $_POST['id_number'];

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "election";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the vote count for the selected candidate
    $sql = "UPDATE images SET vote_count = vote_count + 1 WHERE id_number = '$selectedCandidateId'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Vote counted successfully!";
        
        echo '<div class="next-voter"><a href="../search.html">Next Voter</a></div>';

    } else {
        echo "Error counting vote: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
