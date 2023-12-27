<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class = "top-bar"></div>
        <div class = "bottom-bar"></div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input name="email" type="text" placeholder="E-mail">
                <input name="password" type="password" placeholder="Password">
                <button type="submit">CONTINUE</button>
            </form>
        </div>
    </div>
</body>