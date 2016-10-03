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
        if(isset($_GET['id'])){
            
            
             $id = @$_GET['id'];
     function get_record(){
          $id = @$_GET['id'];
        $nq = "select * from books where id = ".$id;
        $res = mysql_query($nq);
        
        $row = mysql_fetch_array($res);
     
         
             $GLOBALS['title'] =   $row[1];
            $GLOBALS['author'] = $row[2];
            $GLOBALS['edition'] =$row[3];
              
            
            if($row[4] == ""){
               $GLOBALS['image'] = "images/no_cover.png" ;
            }else{
                $GLOBALS['image'] =$row[4];
            }
            
        
      }
        get_record();
       
        
            
        }
   
       ?>  
        <?php
                $e = "";
                function add_record($query){
                   $qok = mysql_query($query);
                    if($qok){
                        //echo "record added";
                    }
                }
      
      
        echo "<br> ";
        
        
    
        
        
        
        
        
            if(isset($_POST['add'])){
          
      
                
                         // query for getting all categories available
                $cq ="select category_id , name from category_details ; ";
                $cqq = mysql_query($cq);
                $arr[]="";
                   $counter =0;
                   // array of all categories named arr and also count number of entries for using 'for' loops               
                   while( $record_one = mysql_fetch_array($cqq)){
                      $arr[] = $record_one;
                      $counter++;
                   } //print_r($arr);
                   
               
     for($i=1 ; $i <= $counter ; $i++){ 
         
        
        if(isset($_POST["".$arr[$i][1].""])){
           echo $arr[$i][1];
            $qp = "select * from categories where book_id = '".$id."' and category_id = '".$arr[$i][0]."' ;";
            $rett = mysql_query($qp);
              $rr =   mysql_num_rows($rett);
            if ( $rr >= 1){  // returned mans result exist
                
            }else{
               // echo "</br>insersion detexted<br>";
            $catq = "insert into categories (book_id , category_id ) values( '".$_GET['id']."' , '".$arr[$i][0]."' )";
            mysql_query($catq);
            }
            
            header("Location: #");
        }else{
        
         $catq = "delete from categories where book_id = '".$_GET['id']."' and category_id = '".$arr[$i][0]."' ;";
         // echo $catq."<br>";
            mysql_query($catq);
     }
                
     }
                
                
  
                
                
                
                
                //
              // get file
                $file_name = basename( $_FILES["file"]["name"]);
            
               
                
                           $target_dir =  "images/";
                $target_file = $target_dir.basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                if($target_file == "images/" ){
                    $target_file ="";
                    $target_file = $image;
                   
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
                
                if($imagetype != "jpg" && $imagetype != "png" && $imagetype != "PNG" && $imagetype != "jpeg"
                   && $imagetype != "gif" ) {
                   
                    $uploadOk = 0;
                    }
                
                
                if($uploadOk == 1){
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) ;
                }
              
                
                
                // got file
               
                
                if(!empty($_POST['name'])&&!empty($_POST['author'])&& !empty($_POST['edition']) ){
                    
                $name =  $_POST['name'];
                $author =  $_POST['author'];
                $edition = $_POST['edition'];
                    
                $q =  "update books set name ='".$name."' ,  author = '".$author. "' ,  edition ='" .$edition."', image ='" .$target_file."' where id = ".$id;
                    
                add_record($q);
                     get_record();
                    
                } else{
                   // $e = "*Empty Fields";
                }               
                
            }
        
        
            if(isset($_POST['delete_image'])){
            
              
               $q =  "update books set image ='' where id = ".$id;
                    
                add_record($q);
                     get_record();
        }
        
        
            if(isset($_POST['delete'])){
                
             
               $q =  "delete from  books  where id = ".$id;
                    
                add_record($q);
                    header("Location: index.php");
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
             
                 /*with id*/
               /*   $qq = "select category_id from categories where book_id = '".$id."' ;";      
                   
                 $r =   mysql_query($qq);
                   $a[] = "";
                   $allcs[] = "";
                   $counter = 0;
                while($line =   mysql_fetch_array($r)){
                //echo $line[0];
                    $a[] = $line[0];
                    $counter += 1;
                }
                  // echo "<br>".$counter."<br>";
                   $qn ="select category_id , name from category_details ;";
                   $chala = mysql_query($qn);
                  
                   while($get = mysql_fetch_array($chala)){
                       
                       $allcs[] = $get[0]; 
                       for($i=0 ; $i<= $counter ; $i++){
                           
                           if($get[0] == $a[$i]){
                               $checked ="checked";
                                break;
                           }else{
                               $checked ="";
                               
                           }
                           
                           
                       }
                       echo '
                        <input type="checkbox" '.$checked.' name="'.$get[0].'" />'.$get[1].'
                       ';
                                            
                   } */
                 //  print_r($a);
                 //  print_r($allcs);
                 /*with name*/
             
    
    
                // query for getting all categories available
                $cq ="select category_id , name from category_details ; ";
                $cqq = mysql_query($cq);
                   $counter =0;
                   // array of all categories named arr and also count number of entries for using 'for' loops               
                   while( $record_one = mysql_fetch_array($cqq)){
                      $arr[] = $record_one;
                      $counter++;
                   } //print_r($arr);
                   
                   
                  // echo $counter;
                  // echo $arr[3][1];
                 //print_r($arr);
                   
                   // get specific categories  ids for this book
                    $q = "select category_id from categories where  book_id = '".$id."' ;";
                    $qr = mysql_query($q);
                    $used[]="";
                   $nb = 0;
                    while($first =  mysql_fetch_array($qr)){
                    //  echo $first[0];
                     //   echo $arr[5][1];
                       // echo $arr[$first[0]-2][1];
                       $used_id[] = $first[0];
                       $nb++;
                    }
                  // echo $nb;
                   
                 //print_r($used_id);
                  
                   for($k =0 ; $k<$nb; $k++){
                       
                       $q =  "select name from category_details where category_id = '".$used_id[$k]."' ;";
                       $qer = mysql_query($q);
                       $name_of_cat = mysql_fetch_array($qer);
                       $used[] = $name_of_cat[0];
                       
                   }
                   
                 // print_r($used); 
                   // print all categories
                  // echo $arr[0][1];
                  // print_r($used); 
                   $checked = "";
                   for($i=0; $i < $counter ; $i++){  //in each category 6 times
                             $checked = "";                //check for the match with the name of used
                        for($j = 1 ; $j <= $nb  ; $j++){ //i.e 2 times
                            
                          //echo $arr[$i][1]." == ".$used[$j]." :" ;  
                                if($arr[$i][1] ==  $used[$j]){
                                    $checked = "checked";
                                    break;
                                }
                        }
                     // echo "name='".$arr[$i][1]."' >".$arr[$i][1]."<br>";
                      echo "<input type='checkbox' ".$checked." name= \"".$arr[$i][1]."\" >".$arr[$i][1] ;
                    }
    
    
                   
            ?>
          
            
      
            
            
            
            <p>Cover Image:</p>
            
            <img src="<?php echo $image; ?>"style="height:250px; width:200px;" />&nbsp;
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
                        <input name="delete_image" type="submit" value="Delete Image" class="btn btn-danger">

            &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="submit" class="btn btn-danger" name="delete" value="Delete Book"/>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn " name="display" value="Display Books"/>
             &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="add.php"><input type="button" name="add" value="Add New Books" class="btn btn-success"  ></a>
           
        </form>
            <br><br><br><br><br>
        </div>
    </body>
</html>