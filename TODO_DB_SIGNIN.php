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
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            background-attachment: fixed;
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

        input[name="login"] {
            background: #90e0ef;
        }

        input[name="login"]:hover {
            background: #48cae4;
        }
    </style>
</head>

<body>
    <form action="TODO_DB_SIGNIN.php" method="post">
        <h1>TODO LIST SIGN UP</h1>
        <label>Name:</label>
        <input type="text" name="name">
        <label>Username:</label>
        <input type="text" name="username">
        <label>Password:</label>
        <input type="password" name="password">
        <input type="submit" name="submit" value="Sign In">
        <input type="submit" name="login" value="Go to Login">
    </form>
</body>

</html>

<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    if (empty($username) || empty($password)||empty($name)) {
        echo "<div class='error-message'>Please enter all the credentials.</div>";
    } else {
        $sql = "INSERT INTO users(name, user, password) VALUES('$name','$username', '$password')";
        try {
            mysqli_query($conn, $sql);
            echo "Registered!";
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            header("Location: TODO.php");
            exit();
        } catch (mysqli_sql_exception) {
            echo "<div class='error-message'>Username Already taken.</div>";
        }
    }
}

if (isset($_POST['login'])) {
    session_destroy();
    header("Location: TODO_DB_LOGIN.php");
}

mysqli_close($conn);

?>