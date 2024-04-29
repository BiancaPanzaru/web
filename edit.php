<?php
  include "connection.php";
  $id="";
  $name="";
  $email="";
  $password="";
  $newpassword="";

  $error="";
  $success="";

  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      header("Location:admin.php");
      exit;
    }
    $id = $_GET['id'];
    $sql = "select * from users where id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while(!$row){
      header("Location:admin.php");
      exit;
    }
    $name=$row["fullname"];
    $email=$row["username"];
    $password=" ";
    $newpassword=" ";

  }
  else{
    $id = $_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $newpassword=$_POST["newpassword"];
    if(empty($newpassword)) {
      echo '<script>  
      alert("New password field cannot be empty.")
      window.location.href = "edit.php";  
      </script>';
  } else{    // Extrage parola criptată din baza de date
  $sql_password = "SELECT password FROM users WHERE id='$id'";
  $result_password = $conn->query($sql_password);
  $row_password = $result_password->fetch_assoc();
  $hashed_password = $row_password['password'];

  // Verifică dacă parola nouă este diferită de cea veche
    if (password_verify($newpassword, $hashed_password)) {
      echo '<script>  
      alert("The new password must be different from the old password.")
      window.location.href = "edit.php";  
      </script>';
    }
    else{
      $hash = password_hash($newpassword, PASSWORD_DEFAULT);
      $sql = "update users set fullname='$name', username='$email', password='$hash' where id='$id'";
      $result = $conn->query($sql);
      header("Location:admin.php");

    }
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">User Management</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header">
 <h1 class="text-white text-center">  Update Member </h1>
 </div><br>

 <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

 <label> NAME: </label>
 <input type="text" name="name" value="<?php echo $name; ?>" class="form-control"> <br>

 <label> EMAIL: </label>
 <input type="text" name="email" value="<?php echo $email; ?>" class="form-control"> <br>

 <input type="hidden" name="password"  class="form-control"> <br>

 <label> NEW PASSWORD: </label>
 <input type="password" name="newpassword"  class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="admin.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>