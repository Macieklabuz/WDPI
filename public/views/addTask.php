<?php
// Plik add_task.php

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź, czy pole nazwy zadania jest ustawione
    if (isset($_POST["taskName"])) {
        // Pobierz nazwę zadania z formularza
        $taskName = $_POST["taskName"];

        // Dodaj opcjonalne pola opisu zadania i daty wykonania
        $taskDescription = isset($_POST["taskDescription"]) ? $_POST["taskDescription"] : "";
        $taskDueDate = isset($_POST["taskDueDate"]) ? $_POST["taskDueDate"] : "";

        // Połącz z bazą danych (zmień dane dostępu według swoich ustawień)
        $host = "HOST";
        $username = "USERNAME";
        $password = "PASSWORD";
        $database = "DATABASE";

        $conn = new mysqli($host, $username, $password, $database);

        // Sprawdź połączenie z bazą danych
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Przygotuj zapytanie SQL do dodania zadania
        $sql = "INSERT INTO tasks (task_name, task_description, task_due_date) VALUES ('$taskName', '$taskDescription', '$taskDueDate')";

        // Wykonaj zapytanie SQL
        if ($conn->query($sql) === TRUE) {
            // Po dodaniu zadania przekieruj użytkownika z powrotem do strony tasks
            header("Location: tasks");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Zamknij połączenie z bazą danych
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>`ADD TASK`</title>
    <style>
        /* style.css */

        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #F5FBFF;
        }

        .top-bar {
            caret-color: transparent;
            height: 104px; /* Zwiększone o 20px */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #DBF0FF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
            backdrop-filter: blur(2px);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .bottom-bar {
            caret-color: transparent;
            height: 84px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #24A7FF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .menu-btn:hover {
            background: #007BFF;
        }


        /* Dodatkowe style dla formularza */
        h2 {
            margin-bottom: 16px; /* Zwiększone o 20px */
            font-size: 34px; /* Zwiększone o 20px */
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 12px; /* Zwiększone o 20px */
            font-size: 14px; /* Zwiększone o 20px */
        }

        input,
        textarea,
        input[type="date"] {
            padding: 16px; /* Zwiększone o 20px */
            margin-bottom: 16px; /* Zwiększone o 20px */
            font-size: 14px; /* Zwiększone o 20px */
        }

        button[type="submit"] {
            padding: 16px; /* Zwiększone o 20px */
            background: #24A7FF;
            color: #fff;
            border: none;
            border-radius: 14px; /* Zwiększone o 20px */
            cursor: pointer;
            font-size: 24px; /* Zwiększone o 20px */
        }

        button[type="submit"]:hover {
            background: #007BFF;
        }

    </style>
</head>
<body>
<div class="top-bar"></div>
<div class="bottom-bar"></div>
<!-- Dodatkowe style dla formularza -->
<h2>Dodaj nowe zadanie</h2>
<form action="addTask.php" method="post" onsubmit="redirectToTasks()"
    <label for="taskName">Nazwa zadania:</label>
    <input type="text" name="taskName" id="taskName" required>

    <label for="taskDueDate">Data wykonania:</label>
    <input type="date" name="taskDueDate" id="taskDueDate">

    <label for="colaborationWith">Przy współpracy z:</label>
    <input type="text" name="colaborationWith">

    <label for="taskDescription">Opis zadania:</label>
    <textarea name="taskDescription" id="taskDescription" rows="4"></textarea>

    <button type="submit">Dodaj zadanie</button>
</form>
<script>
    function redirectToTasks() {
        window.location.href = 'taskss';
    }
</script>
</body>
</html>





