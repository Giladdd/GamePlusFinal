<?php
  include 'db.php';
  include 'config.php';

  session_start();
  if(!isset($_SESSION["user_id"]))
  {
      header('Location:' . 'index.php');
  }

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">

    <title>Object</title>

</head>

<body class="fullPage">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="home.php"><img src="./images/logo_transparent.png" alt="logo"
                    class="d-inline-block align-text-top"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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

    <h1 class="hone">Find Your Teammate!</h1>
    <h2>Most Popular Games Right Now</h2>


    <section>
        <div class="wrapper">

            <?php 
                $query = "SELECT * FROM tbl_204_game WHERE popularity = 1";
                $result = mysqli_query($connection, $query);
                

                while($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="gamepage.php?game_id='.$row["game_id"] .'">';
                    echo '<img src="'.$row["game_picture"] .'" alt="'.$row["game_name"] . '">';
                    echo '<p>'.$row["game_name"] .'</p>' ;
                    echo '</a>';
                }
            ?>
        </div>

    </section>


    <footer>
        <article>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
            <a href="#">Contact us</a>
        </article>
        <div>
            <a href="#" class="logo">
                <img src="./images/logo_transparent.png" alt="logo">
            </a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>


</html>

<?php
mysqli_close($connection);
?>