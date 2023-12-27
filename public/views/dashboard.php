<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="stylesheet" href="public/css/global.css">
    <title>Dashboard</title>
    <style>
        .container {
            position: relative;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .agenda-tasks-container {
            display: flex;
        }

        .agenda,
        .tasks {
            margin-right: 10px;
        }

        button {
            margin-top: 50px;
            padding: 12px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar"></div>
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="bottom-bar"></div>
        <div class="login-container">
            <div class="agenda-tasks-container">
                <a href="agenda" class="agenda">
                    <img src="public/img/agenda.svg">
                </a>
                <a href="tasks" class="tasks">
                    <img src="public/img/tasks.svg">
                </a>
            </div>
            <button type="submit">LOGOUT</button>      
        </div>
    </div>
</body>
</html>
