<?php
require_once 'include/config.php';    
if (isset($_POST['button_upload']) && isset($_SESSION['admin_user'])) {
    $file_name = $_FILES['file']['name'];
    $target_dir = "upload/images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");
    $name = $_POST['name'];
    $location = $_POST['location'];
    $add_student_query = "INSERT INTO student_user (name, location, image_path) values('$name', '$location', '$file_name')";
    if( in_array($imageFileType,$extensions_arr) ){
        mysqli_query($database_connection, $add_student_query);
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name);
        header("location: student_list.php");
     }
}
else if (!isset($_SESSION['admin_user']))
  header("location: index.php");
?>
<?php
require_once 'include/header.php';
require_once 'include/sidebar.php';
?>
<div class="main">
    <h3>Add new Student</h3>
    <div class = "row justify-content-center">
        <form action="add_student.php" method="POST" enctype="multipart/form-data">
            <br>
            <div class = "form-group">
                <label>Name</label>
                <input type="text" required name="name" class="form-control" placeholder="Enter your Name">
            </div>
            <div class = "form-group">
                <label>Location</label>
                <input type="text" required name="location" class="form-control" placeholder="Enter Your Location">
            </div>
            <div class = "form-group">
                <input class="btn btn-info" type='file' required name='file' />
            </div>
            <div class = "form-group">
            <input class = "btn btn-primary" type='submit' value='Save Record' name='button_upload'>
            <a href="student_list.php" class="btn btn-info">cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once 'include/footer.php';
?>