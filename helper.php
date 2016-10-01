<?php
    
 function error(  $error ){
       echo '<div style="padding-top :10px;" class="alert alert-danger fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
             <strong>Error !  </strong>'.$error.'.</br>
                 </div> ';
}

function warning($error){
                        echo ' <div style="padding-top :10px; " class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Warning!   </strong>'.$error.'.
                        </div>';  
}

function success($msg){
                             echo '<div style="padding-top :10px;" class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <strong>Congratulations!</strong> '.$msg.'.
                            </div>';  
}
    
?>