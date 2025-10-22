<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLI TODO</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Patrick+Hand&family=Comic+Neue:wght@700&display=swap');

        body {
            font-family: 'Patrick Hand', 'Comic Neue', cursive;
            background: #fdf6e3;
            background-image: url("background.svg");
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            flex-direction: column;
            background-attachment: fixed;
        }

        form {
            background: #fffbea;
            padding: 30px;
            border: 3px solid #000;
            border-radius: 15px;
            box-shadow: 5px 5px 0px #000;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            margin: 0 0 20px 0;
            color: #866C53;
            font-size: 2rem;
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 3px solid #000;
            border-radius: 6px;
            background: #fffef2;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input[type="submit"] {
            appearance: none;
            -webkit-appearance: none;
            background: #ffb703;
            border: 3px solid #000;
            color: #000;
            font-weight: bold;
            font-family: inherit;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 3px 3px 0px #000;
            transition: transform 0.1s ease-in-out, background 0.2s;
            width: 100%;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        input[type="submit"]:hover {
            transform: scale(1.05) rotate(-1deg);
            background: #ffd166;
        }

        input[name="signup"] {
            background: #90e0ef;
        }

        input[name="signup"]:hover {
            background: #48cae4;
        }

        .error-message {
            background: #ffccd5;
            border: 3px solid #ff006e;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            color: #d00000;
            font-weight: bold;
            text-align: center;
            box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form action="TODO_DB_LOGIN.php" method="post">
        <h1>TODO LIST LOGIN</h1>
        <label>Username:</label>
        <input type="text" name="username">
        <label>Password:</label>
        <input type="password" name="password">
        <input type="submit" name="submit" value="Login">
        <input type="submit" name="signup" value="Go to Sign Up">
    </form>
</body>

</html>

<?php
session_start();
if (isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in']=false;
}
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        echo "<div class='error-message'>Please enter all the credentials.</div>";
    } else {

        $sql = "SELECT password, name FROM users WHERE user = '$username'";
        $result =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $pass = $row['password'];
        $name = $row['name'];
        #var_dump($pass);
        if ($password == $pass) {
            echo "Logged IN";
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['logged_in'] = true;
            header("Location: TODO.php");
            exit();
        } else {
            echo "<div class='error-message'>Invalid Login Info.</div>";
        }
    }
}


if (isset($_POST['signup'])) {
    session_destroy();
    header("Location: TODO_DB_SIGNIN.php");
}

mysqli_close($conn);

?>