<?php

/**
* Function to query information based on
* a parameter: in this case, location.
*/

if (isset($_POST['submit'])) {
    try {
        require "../common.php";
        require_once '../src/DBconnect.php';
        
        $sql = "SELECT *
            FROM users
            WHERE location = :location";
        $location = $_POST['location'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";

if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
?>

<h2>Results</h2>

<div>
    <div class="row">
        <?php foreach($result as $row) { ?>
        <div class="col-lg-4 user-list-item">
            <h2><?php echo escape($row["firstname"]) . " " . escape($row["lastname"]); ?></h2>
            <blockquote>
                <span class="label label-info">
                    <?php echo escape($row["email"]); ?>
                </span>
                <?php echo "Age: " . escape($row["age"]); ?>
            </blockquote>
            <p>
                <?php echo "Location: " . escape($row["location"]); ?>
            </p>
            <p>
                <?php echo "Date: " . escape($row["date"]); ?>
            </p>
        </div>
        <?php } ?>
    </div>
</div>

<?php } else { ?> 
    <h2>No results found for <?php echo escape($_POST['location']); ?>. </h2>
<?php }
} ?>

<h2>Find user based on location</h2>
<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location">
    <input type="submit" name="submit" value="View Results">
</form>
<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>