<?php
    require_once 'include/config.php';
    $name = '';//hell fun
    $location = '';
    $update = false;
    $id = 0;
    if( isset( $_SESSION['admin_user'])) {
        $student_dashboard_query = "SELECT * FROM student_user";
        $result = mysqli_query($database_connection, $student_dashboard_query);
    }else
        header("location: index.php");
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $delete_student_query = "DELETE FROM student_user WHERE id=$id";
        mysqli_query($database_connection, $delete_student_query);
        header("location: student_list.php");
    }
    require_once 'include/header.php';
    require_once 'include/sidebar.php';
?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">    
<!-- JavaScript JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<div class="content">
<div class="main">
    <h3>Student List
    <a href="add_student.php"
        class="btn btn-info" style="float: right;">Add Student</a></h3>
    
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) :?>     
                <tr>
                    <?php
                    $image = $row['image_path'];
                    $image_src = "upload/images/".$image;
                    ?>
                    <td><img src='<?php echo $image_src;  ?>'style="width: 50px; height: 50px; border-radius:50px"></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['location']?></td>
                    <td>
                        <a href="edit_student.php?student_id=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                        <a onclick="return confirm('Are you sure to delete?')" href="student_list.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
    </table>
</div>
</div>
<?php
require_once 'include/footer.php';
?>
<script>
$(document).ready(function() {
    $('#example').DataTable();
    
});
</script>
