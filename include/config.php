<?php
    session_start();
    $database_connection = new mysqli('localhost', 'root', '', 'student_portal') or die(mysqli_error($musqli));
?>