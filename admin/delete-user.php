<?php include "header.php"; 
 include "config.php";
        $user_id = $_GET['id'];
        $sql = "DELETE FROM user WHERE user_id = '$user_id'";
           if (mysqli_query($conn,$sql)) {
               header("location: http://localhost/news-template/admin/add-user.php");
           }

           mysqli_close($conn);
    
?>