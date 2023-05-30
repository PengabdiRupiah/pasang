<?php
require 'dbcon.php';

if(isset($_POST['delete']))
{
    $id = mysqli_real_escape_string($conn, $_POST['delete']);

    $query = "DELETE FROM tb_1 WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Deleted Successfully";
        header("Location: regis.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "can Not Deleted";
        header("Location: regis.php");
        exit(0);
    }

}

?>