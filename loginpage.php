<!-- <?php
 include("connection.php");
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Art Gallery Login</title>
<link rel="stylesheet" href="./styles/login.css">
</head>
<body>
<div class="container">
    <h2>Welcome to our Gallery</h2>
    <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
        <input type="email" id="email" name="email" placeholder="Email"><br>
        <!-- <div class="password-container"> -->
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <!-- <i class="fa-solid fa-eye" id="show-password"></i>
        </div> -->
        <input type="submit" id="btn" value="Login" name="submit">
        <input type="submit" id="buton" value="AdminLogin" name="administrator">
    </form>

    <a href="signuppage.php" class="signup-link">Don't have an account? Sign up here</a>

    <!-- <a href="admin.html" class="admin-link">Log as an admin</a> -->
</div>
<script>
    function isvalid(){
        var user = document.form.username.value;
        var password = document.form.password.value;
        if(user.length == "" && password.lenght==""){
            alert("Username and password is empty");
        return false
        }
        else{
            if(user.length == ""){
            alert("Username  is empty");
            return false;
            }
            if(password.lenght==""){
            alert("Password is empty");
            return false;
            }

        }
    }
    </script>

</body>
</html>
