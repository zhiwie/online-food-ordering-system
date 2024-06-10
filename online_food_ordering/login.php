<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- css/style.css doesnt work, style.css works//why? -->
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');


    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission


        // Get input values
        const username = document.querySelector('input[type="text"]').value;
        const password = document.querySelector('input[type="password"]').value;


        // Perform basic validation
        if (username.trim() === '') {
            alert('Please enter a username');
            return;
        }


        if (password.trim() === '') {
            alert('Please enter a password');
            return;
        }


        // If all validations pass, you can proceed with form submission
        alert('Form submitted successfully!');
        // You can also submit the form programmatically if needed:
        // form.submit();
    });
});
</script>
   
</head>
<body>

    <div class="wrapper">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
        </form>
    </div>



<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the values from the form
    $username = $_POST["username"];
    $password = $_POST["password"];


    // Perform basic server-side validation
    if (empty($username)) {
        $error = "Please enter a username";
    } elseif (empty($password)) {
        $error = "Please enter a password";
    } else {
        // Form submitted successfully
        // Here you can perform further processing such as database operations, authentication, etc.
        // For demonstration purposes, let's just echo a success message
        echo "Form submitted successfully!";
        // You can also redirect the user to another page if needed
        // header("Location: success.php");
        // exit(); // Make sure to exit after redirection
    }
}
?>

</body>

</html>