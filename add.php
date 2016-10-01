<!doctype HTML>
<html>

    <head>
        <title>FORM</title>
     <link rel="stylesheet" href="Content/bootstrap.min.css">
  <script src="scripts/jquery-1.9.1.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
        
    </head>
    <body>

  <?php
        $f="";
        $c="";
        $l="";
        include_once ('connection.php');
        include_once ('helper.php');
    
     $e = "";
                function add_record($query){
                   $qok = mysql_query($query);
                    if($qok){
                        
                        
                         $number ="SELECT id FROM `books` order by id desc ";
                $num_res = mysql_query($number);
               $last_book =  mysql_fetch_array($num_res);
                echo $last_book[0];
                $bookid = $last_book[0];
                        
                        //echo "record added";
                        
                          //checkbox
                  $q =  "select category_id , name  from category_details ";
            $return = mysql_query($q);
                
                 $num_of_rows = mysql_num_rows($return);
               
     for($i=1 ; $i <= $num_of_rows ; $i++){ 
        
        if(isset($_POST[''.$i.''])){
            
            echo $i."to hai";
            $catq = "insert into categories (book_id , category_id ) values( '".$bookid."' , '".$i."' )";
            mysql_query($catq);
        }
                
     }
                //
                        
                    }
                }
      
     
        echo "<br> ";
        
        
    
        
        
        
        
        
            if(isset($_POST['add'])){
          
              
                //
              // get file
                $file_name = basename( $_FILES["file"]["name"]);
            
               
                
                           $target_dir =  "images/";
                $target_file = $target_dir.basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                if($target_file == "images/" ){
                    $target_file ="";
                   
                }
                $imagetype =  pathinfo($target_file , PATHINFO_EXTENSION);
                
                    $check = @getimagesize($_FILES["file"]["tmp_name"]);
                          
                 
                       if($check !== false) {
                    $uploadOk = 1;
                    } else {
                    
                    $uploadOk = 0;
                    }
                    
                if(file_exists($target_file)){
                  
                    $uploadOk =  0;
                }
                
                if($imagetype != "jpg" && $imagetype != "png" && $imagetype != "jpeg"
                   && $imagetype != "gif" ) {
                   
                    $uploadOk = 0;
                    }
                
                // got file
               
                    
                if($uploadOk == 1){
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) ;
                }
              
                if(!empty($_POST['name'])&&!empty($_POST['author'])&& !empty($_POST['edition']) ){
                    
                $name =  $_POST['name'];
                $author =  $_POST['author'];
                $edition = $_POST['edition'];
                    
                $q =  "insert into books ( name  , author , edition , image ) values ('".$name."' ,  '".$author. "' ,  '" .$edition."', '" .$target_file."' ); ";
                    
                add_record($q);
                  header("Location: index.php");
                    
                } else{
                   // $e = "*Empty Fields";
                }               
                
            }
        
        
        
        
        
         if(isset($_POST['display'])){
                header("Location: index.php");
     
         }
        
       
   
    
       
        ?>
        
        <div class="container">
        <form class="form" method="post" enctype="multipart/form-data">
                <h1 class="header">Editing data:</h1>
            <span>Title of Book</span>
            <input type="text"class ="form-control"   name="name" placeholder="Book Title" value="<?php echo @$title;?>"/> <br>
            <span>Author:</span>
            <input type="text" class ="form-control"  name="author" placeholder="Author's Name"  value="<?php echo @$author;?>" /><br>
            <span>Edition:</span>
            <input type="text"class ="form-control"   name="edition" placeholder="Book's Edition" value="<?php echo @$edition?>" /> <p class="error" ><br>
            <?php
            $q =  "select category_id , name  from category_details ";
            $return = mysql_query($q);
                   while($row = mysql_fetch_array($return)){
                       echo "
                        <input type='checkbox' name='".$row[0]."' /> ".$row[1]."
                       ";
                   }
            
            ?>
            <br>
            <p>Cover Image:</p>
            
           
             <input type="file" name="file"class="form">
            <br><br>
            <?php
            // file checks
                     
                

                //
            //file
            ?>
           
            <br>
            <input type="submit" class="btn btn-success" name="add" value="Update Record"/>&nbsp;
            
           
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            <input type="submit" class="btn " name="display" value="Display Books"/>
             &nbsp;&nbsp;&nbsp;&nbsp;
          
           
        </form>
        </div>
    </body>
</html>