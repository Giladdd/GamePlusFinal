<?php 
    include "db.php";
    include "config.php";

    session_start();
    if(!isset($_SESSION["user_id"]))
    {
        header('Location:' . 'index.php');
    }

    $game_id = $_GET["game_id"];


    $query4 = "SELECT * FROM tbl_204_user WHERE user_name='"
    .  $_SESSION["user_name"]
    ."'";
    $result4 = mysqli_query($connection, $query4);
    if($result4){
        $row4 = mysqli_fetch_assoc($result4);
    }
    else
    {
        die("The db query failed "); 
    }
  
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>register page</title>
</head>

<body class="fullPage">

    <?php 
        if(!empty($_POST["Submit"])) {
            $query = 'INSERT INTO tbl_204_user_in_game (user_id, game_id, rank, ign, user_picture) VALUES ('.$_SESSION["user_id"].', '.$game_id.', '.$_POST["rank"].', "'.$_POST["username"].'", "'.$_POST["image"].'")';
            mysqli_query($connection, $query);
            header('Location: '.'gamepage.php?game_id=' . $game_id);
        }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="home.php"><img src="./images/logo_transparent.png" alt="logo" class="d-inline-block align-text-top"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="home.php">Home</a>
                    <a class="nav-link" href="games.php">Games</a>
                    <a class="nav-link" href="#">Settings</a>
                    <a class="nav-link" href="#">About us</a>
                </div>
            </div>
            <a href="profile.php" class="profile">
                <img src="<?php echo $row4['picture']; ?>" alt="user">
                <p><?php echo "<strong>" . $row4['user_name'] . "</strong>";?></p>
            </a>
            <a href="logout.php">
                <button type="button" class="btn btn-danger">Log Out</button></a>    
        </div>
    </nav>

    <div id="wrapper_form">
        <h1>Add yourself to the list!</h1>
        <form action="#" method="POST" id="form">
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                        <label for="sector">User-name</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="rank" name="rank" placeholder="rank" step="1" min="1" max="150">
                        <label for="rank">Your Rank</label>
                    </div>
                </div>
            </div>
    
            <hr>
            <span>choose image:</span><br>
            <div class="form-check">
                <label class="form-check-label">
                    <img src="./images/ninjaRed.png" alt="Red" height="80px" width="80px">
                    Red Ninja
                    <input type="radio" name="image" value="./images/ninjaRed.png" class="form-check-input">
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <img src="./images/ninjaBlue.png" alt="blue" height="80px" width="80px">
                    Blue Ninja
                    <input type="radio" name="image" value="./images/ninjaBlue.png" class="form-check-input">
                </label>
            </div>

            <input type="submit" name="Submit" value="Submit" class="btn btn-dark" id="submit_button">
            <input type="button" value="Reset" class="btn btn-dark" id="reset_button">


        </form>
    </div>

    <footer>
        <article>
            <a href="# ">Facebook</a>
            <a href="# ">Twitter</a>
            <a href="# ">Instagram</a>
            <a href="# ">Contact us</a>
        </article>
        <div>
            <a href="# " class="logo ">
                <img src="./images/logo_transparent.png " alt="logo ">
            </a>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js " integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p " crossorigin="anonymous "></script>
    <script src="./js/script.js "></script>

</body>

</html>

<?php 
    mysqli_close($connection);
?>