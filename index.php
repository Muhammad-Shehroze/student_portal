<?php
    require_once 'include/config.php';
    require_once 'include/function.php';
    $error = "";
    if (isset($_POST['login_btn'])) {
        $user_name     = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_name     = text_input($user_name);
        $user_password = text_input($user_password);
        $_SESSION['admin_user'] = $user_name;

        if (empty($user_name))
            $error = "Please enter your name";
        else if (empty($user_password))
            $error = "Password cannot be blank";
        if ($error == "") {
            $student_login_query = "SELECT name, password FROM admin_user WHERE name='$user_name' AND password='$user_password'";
            $result = mysqli_query($database_connection, $student_login_query);
            if (mysqli_num_rows($result) == 0)
                $error = "Please enter your valid name and password";
            else{ 
                $_SESSION['admin_user'] = true;
                header("location: dashboard.php");
            }
        } 
    }
?>
<html>    
    <head>    
        <title>Login Form</title>    
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script type="text/javascript" src="javaScript/Validate.js"></script>    
    </head>    
    <body>
        <h2 class="h2">Login</h2><br>    
        <div class="login">
            <p style="margin-top: -60px; color: red;">   
                <?php 
                if ($error != "")
                echo "$error";?> 
            </p>
            <form id="login" method="POST">    
                <label class="label"><b>User Name</b>    
                </label>    
                <input type="text" name="user_name" id="user_name" value="<?php echo @$_SESSION['admin_user']; ?>" placeholder="Please Enter Your Name" required>    
                <br><br>    
                <label class="label"><b> Password </b>    
                </label>    
                <input type="password" name="user_password" id="user_password" placeholder="Please Enter Your Password" required>
                <br><br>    
                <button type="submit" name="login_btn" id="login_btn">Log In Here</button>
            </form>     
        </div>
    </body>  
</html> 