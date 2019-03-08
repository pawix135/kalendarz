<?php
if(!empty($_GET['month']) && 1 <= $_GET['month'] && $_GET['month'] <= 12 ){

	$month = $_GET['month'];
}else{

	$month = date('m');

}
if(!empty($_GET['year'])){

	$year = $_GET['year'];
}else{

	$year = date('Y');
}

function createCalendar($month,$year) {

  require 'database.php';

  $daysOfWeek = array('Nie','Pon','Wto','Sro','Czw','Ptk','Sob');
  // $daysOfWeek = array('Pon','Wto','Sro','Czw','Ptk','Sob', 'Nie');

  $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

  $numberDays = date('t',$firstDayOfMonth);

  $dateComponents = getdate($firstDayOfMonth);

  $monthName = $dateComponents['month'];
  switch ($monthName) {
    case 'January':
      $monthName = "Styczeń";
      break;
    case 'February':
      $monthName = "Luty";
      break;
    case 'March':
      $monthName = "Marzec";
      break;
    case 'April':
      $monthName = "Kwiecień";
      break;
    case 'May':
      $monthName = "Maj";
      break;
    case 'June':
      $monthName = "Czerwiec";
      break;
    case 'July':
      $monthName = "Lipiec";
      break;
    case 'August':
      $monthName = "Sierpień";
      break;
    case 'September':
      $monthName = "Wrzesień";
      break;
    case 'October':
      $monthName = "Październik";
      break;
    case 'November':
      $monthName = "Listopad";
      break;
    case 'December':
      $monthName = "Grudzień";
      break;
    default:
      break;
  }

  $dayOfWeek = $dateComponents['wday'];

  $calendar =
				"
					<table class='table table-bordered' style='overflow-x:auto;'>
						<caption>$monthName $year</caption>
							<tr>
				";

  foreach($daysOfWeek as $day) {
    $calendar .= "<th class='header'>$day</th>";
  }

  $currentDay = 1;

  $calendar .= "</tr><tr>";

  if ($dayOfWeek > 0) {
		$calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
  }

  $month = str_pad($month, 2, "0", STR_PAD_LEFT);

  while ($currentDay <= $numberDays) {

    if($dayOfWeek == 7) {

      $dayOfWeek = 0;
      $calendar .= "</tr><tr>";

    }

    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

    $today = date('Y-m-d');
    $date = date('Y-m-d', strtotime("$year-$month-$currentDayRel"));

    $todayClass = 'today';
		$dayClass = 'day';

    if($date === $today){

			$getEventsToday = getToday($today);

			if(empty($getEventsToday) || !is_array($getEventsToday)){

				$calendar .= "<td class='day today' rel='$date'>$currentDay</td>";

			}else{
				$events = '';
				foreach ($getEventsToday as $key => $value) {
					$events .= "<br><span>" . $getEventsToday[$key] . "</span>";
				}

				$calendar .= "<td class='day today' rel='$date'>$currentDay $events</td>";

			}


    }else{

			$calendar .= "<td class='$dayClass' rel='$date'>$currentDay";
	    $checkDatesql = "SELECT * FROM `daty` WHERE `data` = '$date'";

	    if($resultCheck = $conn->query($checkDatesql)){

	      if($resultCheck->num_rows < 1){
	        $calendar .= "</td>";
	      }

	      while ($rowCheck = $resultCheck->fetch_assoc()) {

	        $eventId = $rowCheck['id_wydarzenia'];
	        $getEventsql = "SELECT * FROM `wydarzenia` WHERE `id` = '$eventId'";

	        if($resultEvent = $conn->query($getEventsql)){

	          while($rowEvent = $resultEvent->fetch_assoc()){

	            $eventName = $rowEvent['nazwa_wydarzenia'];

	            $calendar .= "<br><span>$eventName</span>";

						}

	        }

	      }

	    }

	    $calendar .= "</td>";

		}

    $currentDay++;
    $dayOfWeek++;

  }

  if($dayOfWeek != 7) {

    $remainingDays = 7 - $dayOfWeek;
    $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";

  }

  $calendar .= "</tr>";

  $calendar .= "</table>";

  $todaysDate = date($year.'-'.$month.'-1');

  // $calendar .= "<a class='btn btn-light prevMonth' data-month='' data-year='' href='http://localhost/kalendarz/" . basename($_SERVER["SCRIPT_FILENAME"]) . "?month=". (date('m', strtotime($todaysDate.' -1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' -1 month'))) ."'>Poprzedni</a>";
  // $calendar .= "<a class='btn btn-light nextMonth' data-month='' data-year='' href='http://localhost/kalendarz/" . basename($_SERVER["SCRIPT_FILENAME"]) . "?month=". (date('m', strtotime($todaysDate.' +1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' +1 month'))) ."'>Nastepny</a>";


  $calendar .= "<a class='btn btn-light prevMonth' data-month='" . (date('m', strtotime($todaysDate.' -1 month'))) . "' data-year='". (date('Y', strtotime($todaysDate.' -1 month'))) . "' href='#'>Poprzedni</a>";
  $calendar .= "<a class='btn btn-light nextMonth' data-month='" . (date('m', strtotime($todaysDate.' +1 month'))) . "' data-year='". (date('Y', strtotime($todaysDate.' +1 month'))) . "' href='#'>Nastepny</a>";

  echo $calendar;

}

function getToday($date){

	require 'database.php';
	$date = date('Y-m-d', strtotime($date));
	$day = date('j', strtotime($date));
	$r = '';

	$checkDatesql = "SELECT * FROM `daty` WHERE `data` = '$date'";
	if($resultCheck = $conn->query($checkDatesql)){

		if($resultCheck->num_rows < 1){
			return "<td class='day today' rel='$date'>$day</td>";
		}
		$r = [];
		while ($rowCheck = $resultCheck->fetch_assoc()) {

			$eventId = $rowCheck['id_wydarzenia'];
			$getEventsql = "SELECT * FROM `wydarzenia` WHERE `id` = '$eventId'";

			if($resultEvent = $conn->query($getEventsql)){

				while($rowEvent = $resultEvent->fetch_assoc()){
					$r[] = $rowEvent['nazwa_wydarzenia'];
					$eventName = $rowEvent['nazwa_wydarzenia'];

				}

			}

		}

		return $r;

	}
}

// createCalendar($month, $year);

if(!empty($_GET['table']) && $_GET['table'] === "getTable"){
  createCalendar($month, $year);
}