<?php
if(isset($_POST['submit'])){
    include "connection.php";
    $fullname = $_POST['fullname']; //same as name 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "select * from users where username='$email'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);

    if($count_user == 0){
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "insert into users(fullname, username, password) values ('$fullname', '$email', '$hash')";
            $result =mysqli_query($conn, $sql);
            echo '<script>
            window.location.href = "loginpage.php";
            </script>';
        }
        else{
          echo '<script>
                alert("PAsswords do not match")
                window.location.href = "signuppage.php";  
            </script>';
        }

    }
    else{
        echo '<script>
            alert("User already exists!")
            window.location.href = "loginpage.php";
            </script>';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Art Gallery Sign Up</title>
<link rel="stylesheet" href="./styles/signup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
<div class="container">
    <h2>Create an Account</h2>
    <form id="signup-form" name="form" action="signuppage.php" method="POST">
        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <div class="pass-field">
            <input type="password" id="password" name="password" placeholder="Password" required><br>
        </div>
        <div class="content">
            <p>Password must contains</p>
            <ul class="requirement-list">
                <li>
                    <i class="fa-solid fa-circle"></i>
                    <span>At least 5 characters length</span>
                </li>
                <li>
                    <i class="fa-solid fa-circle"></i>
                    <span>At least 1 number (0...9)</span>
                </li>
                <li>
                    <i class="fa-solid fa-circle"></i>
                    <span>At least 1 uppercase letter (A...Z)</span>
                </li>
            </ul>
      </div>
        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required><br>
        <input type="submit" id="btn" value="Sign Up" name="submit" disabled>
    </form>
    <a href="loginpage.php" class="login-link">Already have an account? Login here</a>
</div>
</body>

<script>
    const passwordInput = document.querySelector(".pass-field input");
    const signupForm = document.getElementById("signup-form");
    const signUpButton = document.getElementById("btn");
    const requirementList = document.querySelectorAll(".requirement-list li");
// An array of password requirements with corresponding 
// regular expressions and index of the requirement list item
const requirements = [
    { regex: /.{5,}/, index: 0 }, // Minimum of 8 characters
    { regex: /[0-9]/, index: 1 }, // At least one number
    { regex: /[A-Z]/, index: 2 }, // At least one uppercase letter
]

function validatePassword(password) {
        return requirements.every(requirement => requirement.regex.test(password));
    }

    // Function to enable/disable the sign up button
    function toggleSignUpButton() {
        signUpButton.disabled = !validatePassword(passwordInput.value);
    }

 // Event listener for keyup event on password input
 passwordInput.addEventListener("keyup", () => {
        toggleSignUpButton();
        requirements.forEach((requirement, index) => {
            const isValid = requirement.regex.test(passwordInput.value);
            const requirementItem = requirementList[index];
            // Updating class and icon of requirement item if requirement matched or not
            if (isValid) {
                requirementItem.classList.add("valid");
                requirementItem.firstElementChild.className = "fa-solid fa-check";
            } else {
                requirementItem.classList.remove("valid");
                requirementItem.firstElementChild.className = "fa-solid fa-circle";
            }
        });
    });

signupForm.addEventListener("submit", (e) => {
        if (!validatePassword(passwordInput.value)) {
            e.preventDefault(); // Prevent form submission if password requirements are not met
            alert("Password must meet all requirements.");
        }
    });
</script>
</html>
