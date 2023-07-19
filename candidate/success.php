<!DOCTYPE html>
<html>
<head>
    <title>Candidate Details Summary</title>
    <link rel="stylesheet" type="text/css" href="success.css">
</head>
<body>
    <h3>Candidate Details Summary</h3>
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

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $id_number = isset($_POST["id_number"]) ? $_POST["id_number"] : "";
        $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : "";
        $full_name = isset($_POST["full_name"]) ? $_POST["full_name"] : "";
        $cbday = isset($_POST["cbday"]) ? $_POST["cbday"] : "";
        $cage = isset($_POST["cage"]) ? $_POST["cage"] : "";
        $cgender = isset($_POST["cgender"]) ? $_POST["cgender"] : "";
        $cparty = isset($_POST["cparty"]) ? $_POST["cparty"] : "";
        $image = $_FILES["image"];
        $cpartyimage = isset($_FILES["cpartyimage"]) ? $_FILES["cpartyimage"] : null;

        // File upload directory
        $target_dir = "uploads/";

        // Upload user image
        if ($image["error"] == UPLOAD_ERR_OK) {
            $image_name = $id_number . "." . pathinfo($image["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . basename($image_name);
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                echo "User image uploaded successfully.<br>";
            } else {
                echo "Error uploading user image.<br>";
            }
        }

        // Upload party image
        $cpartyimage_name = null;
        if ($cpartyimage && $cpartyimage["error"] == UPLOAD_ERR_OK) {
            $cpartyimage_name = $cpartyimage["name"];
            $target_file = $target_dir . basename($cpartyimage_name);
            if (move_uploaded_file($cpartyimage["tmp_name"], $target_file)) {
                echo "Party image uploaded successfully.<br>";
            } else {
                echo "Error uploading party image.<br>";
            }
        }

        // Insert user data into the database
        $sql = "INSERT INTO images (id_number, user_name, full_name, cbday, cage, cgender, cparty) VALUES ( '$id_number', '$user_name', '$full_name', $cbday, '$cage','$cgender', '$cparty')";
        $result1 = $conn->query($sql);

        
        $sql2 = "SELECT partyimage FROM party WHERE partyid=$cparty";
        $result2 = $conn->query($sql2);
        
        while ($row = $result2->fetch_assoc()){
            $partyimage=$row['partyimage'];
        }
   }

    // Display user data
    echo "<h1>Success</h1>";
    echo "<h2>User Data</h2>";
    echo "<div class='container'>";
    echo "<div class='image-container'>";
    echo "<img src='uploads/" . $image_name . "' height='150px' width='150px' alt='User Image'>";
    echo "</div>";
    echo "<div class='details-container'>";
    echo "<p>";
    echo "<strong>ID Number:</strong> " . $id_number . "<br>";
    echo "<strong>User Name:</strong> " . $user_name . "<br>";
    echo "<strong>Full Name:</strong> " . $full_name . "<br>";
    echo "<strong>Birthday:</strong> " . $cbday . "<br>";
    // echo "<strong>Age:</strong> " . $cage . "<br>";
    echo "<strong>Gender:</strong> " . $cgender . "<br>";
    echo "<strong>Party:</strong> " . $cparty . "<br>";
    echo "</p>";
    
        echo "<strong>Party Image:</strong> <img src='party_images/".$partyimage.".jpg' height='150px' width='150px' alt='Party Image'><br>";
    
    echo "</div>";
    echo "</div>";

    echo "<a href='edit.php?id_number=$id_number'>Edit</a>";
    echo "<a href='image.php'>Confirm</a>";
    ?>
</body>
</html>
