<?php
session_start();

if (isset($_POST['submit'])) {

    $conn = mysqli_connect('remotemysql.com', '2v6B9Eu4Wc', '926XBu3pHs', '2v6B9Eu4Wc') or die("Not able to connect");

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "INSERT INTO login (user,pass) values ('$user','$pass')";

    $query_run = mysqli_query($conn, $query);


    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <p>Username: <input type="text" name="user" id="user" require></p>
        <p>Password: <input type="password" name="pass" id="pass" require></p>
        <input type="submit" value="insert" name="submit">
    </form>
</body>

<?php
$conn = mysqli_connect('localhost:3306', 'root', '', 'student') or die("Not able to connect");
$query = "SELECT * from login";
$query_run = mysqli_query($conn, $query);
echo "Users on the server are :</br>";
while ($result = mysqli_fetch_assoc($query_run)) {
    echo $result['user'] . "<br>";
}
?>

</html>