<?php
foreach ($post as $p){
   echo  $this->render('_post',['model'=>$p]);
}
?>
