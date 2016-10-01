<html>

<head>
    <title>Display</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="Content/bootstrap.min.css" type="text/css">
    
   
    <script>
       
      
    </script>
    </head>
<body>
    
   
    <div class="container">
         <h1 class="header">BOOKS RECORD</h1>
    <table id="tableg" class="table table-striped" >
       <tr>
        
            <th  id="g">Cover</th>
            <th>Category</th>
            <th>Book Title</th>
            <th>Author</th> 
            <th>Edition</th>
           <th>Status</th>
           <th>Control</th>
        </tr>
        
    <?php
        
      include_once('connection.php');   
        $q = "select * from books";
    
        $qres = mysql_query($q);
    
    
    while( $row = mysql_fetch_array ($qres)){
        if($row['image'] == ""){
            $image =  "images/no_cover.png";
        }else{
            $image  = $row['image'];
        }
        
        if($row['issued'] == 1){
            $status = "images/issued.png";
        }else{
            $status = "images/Available.png"; 
        }
        $cgs = "";
        $cq = "SELECT category_id FROM categories where book_id =  '".$row['id']."' ;";
        $reet = mysql_query($cq);
        while($cat =  mysql_fetch_array($reet)){
          // echo $cat['category_id'];
            $nq = "select name from category_details where category_id = '".$cat['category_id']."' ;";
            
        $name =     mysql_fetch_array(mysql_query($nq));
            
            $cgs .= $name[0] ." ,";
        }
        echo "<tr> 
                    <td><img src='".$image."' style='height:100px; width:90px;'/></td>   
                    <td>".$cgs."</td> 
                    <td>".$row['name']."</td>
                    <td>".$row['author']."</td>
                    <td>".$row['edition']."</td>
                    <td><a href= '#'><img style='width:120px; height:42px; ' src='".$status."'/></a></td>
                    
                    
                    <td><a href='edit.php?id=".$row['id']."'><img style='width:60px; height:60px;' src='images/edit.png'/></a></td>
             
        ";
    }
    ?>
        
        </table>
		
        <a href="add.php"><input type="submit" name="add" value="Add New Books" class="btn btn-success"  ></a>
       <!-- <a href="cat.php"><input type="submit" name="cat" value="Edit Categories" class="btn btn-primary"  ></a> -->
        
		<br>		<br>
		<br>
		<br>
		<br>

    </div>
    </body>
</html>