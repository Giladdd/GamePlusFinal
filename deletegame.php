<?php 
    include "db.php";
    include "config.php";

    session_start();

    $game_id = $_GET["game_id"];

    $query= 'DELETE FROM tbl_204_game WHERE game_id='.$game_id;
    mysqli_query($connection, $query);
    header('Location: '.'games.php');
    
    mysqli_close($connection);

?>