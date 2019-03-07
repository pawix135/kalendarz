<?php
function createCalendar($month,$year) {

  require 'database.php';

  $daysOfWeek = array('Nie','Pon','Wto','Sro','Czw','Ptk','Sob');

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

  $calendar = "<div style='overflow-x:auto;'><table class='table table-bordered'>";
  $calendar .= "<caption>$monthName $year</caption>";
  $calendar .= "<tr>";

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

    if($date){

      $todayClass = '';
			$dayClass = 'day';

      if($date === $today){
        $todayClass = 'today';
      }

      $calendar .= "<td class='$dayClass $todayClass' rel='$date'>$currentDay";
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

  $calendar .= "</table></div>";

  $todaysDate = date($year.'-'.$month.'-1');

  $calendar .= "<a class='btn btn-light' href='http://localhost/kalendarz/index.php?month=". (date('m', strtotime($todaysDate.' -1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' -1 month'))) ."'>Poprzedni</a>";
  $calendar .= "<a class='btn btn-light' href='http://localhost/kalendarz/index.php?month=". (date('m', strtotime($todaysDate.' +1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' +1 month'))) ."'>Nastepny</a>";


  return $calendar;

}
