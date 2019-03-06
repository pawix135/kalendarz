<?php

if(isset($_POST['addEvent'])){

	if(!empty($_POST['eventName']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])){

    require 'database.php';

    $eventName = htmlentities($conn->real_escape_string($_POST['eventName']));
		$startDate = htmlentities($conn->real_escape_string($_POST['startDate']));
		$endDate = htmlentities($conn->real_escape_string($_POST['endDate']));
		$addedDate = htmlentities($conn->real_escape_string($_POST['date-added']));
		$removedDate = htmlentities($conn->real_escape_string($_POST['date-removed']));

    $addEventsql = "INSERT INTO `wydarzenia`(`nazwa_wydarzenia`, `data_rozpoczecia`, `data_zakonczenia`, `daty_dodatkowe`, `daty_przerw`) VALUES ('$eventName', '$startDate', '$endDate', '$addedDate', '$removedDate')";
    $getEventIdsql = "SELECT `id` FROM `wydarzenia` WHERE `nazwa_wydarzenia` = '$eventName'";

		if($conn->query($addEventsql)){

			$id = $conn->query($getEventIdsql)->fetch_assoc()['id'];

		}

		$date = date('Y-m-d', strtotime("$startDate -1 day"));
		$sqlData = [];
		$r = explode(',', $removedDate);
		$addEventDayssql = "INSERT INTO `daty`(`id_wydarzenia`, `data`) VALUES ";

		while (strtotime($date) <= strtotime($endDate)) {

			if($date === $endDate){
				break;
			}

			$date = date('Y-m-d', strtotime("+1 day", strtotime($date)));

			if(in_array($date, $r)){

			}else{
				array_push($sqlData, "('$id', '$date')");
			}

		}

		$addEventDayssql .= implode(',', $sqlData);

		if($conn->query($addEventDayssql)){

			$a = [];
			$addAddedDayssql = "INSERT INTO `daty`(`id_wydarzenia`, `data`) VALUES ";

			foreach (explode(',',$addedDate) as $value) {
				array_push($a, "('$id', '$value')");
			}

			$addAddedDayssql .= implode(',', $a);
			$conn->query($addAddedDayssql);

		}

		$conn->close();

    header('Location: http://localhost/kalendarz/index.php?success');

	}else{
		$error = "";
		switch ($_POST) {
			case empty($_POST['eventName']):
				$error .= 'Nie podano nazwy eventu! ';
				break;
			case empty($_POST['startDate']):
				$error .= 'Nie podano daty rozpoczecia eventu!';
				break;
			case empty($_POST['endDate']):
				$error .= ' Nie podano daty zakonczenia eventu!';
				break;
			default:
				break;
		}
		echo $error;
	}

}

?>
