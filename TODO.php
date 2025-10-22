<?php
session_start();
if ($_SESSION['logged_in'] == true) {
    include("database.php");
    echo "<nav class='navbar'>";
    echo "<form action='TODO.php' method='post'>
        <input type='submit' name='logout' value='Log Out'>
    </form>";
    echo "<h1>Hello, {$_SESSION['name']}</h1>";
    echo "<div class='search-container'>
    <form action='TODO.php' method='post'>
    
            <input type= 'text' name='search' placeholder='Search for a task or Priority'>
            <input type= 'submit' name='entersearch' value='Search'>

        </form>
        </div></nav>";
    $username = $_SESSION['username'];
    if (!isset($_SESSION['tasks']) && !isset($_SESSION['priority'])) {
        $_SESSION['tasks'] = [];
        $_SESSION['priority'] = [];
    }
    if (isset($_POST['entersearch'])) {
        if (!empty($_POST['search'])) {
            if ($_POST['search'][0] == '"') {
                $search_task = str_replace('"', '', $_POST['search']);
                $sql = "SELECT task, priority, due FROM tasks WHERE task LIKE '%{$search_task}%' AND user = '{$username}'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                <div class='task-box'>
                <h2>{$row['task']}</h2>
                <p>Priority: {$row['priority']}</p>
                <p>Due Date: {$row['due']}</p>
                </div>
            
            ";
                }
            }
            if (strtolower($_POST['search']) == 'low' || strtolower($_POST['search']) == 'medium' || strtolower($_POST['search']) == 'high') {
                $sql = "SELECT task, priority, due FROM tasks WHERE priority LIKE '{$_POST['search']}' AND user = '{$username}'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                <div class='task-box'>
                <h2>{$row['task']}</h2>
                <p>Priority: {$row['priority']}</p>
                <p>Due Date: {$row['due']}</p>
                </div>
            
            ";
                }
            }
        } else {
            echo "Please enter valid search term";
        }
    }
    if (isset($_POST['submit'])) {
        if (!empty($_POST['task']) && !empty($_POST['priority']) && !empty($_POST['date'])) {
            #array_push($_SESSION['tasks'], $_POST['task']);
            #array_push($_SESSION['priority'], $_POST['priority']);
            $task = $_POST['task'];
            $priority = $_POST['priority'];
            $date = $_POST['date'];
            #var_dump($username, $task);
            $sql = "INSERT INTO tasks(user, task, priority, due) VALUES ('{$username}', '{$task}', '{$priority}', '{$date}')";
            mysqli_query($conn, $sql);
        } else {
            echo '<div class="tasks-container">';
            echo "
        <div class='task-box error-task'>
            <h2>Please enter a Task and its priority!</h2>
        </div>
    ";
            echo "</div>";
        }
    }
    $sql = "SELECT task, priority, due FROM tasks WHERE user = '{$username}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="tasks-container">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <div class='task-box'>
                <h2>{$row['task']}</h2>
                <p>Priority: {$row['priority']}</p>
                <p>Due Date: {$row['due']}</p>
                </div>
            
            ";
        }
        echo "</div>";
    } else {
        foreach ($_SESSION['tasks'] as $key => $value) {

            echo "
            <div class='task-box'>
                <h2>{$value}</h2>
                <p>Priority: {$_SESSION['priority'][$key]}</p>
            </div>
        ";
        }
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: TODO_DB_LOGIN.php");
    }
} else {
    header("Location: TODO_DB_LOGIN.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Patrick+Hand&family=Comic+Neue:wght@700&display=swap');

        body {
            font-family: 'Patrick Hand', 'Comic Neue', cursive;
            background-image: url("background.svg");
            background-size: cover;
            background-attachment: fixed;
            padding: 20px;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #f57309ff;
            font-size: 2.5rem;
            margin: 20px 0 30px;
            text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
            background: #fffbea;
            padding: 15px 30px;
            border: 3px solid #000;
            border-radius: 15px;
            box-shadow: 5px 5px 0px #000;
            display: inline-block;
            max-width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        body>h1 {
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .task-box.error-task {
            background: #ffccd5;
            border: 3px solid #ff006e;
            text-align: center;
            grid-column: 1 / -1;
        }

        .task-box.error-task h2 {
            color: #d00000;
            font-size: 1.3rem;
        }

        .form-container {
            background: #fffbea;
            padding: 20px;
            margin: 0 auto 30px;
            border: 3px solid #000;
            border-radius: 15px;
            box-shadow: 5px 5px 0px #000;
            max-width: 500px;
        }

        .navbar {
            display: flex;
            align-items: center;
            flex-direction: row;
            padding: 10px 20px;
            max-width: auto;
            margin: 0 auto 30px;
            justify-content: space-between;
            position:relative;
        }

        .navbar h1 {
            margin: 0;
            font-size: 35px;
            font-weight: bold;
            position:absolute;
            left: 44%;
        }

        .navbar form input[type="submit"] {
            padding: 8px 15px;
            border: 2px solid #000;
            background-color: #ffb700;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .navbar form {
            padding: 10px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 2px solid #000;
            border-radius: 8px;
            width: 175px;
        }

        .search-container form {
            padding: 20px;
            margin: 0 auto 30px;
            border: 3px solid #000;
            border-radius: 15px;
            box-shadow: 5px 5px 0px #000;
            max-width: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            /*flex-direction: row;*/
            gap: 10px;
        }

        .search-container input[type="submit"] {
            line-height: 1;
            font-size: 16px;
            display: flex;
            flex: 1;
        }

        .tasks-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .task-box {
            background: #fffbea;
            padding: 20px;
            border: 3px solid #000;
            border-radius: 15px;
            box-shadow: 5px 5px 0px #000;
            position: relative;
            min-height: 150px;
            transition: transform 0.2s ease;
        }

        .task-box:hover {
            transform: translateY(-5px) rotate(1deg);
        }

        .task-box h2 {
            margin: 0 0 10px 0;
            color: #f57309ff;
            font-size: 1.5rem;
        }

        .task-box .priority {
            margin-top: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border: 3px solid #000;
            border-radius: 6px;
            background: #fffef2;
            font-family: inherit;
            box-sizing: border-box;
        }

        input[type="radio"] {
            accent-color: #ff006e;
            transform: scale(1.2);
            margin-right: 5px;
        }

        input[type="submit"] {
            appearance: none;
            -webkit-appearance: none;
            background: #ffb703;
            border: 3px solid #000;
            color: #000;
            font-weight: bold;
            font-family: inherit;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 8px;
            box-shadow: 3px 3px 0px #000;
            transition: transform 0.1s ease-in-out, background 0.2s;
        }

        input[type="submit"]:hover {
            transform: scale(1.05) rotate(-2deg);
            background: #ffd166;
        }
    </style>
</head>

<body>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <div class='form-container'>
        <form method="post" action="TODO.php">
            <label>Enter a Task:</label>
            <input type="text" name="task" placeholder="Task">
            <br>
            <label>Set Task Priority</label>
            <div class="priority-options">
                <label><input type="radio" name="priority" value="Low"> Low</label>
                <label><input type="radio" name="priority" value="Medium"> Medium</label>
                <label><input type="radio" name="priority" value="High"> High</label>
            </div>
            <label>Due Date:</label>
            <input type="date" name="date">

            <input type="submit" name="submit" value="Assign">
        </form>
    </div>

</body>

</html>