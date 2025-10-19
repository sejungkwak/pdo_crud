require "config.php";

$connection = new PDO("mysql:host=$host", $username, $password, $options);

$sql = file_get_contents("data/init.sql");
$connection->exec($sql);
Echo “DB setup”;