<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Edit</title>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.min.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.multidatespicker.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <?php

            if(!empty($_GET['id'])){

              require 'database.php';

              $id = htmlentities($_GET['id']);

              $Eventsql = "SELECT * FROM `wydarzenia` WHERE `id` = '$id'";
              if($result = $conn->query($Eventsql)){

                echo "<form action='editEvent.php' method='post'>";

                while ($row = $result->fetch_assoc()) {

                  $eventId = $row['id'];
                  $eventName = $row['nazwa_wydarzenia'];
                  $eventStart = $row['data_rozpoczecia'];
                  $eventEnd = $row['data_zakonczenia'];
                  $eventAdded = $row['daty_dodatkowe'];
                  $eventRemoved = $row['daty_przerw'];

                  echo "
                        <label>Nazwa wydarzenia</label>
                        <input class='form-control' type='text' name='nameEdit' value='$eventName'><br>
                        <label>Start</label>
                        <input class='form-control' type='date' name='startEdit' value='$eventStart'><br>
                        <label>Koniec</label>
                        <input class='form-control' type='date' name='endEdit' value='$eventEnd'><br>
                        <label>Daty dodane</label>
                        <input class='form-control' type='input' name='addedEdit' value='$eventAdded' id='addedEdit' autocomplete='off'><br>
                        <label>Daty usuniete</label>
                        <input class='form-control' type='input' name='removedEdit' value='$eventRemoved' id='removedEdit' autocomplete='off'><br>
                        <input class='form-control' type='submit' name='submitEdit' value='Edytuj'>
                        <input class='form-control' type='hidden' name='id' value='$eventId'>
                      ";

                }
                echo "</form>";
              }else{

                header("Location: http://localhost/kalendarz/index.php?error=badid");

              }

            }

            if(!empty($_POST['submitEdit'])){

              require 'database.php';

              $id = $conn->real_escape_string(htmlentities($_POST['id']));
              $nameEdit = $conn->real_escape_string(htmlentities($_POST['nameEdit']));
              $startEdit = $conn->real_escape_string(htmlentities($_POST['startEdit']));
              $endEdit = $conn->real_escape_string(htmlentities($_POST['endEdit']));
              $addedEdit = $conn->real_escape_string(htmlentities($_POST['addedEdit']));
              $removedEdit = $conn->real_escape_string(htmlentities($_POST['removedEdit']));

              if(date('Y-m-d', strtotime($startEdit)) <= date('Y-m-d', strtotime($endEdit))){

                $editsql = "UPDATE `wydarzenia` SET `nazwa_wydarzenia`= '$nameEdit',`data_rozpoczecia`= '$startEdit',`data_zakonczenia`= '$endEdit', `daty_dodatkowe` = '$addedEdit', `daty_przerw` = '$removedEdit' WHERE `id` = '$id'";
                if($conn->query($editsql) === true){

                  //Usuniecie dat
                  $editDateDownssql = "DELETE FROM `daty` WHERE `id_wydarzenia` = '$id'";
                  $conn->query($editDateDownssql);

                  //Dodawanie dat
                  $date = date('Y-m-d', strtotime("$startEdit -1 day"));
                  $sqlData = [];
                  $r = explode(',', $removedEdit);
                  $addDays = "INSERT INTO `daty`(`id_wydarzenia`, `data`) VALUES ";

                  while (strtotime($date) <= strtotime($endEdit)) {

                    if($date === $endEdit){
                      break;
                    }

                    $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));


                    if(in_array($date, $r)){

                    }else{
                      array_push($sqlData, "('$id', '$date')");
                    }

                  }
                  $addDays .= implode(',', $sqlData);

                  if($conn->query($addDays)){
                    $a = [];
                    $addAddedDayssql = "INSERT INTO `daty`(`id_wydarzenia`, `data`) VALUES ";

                    foreach (explode(',',$addedEdit) as $value) {
                      array_push($a, "('$id', '$value')");
                    }

                    $addAddedDayssql .= implode(',', $a);
                    $conn->query($addAddedDayssql);

                  }

                  header("LOCATION: http://localhost/kalendarz/php/editEvent.php?id=$id&success");
                  return;

                }else{

                  header("LOCATION: http://localhost/kalendarz/php/editEvent.php?id=$id&error");
                  return;

                }

              }else{

                header("LOCATION: http://localhost/kalendarz/php/editEvent.php?id=$id&date=<");
                return;

              }

              $conn->close();
            }
          ?>

          <a href="http://localhost/kalendarz/index.php" value="click" style="font-size: 40px; text-decoration: none;">Cofnij</a>
          <br><a href="http://localhost/kalendarz/php/deleteEvent.php?delete=<?= $id; ?>" style="text-decoration: none;color: red; font-size: 40px;">Usuń</a>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui-1.12.1/jquery-ui.min.js" charset="utf-8"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui.multidatespicker.js" charset="utf-8"></script>
    <script type="text/javascript">
      $('#addedEdit').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        separator: ','
      });
      $('#removedEdit').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        separator: ','
      });
    </script>
  </body>
</html>
