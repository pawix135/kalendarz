<?php

require 'database.php';

if($result = $conn->query("SELECT * FROM `wydarzenia`")){

  if($result->num_rows < 1){
    echo "<li>Dodaj event by by event! Proste.</li>";
    return;
  }

  while ($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['nazwa_wydarzenia'];
    echo "<a href='http://localhost/kalendarz/php/editEvent.php?id=$id'><li>$name</li></a>";

  }
}

$conn->close();
?>
