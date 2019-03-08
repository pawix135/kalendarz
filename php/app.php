<?php
#App

require 'database.php';

if(!empty($_GET['getEvent'])){
    
    $getEvent = htmlentities($conn->real_escape_string($_GET['getEvent']));

    if($getEvent === 'getAll'){
        $sql = "SELECT * FROM `wydarzenia`";

        if($result = query($sql, $conn)){
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['nazwa_wydarzenia'];
                $startD = $row['data_rozpoczecia'];
                $endD = $row['data_zakonczenia'];
                $addD = $row['daty_dodatkowe'];
                $remD = $row['daty_przerw'];
                echo 
                    "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$startD</td>
                            <td>$endD</td>
                            <td>$addD</td>
                            <td>$remD</td>
                            <td class='text-center'>
                                <button class='btn btn-warning tableEditButton' data-edit='$id'>Edycja</button>
                                <button class='btn btn-danger tableRemoveButton' data-remove='$id'>Usuń</button>
                            </td>
                        </tr>          
                    ";
            }
        }

    }
}
if(!empty($_GET['edit']) && !empty($_GET['eventId'])){

    $edit = htmlentities($conn->real_escape_string($_GET['edit']));
    $eventId = htmlentities($conn->real_escape_string($_GET['eventId']));

    if($edit == 'getData'){
        $sql = "SELECT * FROM `wydarzenia` WHERE `id` = '$eventId'";
        if($result = $conn->query($sql)){
            $r = [];
            while($row = $result->fetch_assoc()){
                $r[] = $row;
            }
            echo json_encode($r);
        }
    }else if($edit == 'editData'){
        $sql = "";
    }
}

function conn(){
    require 'database.php';
    return $conn;
}

function getTableNumRows($table){
    $conn = conn();
    return $conn->query("SELECT * FROM `$table`")->num_rows;
}

function query($sql, $conn){
    return $conn->query($sql);
}