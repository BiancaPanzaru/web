<?php
    include "connection.php";
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $sql = "select * from users where username='$email'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        if($count_user == 0){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "insert into users(fullname, username, password) values ('$name', '$email', '$hash')";
                $result =mysqli_query($conn, $sql);
                echo '<script>
                window.location.href = "admin.php";
                </script>';
                }
                else{
                echo '<script>
                        alert("Passwords do not match")
                        window.location.href = "create.php";  
                    </script>';
                }

            }
            else{
                echo '<script>
                    alert("User already exists!")
                    window.location.href = "admin.php";
                    </script>';
                }
    }
?>
<!DOCTYPE html>
<html>
<head>
 <title>CRUD</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel ="stylesheet" href="./styles/crud.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">User Management</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php"><span style="font-size:larger;">Add New</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header">
 <h1 class="text-white text-center">  Create New Member </h1>
 </div><br>

 <label> FULLNAME: </label>
 <input type="text" name="name" class="form-control"> <br>

 <label> EMAIL: </label>
 <input type="email" name="email" class="form-control"> <br>

 <label> PASSWORD: </label>
 <input type="password" name="password" class="form-control"> <br>

 <label> CONFIRM PASSWORD: </label>
 <input type="password" name="cpassword" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="admin.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>