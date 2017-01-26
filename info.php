<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Movies</title>
        <link rel="stylesheet" href="bootsrap/css/bootstrap.min.css">
        <style>
            .img-responsive{
                max-height: 300px;
            }
        </style>
        
    </head>
    <body>
         <?php require_once './header.php';?>
        <form action="" method="post" class="form-group form-inline">
              <?php
              
        require_once './includes/connection.php';
        ?>
            <div class="container" style="margin-top: 40px;">
                
        <?php
        $id=$_GET['id'];
        $sql="Select * from movies where id=".$id;
        $query=  mysqli_query($con, $sql);
     
        while($row=  mysqli_fetch_array($query)){
            ?>
                <div class="col-xs-4">
                    <a href="info.php?id=<?php echo $row['id'];?>"> <img src="images/14963409_1728442467212114_2289119464620313337_n.jpg" class="img-responsive"></a>
                  
                </div>
                <div class="col-xs-8"> <p>
                        <strong>Rating:</strong> <span class="badge"><?php echo $row['rating'];?></span></p>
                     <p><strong>Name:</strong> <span><?php echo $row['name'];?></span></p>
                     <p><strong>Director:</strong> <span><?php echo $row['director'];?></span></p>
                     <p><strong>Type:</strong> <span><?php echo $row['type'];?></span></p>
                     <p><strong>Language:</strong> <span><?php echo $row['language'];?></span></p>
                     <p><strong>Country:</strong> <span><?php echo $row['country'];?></span></p>
                     <p><strong>Writers:</strong> <span><?php echo $row['writers'];?></span></p>
                    
                    
                </div>
            
                <div class="row">
                    <div class="col-xs-12">
                         <p><strong>About:</strong> <span><?php echo $row['about'];?></span></p>
                    </div>
                </div>
                    <?php
           
        }
        // put your code here
        ?>
            </div>
        </form>
    </body>
</html>
