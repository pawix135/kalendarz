<?php
require_once 'php/kalendarz.php';

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.min.css">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.multidatespicker.css">
		<title>Kalendarz</title>
		<style>
			ul{
				list-style-type: none;
			}
			table{
				text-align: center;
				-webkit-touch-callout: none;
		    -webkit-user-select: none;
	     	-khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
				width: 100%;
				font-size: 1.1em;
			}

			th{
				padding: 20px;
				min-width: 100%;
			}

			td{
				min-width: 100%;
				padding: 15px;
			}

			.day:hover{
				background-color: rgb(70, 99, 203);
			}

			.dsb{
				pointer-events: none;
			}

			.event{
				background-color: rgba(88, 154, 208, 0.68);
			}
			.today{
				background-color: rgba(224, 35, 35, 0.68);
			}

			.today:hover{
				background-color: rgba(193, 30, 30, 1);
			}

		</style>
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php

						$kalendarz = new Kalendarz();
						// $kalendarz->build_calendar($month,$year,[]);

						// $dates = $kalendarz->getCalendar($month, $year);
						$t = $kalendarz->createCalendar(3, 2019);
						var_dump($t);
						var_dump($kalendarz->getCalendar(3, 2019));
						echo "<br>";

						// $kalendarz->createCalendar(3, 2019);

					?>
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
