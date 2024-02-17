<?php


if(isset($_POST['adaugare_analize'])){
  $items=$_POST['identificare'];
  $ids=explode('&', $items);
  $id_pacient=(int)substr($ids[0], -1);
  $db = mysqli_connect('localhost', 'root', '', 'patients_manager');
  $imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
  $imageProperties = getimageSize($_FILES['file']['tmp_name']);
  $name= $_FILES['file']['name'];  
  $date=date('Y-m-d');
  $query = "insert into analize(continut,id_pacient,data,nume) values('$imgData',$id_pacient,'$date','$name')";
  mysqli_query($db,$query);
  
  
  
  

 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="upload/";
 
 /* new file size in KB */
 $new_size = $file_size/1024;  
 /* new file size in KB */
 
 /* make file name in lower case */
 $new_file_name = strtolower($name);
 /* make file name in lower case */
 
 $final_file=str_replace(' ','-',$new_file_name);
 move_uploaded_file($file_loc,$folder.$final_file);
header('Location:analize.php?' . $items . '');
}
?>