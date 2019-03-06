<?php

  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'kalendarz';

  $conn = new mysqli($host, $user, $pass, $db);
  $conn->set_charset('utf8');
  if(!$conn) {
    die('Could not connect to database!');
  }else{
    return $conn;
  }

  return $conn;
?>
