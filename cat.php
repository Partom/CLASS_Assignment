<html>

<head>
    <title>Category</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="Content/bootstrap.min.css" type="text/css">
    
   
    <script>
       
      
    </script>
    </head>
<body>
    
   
    <div class="container">
        <h1>Delete From Categories</h1>
        <?php
            include_once('connection.php');
            $q = "select * from category_details;";
            $q_r = mysql_query($q);
       ?>
        <form method="post">
        <?php 
            
            if(isset($_POST['del'])){
                $to_be_del = $_POST['sel'];
               echo $to_be_del;
                
                $qgk = "DELETE FROM `categories` WHERE category_id = (select category_id from category_details WHERE name = '".$to_be_del."' )";
                mysql_query($qgk);
                
                $qq = "delete from category_details where name= '".mysql_real_escape_string($to_be_del)."' ;";
              $gg=  mysql_query($qq);
                if($gg){
                   header("Location: #");
                }
            }
            if(isset($_POST['add'])){
                $name = $_POST['name'];
                $des =  $_POST['des'];
                
                //echo "name = ". $name ." , description = ".$des; 
                
                $q = "insert into category_details (name , description) values( '".$name."' , '".$des."');";
                mysql_query($q);
                header("Location: #");
                
            }
            
            if(isset($_POST['display'])){
                header("Location: index.php");
            }
            
            echo "
            <select name='sel' class='form-control'>";
        while($cat = mysql_fetch_array($q_r)){
            echo "<option name='".$cat[0]."'>".$cat[1]."</optionn>";
           
        }
         echo"
            </seclect>
            
            
            ";
            
        ?>
            <br>
            <input class="btn btn-danger" type="submit" name="del" value="Delete Category ">
            
         
            <h1>Add New Category</h1>
            <input type="text" name="name" class="form-control  " placeholder="Name Of new Category">
            <br>
            <input type="text" name="des" class="form-control" placeholder="Description">
            <br>   
             <input class="btn btn-success" type="submit" name="add" value="Add New Category">


         
               <input class="btn btn-primary" type="submit" name="display" value="Display Books ">
        </form>
    </div>
    </body>
</html>