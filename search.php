<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="searchphp.css">
</head>
<body>
    <div class="container">
        <?php
        // Database connection credentials
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "election";

        // Create a new database connection
        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the search term from the user (you can retrieve it from a form input)
        $searchTerm = $_GET['search'];

        // Construct the SQL query
        $query = "SELECT * FROM voters WHERE idnum LIKE '%$searchTerm%'";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check if any results were found
        if (mysqli_num_rows($result) > 0) {
            // Fetch the first row from the result set
            $row = mysqli_fetch_assoc($result);

            // Check if the voter has already voted
            if ($row['voted'] == 1) {
                echo "<div class='table-container orange'>";
                echo "<p>You have already voted!</p>";
                echo "</div>";
                echo '<button onclick="goBack()" class="back-button">Back</button>';
            } else {
                // Display the table
                echo "<div class='table-container green'>";
                echo "<table>";
                echo "<tr><th>ID Number</th><th>Name</th><th>Birthdate</th></tr>";

                // Display the voter's information
                echo "<tr>";
                echo "<td>" . $row['idnum'] . "</td>";
                echo "<td>" . $row['uname'] . "</td>";
                echo "<td>" . $row['birthday'] . "</td>";
                echo "</tr>";

                // Close the table
                echo "</table>";
                echo "</div>";

                // Update the voter's status to voted
                $updateQuery = "UPDATE voters SET voted = 1 WHERE idnum = '{$row['idnum']}'";
                mysqli_query($conn, $updateQuery);

                // Display the "Next" button
                echo '<a href="startvote1.php">Start Voting</a>';
            }
        } else {
            // Display the "Back" button
            echo "<div class='table-container red'>";
            echo "<p>No results found!!!</p>";
            echo "<p>Please enter a valid ID number</p>";
            echo "</div>";
            echo '<button onclick="goBack()" class="back-button">Back</button>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
