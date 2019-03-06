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

class Kalendarz{

	function __construct(){
	}

	public function conn(){
		require 'database.php';
		$conn = new mysqli ('localhost', 'root', '', 'kalendarz');
		return $conn;
	}

	public function getDatesById($id){

		$conn = $this->conn();

	}

	public function build_calendar($month,$year,$dateArray) {

		$daysOfWeek = array('Nie','Pon','Wt','Sr','Czw','Pt','Sob');

		//Zwraca unixowy czas
		$firstDayOfMonth = mktime(0,0,0,$month,1,$year); //godzina, minuta, sekunda, miesiac, dzien, rok

		//Zwraca ilosc dni w miesiacu
		$numberDays = date('t',$firstDayOfMonth); //format, data

		//Zwraca tablice z informacjami
		$dateComponents = getdate($firstDayOfMonth); //info o pierwszym dniu miesiaca

		//Zwraca nazwę miesiaca po angielsku
		$monthName = $dateComponents['month']; //Nazwa miesiaca

		//Kalendarz
		$calendar = "<div style='overflow-x:auto;'><table class='calendar table table-bordered'>";
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
		$calendar .= "<thead><tr>
										<th>Ni</th>
										<th>Po</th>
										<th>Wt</th>
										<th>Śr</th>
										<th>Cz</th>
										<th>Pt</th>
										<th>So</th>
									</tr></thead>";
		$calendar .= "<caption>$monthName $year</caption>";
		$calendar .= "<tr>";

		//Zwraca 0-6
		$dayOfWeek = $dateComponents['wday']; //Dzien tygodnia

		//Wypisanie dni tygodnia
		$currentDay = 1;

		$calendar .= "</tr><tr>";

		//Umieszczenie daty w dobrym dniu tygodina(table)
		if ($dayOfWeek > 0) {
			$calendar .= "<td colspan='$dayOfWeek' class='dsb'>&nbsp;</td>";
		}

		$month = str_pad($month, 2, "0", STR_PAD_LEFT); //Dodaje 0 na poczatek po lewej stronie

		while ($currentDay <= $numberDays) {

			//Jesli "koniec" dni w tygodniu to stworz nowy tr
			if ($dayOfWeek == 7) {
				$dayOfWeek = 0;
				$calendar .= "</tr><tr>";
			}

			$today = date('Y-m-d'); //Dzisiejszy dzien

			$currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT); //Dodaje zera przez dzien

			$date = "$year-$month-$currentDayRel"; //Nowa data

			$eventDay = $this->getDateByDate($date);

			if($today === $date) { // Jesli jest dzisaj to dodaj klase

				$calendar .= "<td class='day today' rel='$date'>$currentDay</td>"; //Jeśli data = dzisiaj

			}else if($eventDay['data'] === $date){

				$calendar .= "<td class='day event' rel='$date'>$currentDay</td>"; //Jeśli jest event

			}else{

				$calendar .= "<td class='day' rel='$date'>$currentDay</td>"; //Else
				
			}

			$currentDay++;
			$dayOfWeek++;

		}

		//Umieszczenie dat w dobrych miejscach na koncu
		if ($dayOfWeek != 7) {

			$remainingDays = 7 - $dayOfWeek;
			$calendar .= "<td colspan='$remainingDays' class='dsb'>&nbsp;</td>";

		}

		$calendar .= "</tr></table></div>";

		$todaysDate = date($year.'-'.$month.'-1');

		$calendar .= "<a class='btn btn-light' href='http://localhost/kalendarz/index.php?month=". (date('m', strtotime($todaysDate.' -1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' -1 month'))) ."'>Poprzedni</a>";
		$calendar .= "<a class='btn btn-light' href='http://localhost/kalendarz/index.php?month=". (date('m', strtotime($todaysDate.' +1 month'))) ."&year=". (date('Y', strtotime($todaysDate.' +1 month'))) ."'>Nastepny</a>";

		echo $calendar;

	}

	public function getEventByDate($date){

		$conn = $this->conn();

		$Datessql = "SELECT * FROM `daty` WHERE `data` = '$date'";

		if($result = $conn->query($Datessql)){

			if($result->num_rows < 1){
				return;
			}

			while ($row = $result->fetch_assoc()) {
				$id = $row['id_wydarzenia'];
			}
		}

		if($resultt = $conn->query("SELECT * FROM `wydarzenia` WHERE `id` = '$id'")){

			if($resultt->num_rows < 1){
				return;
			}
			$r = [];
			while($roww = $resultt->fetch_assoc()) {
				$r[] = $roww;
			}
		}

		return $r;

	}

	public function getDateByDate($date){

		$conn = $this->conn();
		$sql = "SELECT * FROM `daty` WHERE `data` = '$date'";
		$res = [];

		if($result = $conn->query($sql)){

			if($result->num_rows < 1){
				return;
			}

			while ($row = $result->fetch_assoc()) {
				$res[] = $row;

			}
		}
		$conn->close();
		return $res[0];
	}

}
