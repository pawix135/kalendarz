<?php

if(!empty($_GET['delete'])){

  require 'database.php';
  $id = htmlentities($conn->real_escape_string($_GET['delete']));

  $deleteEventsql = "DELETE FROM `wydarzenia` WHERE `id` = '$id'";
  $deleteEventDatessql = "DELETE FROM `daty` WHERE `id_wydarzenia` = '$id'";

  if($conn->query($deleteEventsql) === true){
    if($conn->query($deleteEventDatessql) === true){
      header("Location: http://localhost/kalendarz/index.php?deleted");
    }
  }


  // header("Location: edit.php?id=$id&deleted");

}
?>
