<?php
$tableTmpDays = ["Nie", "Pon", "Wto", "Śro", "Czw", "Pt", "Sob"];
$tableTop =
      "
        <div style='overflow-x:auto;'>
          <table class='calendar table table-bordered'>
            <thead>
              <tr>";
                foreach ($tableTmpDays as $day) {
                  $tableTop .= "<th>$day</th>";
                }
$tableTop .=
      "
              </tr>
            </thead>
            <tbody>
            <tr>
      ";

$tableBot =
      "
          </table>
        </div>
      ";



$tableTmp = array('tableTop' => $tableTop, 'tableBot' => $tableBot);


?>
