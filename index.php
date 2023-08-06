<?php
include_once 'conn.php';
session_start();
$_SESSION['previousClub'] = "DRV";

if (isset($_POST['submitBtn']) && $_POST['randcheck'] == $_SESSION['rand']) {
    $club = $_POST['club'];
    $_SESSION['previousClub'] = $club;
    $distance = $_POST['distance'];

    $sql = "INSERT INTO shots (clubid, distance, datehit)
    VALUES ('$club', '$distance', '2023-07-07');";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Golf Website</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="mainContainer">
        <header>
            <h1>Golf Stats</h1>
        </header>

        <div class="default">
            <h2>Statistics</h2>
        </div>

        <form action="" method="POST" name="statsForm">
            <?php
            $rand = rand();
            $_SESSION['rand'] = $rand;
            ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />

            <div class="default">
                <label for="club">Select Your Club: </label>
                <select name="club" class = "select">
                    <option value="DRV" <?php if ($_SESSION['previousClub'] == 'DRV')
                        echo 'selected'; ?>>Driver</option>
                    <option value="WD3" <?php if ($_SESSION['previousClub'] == 'WD3')
                        echo 'selected'; ?>>3 Wood</option>
                    <option value="WD5" <?php if ($_SESSION['previousClub'] == 'WD5')
                        echo 'selected'; ?>>5 Wood</option>
                    <option value="IR3" <?php if ($_SESSION['previousClub'] == 'IR3')
                        echo 'selected'; ?>>3 Iron</option>
                    <option value="IR4" <?php if ($_SESSION['previousClub'] == 'IR4')
                        echo 'selected'; ?>>4 Iron</option>
                    <option value="IR5" <?php if ($_SESSION['previousClub'] == 'IR5')
                        echo 'selected'; ?>>5 Iron</option>
                    <option value="IR6" <?php if ($_SESSION['previousClub'] == 'IR6')
                        echo 'selected'; ?>>6 Iron</option>
                    <option value="IR7" <?php if ($_SESSION['previousClub'] == 'IR7')
                        echo 'selected'; ?>>7 Iron</option>
                    <option value="IR8" <?php if ($_SESSION['previousClub'] == 'IR8')
                        echo 'selected'; ?>>8 Iron</option>
                    <option value="IR9" <?php if ($_SESSION['previousClub'] == 'IR9')
                        echo 'selected'; ?>>9 Iron</option>
                    <option value="PW" <?php if ($_SESSION['previousClub'] == 'PW')
                        echo 'selected'; ?>>Pitching Wedge
                    </option>
                    <option value="SW" <?php if ($_SESSION['previousClub'] == 'SW')
                        echo 'selected'; ?>>Sand Wedge
                    </option>
                    <option value="PT" <?php if ($_SESSION['previousClub'] == 'PT')
                        echo 'selected'; ?>>Putter</option>
                </select>
            </div>
            <br>
            <div class="default">
                <label for="distance">Input Distince Hit: </label>
                <input type="number" class = "select" min="0" max="999" name="distance" required>
            </div>
            <div class="default">
                <input type="submit" class="button" name="submitBtn" value="Add Shot">
            </div>
        </form>

        <div class="default">
            <table>
                <tr>
                    <th>Club</th>
                    <th>Average Distance(ft)</th>
                </tr>
                <?php
                $sql = "SELECT * FROM club_average_distance_view WHERE averagedist > 0;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["clubname"] . "</td><td>" . $row["averagedist"] . "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <footer>

    </footer>
    <script src="script.js"></script>
</body>

</html>

<?php
$conn->close();
?>