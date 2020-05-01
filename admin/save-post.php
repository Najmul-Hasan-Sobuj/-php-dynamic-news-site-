<?php
         include "config.php";

         if (isset($_FILES['fileToUpload'])) {
            $error = array();

             $file_name = $_FILES['fileToUpload']['name'];
             $file_size = $_FILES['fileToUpload']['size'];
             $tmp_name = $_FILES['fileToUpload']['tmp_name'];
             $file_type = $_FILES['fileToUpload']['type'];
             $file_ext = strtolower(end(explode('.',$file_name)));
             $extension = array("jepg","jpg","png");

             if (in_array($file_ext,$extension)=== false) {
                $error[] = "This extension file not allowed";
             }

             if ($file_size> 2097152 ) {
                $error[] = "File size must 2mb or lower";
             }

             if (empty($error) == true) {
                 move_uploaded_file($tmp_name,"uplead/".$file_name);
             }else {
                 print_r($error);
                 die();
             }
         }

         session_start();

         $tittle = mysqli_real_escape_string($conn,$_FILES['post_title']);
         $description = mysqli_real_escape_string($conn,$_FILES['postdesc']);
         $category = mysqli_real_escape_string($conn,$_FILES['category']);
         $date = date("d M, Y");
         $auther = $_SESSION['user_id'];

         $sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES ('$tittle','$description','$category','$date','$auther','$file_name');";

         $sql .= "UPDATE  category SET post = post + 1 WHERE category_id = '$category";

         if (mysqli_multi_query($conn,$sql)) {
             header("location: http://localhost/news-template/admin/post.php");
         }else {
             echo "query failed";
         }


             


   ?>