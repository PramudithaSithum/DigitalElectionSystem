<!DOCTYPE html>
<html>
<head>
    <title>Election Day</title>
    <link rel="stylesheet" type="text/css" href="electionday.css">
</head>
<body>
    <h3>CANDIDATE LIST</h3>
    <h2>SELECT YOUR PREFERRED CANDIDATE AND PRESS THE VOTE BUTTON TO VOTE</h2>
    <div class="container">
        <table class="candidates-table">
            <!-- Table content -->
            <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Party</th>
            <th>Vote</th>
        </tr>
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

        // Retrieve candidate data from the database
        $sql = "SELECT id_number, full_name, cparty, cpartyimage FROM images";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_number = $row['id_number'];
                $full_name = $row['full_name'];
                $cparty = $row['cparty'];
                $cpartyimage = $row['cpartyimage'];

                $sql2 = "SELECT partyimage FROM party WHERE partyid=$cparty";
                $result2 = $conn->query($sql2);
                
                while ($row2 = $result2->fetch_assoc()){
                    $image = $row2['partyimage'];
                }
                
                echo "<tr class='candidate'>";
                echo "<td class='candidate-image'><img src='uploads/$id_number.jpg' alt='Candidate Image'></td>";
                echo "<td>$full_name</td>";
                echo "<td>$cparty<img src='party_images/$image.jpg' alt='Party Image' class='party-image'></td>";
                echo "<td class='vote-button'>";
                echo "<form action='summary.php' method='post'>";
                echo "<input type='hidden' name='id_number' value='$id_number'>";
                echo "<input type='hidden' name='image_url' value='uploads/$image.jpg'>";
                echo "<input type='submit' name='vote_button' value='Vote'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                
                
            }
            
        } else {
            echo "<tr><td colspan='4'>No candidates found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
        </table>
    </div>
</body>
</html>
