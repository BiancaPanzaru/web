<?php
    session_start(); // Începeți sesiunea sau continuați sesiunea existentă
    
    if(isset($_POST['submit'])){
        include("connection.php");
        $username = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
        if($row){
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['loggedin'] = true; // Setează o variabilă de sesiune pentru autentificare
                header("Location: homepage.php");
                exit();
            }
        }
        
        // Dacă autentificarea a eșuat, afișează mesaj și redirecționează către pagina de autentificare
        echo '<script>
        alert("Login failed. Invalid username or password")
        window.location.href = "loginpage.php";
        </script>';
    }    
    if(isset($_POST['administrator'])){
        include("connection.php");
        $username = $_POST['email'];
        $password = $_POST['password'];
        if($username == "admin@ad.com" && $password == "admin"){
            header("Location: admin.php");
        }
        else{
            echo '<script>
            window.location.href = "loginpage.php";
            alert("Login as an admin failed. Try again")
            </script>';
        }
    }

?>