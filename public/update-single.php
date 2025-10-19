<?php require "templates/header.php"; ?>

<h2>Edit a user</h2>

<?php
require "../common.php";

if (isset($_GET['id'])) {
    try {
        require_once "../src/DBconnect.php";

        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label class="form-block" for="<?php echo $key; ?>"> <?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input class="form-block" type="submit" name="submit" value="Submit">
</form>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>