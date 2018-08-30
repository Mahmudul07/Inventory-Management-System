<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login Form</title>
    <link rel="icon" href="Knight/favicon.png" type="image/png">
    <link href="indexx/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="indexx/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".username").focus(function() {
                $(".user-icon").css("left","-48px");
            });
            $(".username").blur(function() {
                $(".user-icon").css("left","0px");
            });

            $(".password").focus(function() {
                $(".pass-icon").css("left","-48px");
            });
            $(".password").blur(function() {
                $(".pass-icon").css("left","0px");
            });
        });
    </script>
</head>
<body>
<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <?php
    error_reporting (E_ALL ^ E_NOTICE);
    echo $_GET['msg'];
    ?>
    <form method="post" class="login-form" action="checklogin.php"  id="loginForm">
        <div class="header">
            <h1>Admin Login</h1>
        </div>
        <div class="content">
            <input name="myusername"  type="text" class="input username" value="Username" placeholder="User name" onfocus="this.value=''" />
            <input name="mypassword"  type="password" class="input password" value="" placeholder="Password" onfocus="this.value=''" />
        </div>
        <div class="footer">
            <input type="submit" name="submit" value="Login" class="button" />
        </div>
    </form>
</div>
<div class="gradient"></div>
</body>
</html>


