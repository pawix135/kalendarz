<?php
require 'php/kalendarz.php';
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
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.min.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.multidatespicker.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/style.css">
		<title>Kalendarz</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
          <base href="http://localhost/kalendarz/" target="_blank">
					<?php echo createCalendar($month, $year);?>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-4">
					<span span>Dodanie</span>
					<form method="post" action="php/addEvent.php">
						<div class="form-group">
							<label>Nazwa</label>
							<input class="form-control" type="text" name="eventName">
						</div>
						<div class="form-group">
							<label>Start</label>
							<input class="form-control" type="date" name="startDate">
						</div>
						<div class="form-group">
							<label>Koniec</label>
							<input class="form-control" type="date" name="endDate">
						</div>
						<div class="form-group">
							<label>Daty do dodania</label>
							<input class="form-control" type="text" name="date-added" id="date-added" autocomplete='off'>
						</div>
						<div class="form-group">
							<label>Daty do usuniecia</label>
							<input class="form-control" type="text" name="date-removed" id="date-removed" autocomplete='off'>
						</div>
						<button class="btn btn-success" type="submit" name="addEvent">Dodaj</button>
					</form>
				</div>
				<div class="col-md-4">
					Edycja eventu
					<ul>
						<?php

						require 'php/getAllEvents.php';

						?>
					</ul>
				</div>
				<div class="col-md-4">
					<a href="http://localhost/kalendarz/php/tran.php">Czysc</a>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui-1.12.1/jquery-ui.min.js" charset="utf-8"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui.multidatespicker.js" charset="utf-8"></script>
		<script src="http://localhost/kalendarz/js/app.js" charset="utf-8"></script>
	</body>
</html>
