<?php

require_once('database.php');
$conn->query("TRUNCATE TABLE `daty`");
$conn->query("TRUNCATE TABLE `wydarzenia`");

header("Location: http://localhost/kalendarz/");
