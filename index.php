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
        <script src="bootsrap/jquery-1.10.2.min.js"></script>
        <style>
            
            .form-control{
    min-width: 180px;
    max-width: 180px;
}
.search{
    min-width: 80%;
    margin: 5px;
    alignment-adjust: central;
}
p{
    margin: 1px;
}
.form-inline .form-control{
    margin: 2px;
}
.glyphicon{
     color:#FE980F;
}
.img-responsive{
                max-height: 250px;
            }
        </style>
        <script>
        $(document).ready(function(){
            $(".more").hide();
            $(".expand").show();
            $(".expand").click(function(){
                $(".collapse").show();
                     $(".more").show();
                 $(".expand").hide();
            } );
             $(".collapse").click(function(){
                 $(".collapse").hide();
                     $(".more").hide();
                 $(".expand").show();
             } );
        });
        </script>
        
    </head>
    <body>
        <?php require_once './header.php';?>
        <div class="container">
           
        <form action="" method="post" class="form-group form-inline">
           <?php
           $name="";
           if(isset($_POST['name'])){
               $name=$_POST['name'];
           }
           ?>
            
                 <h3>Search By</h3>
                 <div class="col-xs-12"> <input type="text" name="name" id="name" class="form-control search" placeholder="Search" value="<?php echo $name ;?>">
                 </div>
                 
                 <div class="expand">  <span class="glyphicon glyphicon-plus-sign pull-right" style="cursor: pointer;margin: 5px;"> More</span></div>
                  <div class="collapse"> <span class="glyphicon glyphicon-minus-sign pull-right" style="cursor: pointer; margin: 5px;"> Less</span></div>
                <div class="clearfix"></div>
                <div class="more" style="margin-top: 10px;">
 <?php
              
        require_once './includes/connection.php';
            $options=array('release_year'=>'Release Year','actor_actress'=>'Cast','director'=>'Director','type'=>'Type'
                ,'language'=>'Language','country'=>'Country','location'=>'Location','writers'=>'Writers','rating'=>'Rating');
            $where_clause=array();
            if(!empty($_POST['name'])){
                $where_clause[]=' name like "%'.$_POST['name'].'%"';
            }
            foreach ($options as $key => $value) {
                $sql="select DISTINCT $key from movies";
                $result=mysqli_query($con, $sql);
                $data=array();
                
                while($row=  mysqli_fetch_array($result)){
                    $data_row=$row[$key];
                    $data_array=  explode(",", $data_row);
                    $data=  array_merge($data,$data_array);
            }
            $data=  array_unique($data);
            echo '<div class="col-sm-2" ><label for="'.$key.'" style="margin-bootom:2px;">'.$value.'</label></div> ';
            echo '<div class="col-sm-4" ><select id="'.$key.'" name="'.$key.'" class="form-control" style="margin-bootom:2px;">';
               echo '<option>Select '.$value.'</option>';
              
            foreach ($data as $optvalue) {
                $selected="";
                
                if($optvalue==$_POST[$key]){
                     var_dump($_POST[$key]);
              
                    $where_clause[]=" $key like '%".$optvalue."%'";
                    $selected="selected";
                    ?>
                      <script>
                          $(document).ready(function(){
                              $(".more").show();
                               $(".collapse").show();
                                $(".expand").hide();
                          } );
                      </script>
                      <?php
                }
                echo '<option '.$selected.'>'.$optvalue.'</option>';
            }
            echo '</select></div>';
            }
            $where_clause_str = (count($where_clause) ? ' WHERE '.implode(' AND ', $where_clause) : '');
           
            ?>
                      </div> 
                 <div class="col-xs-12 ">
            <button type="reset" name="reset" class="btn btn-primary pull-right">Reset</button>
            <button type="submit" name="submit" class="btn btn-primary pull-right" style="margin-right: 10px;margin-bottom:20px;">Search</button>
                
                 </div>
                <div class="container" style="margin-top: 100px;">
                
        <?php
      
        $sql="Select * from movies ".$where_clause_str;
        $query=  mysqli_query($con, $sql);
         $i=0;
        while($row=  mysqli_fetch_array($query)){
            $i++;
            ?>
                <div class="col-sm-4" align="center">
                    <a href="info.php?id=<?php echo $row['id'];?>"> <img src="images/14963409_1728442467212114_2289119464620313337_n.jpg" class="img-responsive"></a>
                    <p><strong>Name:</strong> <span><?php echo $row['name'];?></span></p>
                     <p><strong>Director:</strong> <span><?php echo $row['director'];?></span></p>
                     <p><strong>Type:</strong> <span><?php echo $row['type'];?></span></p>
                     <p><strong>Language:</strong> <span><?php echo $row['language'];?></span></p>
                </div>
                <?php
            
        }
        if($i==0){
            ?>
                    <div class="clearfix"></div>
                    <div class="row alert-danger"><h3>No Records Found</h3></div>
                <?php
                
        }
        // put your code here
        ?>
                    
            </div>
        </form>
        </div>
    </body>
</html>
