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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>List</title>

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

    <main class="row">
        <?php 
            $query = "SELECT * FROM tbl_204_game WHERE game_id=" . $game_id;
            $result = mysqli_query($connection ,$query);
            if (!$result) {
                die("DB query failed.");
              }
            $row = mysqli_fetch_assoc($result);
        ?>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" id="bread">
            <ol class="breadcrumb ml-5">
                <li class="breadcrumb-item text-body"><a href="games.php">Games</a></li>
                <li class="breadcrumb-item active"><?php echo '<a href="gamepage.php?game_id='.$game_id.'" > '.$row["game_name"].' </a>'?></li>
            </ol>
        </nav>

        <h1 class="col-12 col-md-8 fs-1 fw-bold hone">Looking for player</h1>
        <div class="col-12 col-md-8 fs-2 fw-bold">
            <img src="<?php echo $row["game_picture"] ?>" width="104" height="113" alt="fn">
            <?php echo $row["game_name"] ?> <br>
            <p>Description:
                <?php echo $row["game_description"] ?></p>
        </div>



        <section>
            <?php 
                $query2 = "SELECT * FROM tbl_204_user_in_game INNER JOIN tbl_204_user USING(user_id) WHERE game_id=". $game_id;
                $result2 = mysqli_query($connection ,$query2);
                if (!$result2) {
                    die("DB query failed.");
                  }

                if($_SESSION["is_admin"] == 1) {
                    echo '<a class="btn btn-secondary ml-5" href="editgame.php?game_id='.$game_id .'">Edit</a>';
                    echo '<a class="btn btn-danger" href="deletegame.php?game_id='.$game_id .'">Delete</a>';
                }
            ?>
            <table class="table table-hover table-light table-responsive caption-top  align-middle" id="tblSort">
                <caption class="fs-4 fw-bold">List of players</caption>
                <thead>
                    <tr class="table-dark  align-middle" height="80px">
                        <th scope="col">#</th>
                        <th scope="col" onclick="sortTable(0)">User-name</th>
                        <th scope="col" onclick="sortTable(1)">Country</th>
                        <th scope="col" onclick="sortTable(2)">Rank</th>
                        <th scope="col" onclick="sortTable(3)" class="dis-non">Age</th> 
                        <?php 
                            $query3 = "SELECT * FROM tbl_204_user_in_game INNER JOIN tbl_204_user USING(user_id) WHERE user_id=". $_SESSION["user_id"] . " AND game_id=". $game_id;
                            $result3 = mysqli_query($connection ,$query3);
                            if (!$result3) {
                                die("DB query failed.");
                              }
                            $row3 = mysqli_fetch_assoc($result3);
                            if(!$row3) {
                                echo' <th scope="col"><a href="register_form.php?game_id='.$game_id.'" class="btn btn-secondary">Add +</a></th>';
                            } else {
                                echo' <th scope="col"><a href="edit_form.php?game_id='.$game_id.'" class="btn btn-secondary">Edit</a></th>';
                            }
                        ?>
                        <!-- <th scope="col"><button type="button" class="btn btn-secondary fw-bolder" onclick="window.location.href='register_form.html'">Add +</button></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($row2 = mysqli_fetch_assoc($result2)) {
                            echo '<tr height="80px">';
                            echo '<th scope="row"><img src="'.$row2["user_picture"] .'" alt="blue" height="80px" width="80px"></th>';
                            echo '<td>'.$row2["ign"].'</td>';
                            echo '<td>'.$row2["country"].'</td>';
                            echo '<td>'.$row2["rank"].'</td>';
                            echo '<td class="dis-non">'.$row2["age"].'</td>';
                            if($row2["user_id"] == $_SESSION["user_id"]) {
                                echo '<td scope="col"><a href="delete_form.php?game_id='.$game_id.'" class="btn btn-danger">Delete</a></td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>





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
    <script src="./js/script.js "></script>
</body>


</html>

<?php 
    mysqli_close($connection);
?>