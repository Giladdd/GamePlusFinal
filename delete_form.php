<?php 
    include "db.php";
    include "config.php";

    session_start();

    $game_id = $_GET["game_id"];

    $query= 'DELETE FROM tbl_204_user_in_game WHERE game_id='.$game_id.' AND user_id='. $_SESSION["user_id"];
    mysqli_query($connection, $query);
    header('Location: '.'gamepage.php?game_id=' . $game_id);
    
    mysqli_close($connection);

?>