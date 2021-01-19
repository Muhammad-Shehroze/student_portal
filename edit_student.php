<?php
require_once 'include/config.php';
$name = '';
$location = '';
if (isset($_GET['student_id']) && isset($_SESSION['admin_user'])) {
    $id = $_GET['student_id'];
    $edit_student_query = "SELECT * FROM student_user WHERE id=$id";
    $result = mysqli_query($database_connection, $edit_student_query);
    if ($result) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}
if (isset($_POST['button_update']) && isset($_SESSION['admin_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    if(empty($_FILES['file']['name'])){
        $update_student_query = "UPDATE student_user SET name='$name', location='$location' WHERE id=$id";
        mysqli_query($database_connection, $update_student_query);
        header("location: student_list.php");
    }
    else {
        $file_name = $_FILES['file']['name'];
        $target_dir = "upload/images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        $update_student_query = "UPDATE student_user SET name='$name', location='$location', image_path='$file_name' WHERE id=$id";
        mysqli_query($database_connection, $update_student_query);
        if( in_array($imageFileType,$extensions_arr) ){
            mysqli_query($database_connection, $add_student_query);
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name);
            header("location: student_list.php");
         }
        }
}
if (!isset($_SESSION['admin_user']))
    header("location: index.php");

    require_once 'include/header.php';
    require_once 'include/sidebar.php';
?>
<div class="main">
    <h3>Edit Student</h3>
    <div class = "row justify-content-center">
        <form action="edit_student.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name = "id" value="<?php echo $id; ?>">
            <div class = "form-group">
                <label>Name</label>
                <input type="text" required name="name" class="form-control" placeholder="Enter your Name"
                    value="<?php echo $name; ?>">
            </div>
            <div class = "form-group">
                <label>Location</label>
                <input type="text" required name="location" class="form-control" placeholder="Enter Your Location"
                value="<?php echo $location;?>">
            </div>
            <div class = "form-group">
                <input class="btn btn-info" type='file' name='file'>
            </div>
            <div class = "form-group">
                <input class = "btn btn-primary" type='submit' value='Update' name='button_update'>
                <a href="student_list.php" class="btn btn-info">cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once 'include/footer.php';
?>