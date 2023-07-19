<?php
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

// Function to insert user data into the database
function insertUserData($id_number, $user_name, $full_name, $cbday, $cage, $cgender, $cparty, $cpartyimage)
{
    global $conn;

    $sql = "INSERT INTO images (id_number, user_name, full_name, birthday, age, gender, party, partyimage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $id_number, $user_name, $full_name, $cbday, $cage, $cgender, $cparty, $cpartyimage);

    if ($stmt->execute() === false) {
        die("Error inserting user data: " . $stmt->error);
    }

    $stmt->close();
}

// Upload and store the image
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // ...existing code...
    
    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); // Get the file extension
    $image_name = $id_number . '.' . $extension; // Use the user-provided image ID as the new file name

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_name);
    
    // ...existing code...
    
    if (!empty($cparty)) {
        // Define the folder path for party images
        $partyImageFolder = "party_images/";
        
        // Create the party image file name based on the selected party and candidate ID
        $partyImageName = "p_" . $id_number . ".jpg";
        
       

        insertUserData($id_number, $user_name, $full_name, $cbday, $cage, $cgender, $cparty, $cpartyimage);
        echo "Image uploaded and user data stored successfully.";

        header("Location: success.php"); // Redirect to a success page
        exit();
    } else {
        echo "Error uploading image.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Candidate</title>
    <link rel="stylesheet" type="text/css" href="imagecss.css">
</head>
<body>
    
    <form method="post" action="success.php" enctype="multipart/form-data">
    <h3>Insert Candidate details </h3>
        <label for="id_number">ID Number:</label>
        <input type="text" id="id_number" name="id_number" required><br><br>

        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name"><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name"><br><br>

        <label for="cbday">Birthday:</label>
        <input type="date" id="cbday" name="cbday"><br><br>

        <label for="cgender">Gender:</label>
        <select id="cgender" name="cgender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>

        <label for="cparty">Party:</label>
        <select id="cparty" name="cparty">
            <option value="">Select a Party</option>
            <option value=1>Party A</option>
            <option value=2>Party B</option>
            <option value=3>Party C</option>
            <option value=4>Party D</option>
        </select><br><br>
       
        <input type="submit" value="Submit">
    </form>
</body>
</html>
