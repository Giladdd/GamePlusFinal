<?php
  include "db.php";
  include "config.php";
?>

<?php
    session_start();
    if(!isset($_SESSION["user_id"]))
    {
        header('Location:' . 'index.php');
    }

    $query = "SELECT * FROM tbl_204_user WHERE user_name='"
    .  $_SESSION["user_name"]
    ."'";
    $result = mysqli_query($connection, $query);
    if($result){
        $row = mysqli_fetch_assoc($result);
    }
    else
    {
        die("The db query failed "); 
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="fullPage ">
    <a class=" logo" href="home.php"><img src="./images/logo_transparent.png" alt="logo"
            class="d-inline-block align-text-top"></a>
    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-dark"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="<?php echo $row['picture']; ?>" alt="Avatar" class="img-fluid my-5 myimg" />
                                <h5><?php echo "<strong>" . $row['user_name'] . "</strong>";?></h5>
                                <p><?php echo  "<strong>" . $row['country'] . "</strong>" ; ?></p>
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted"><?php echo "<strong>" . $row['email'] . "</strong>";?>
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Age</h6>
                                            <p class="text-muted">
                                                <?php echo  "<strong>" . $row['age'] . "</strong>" ; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>

</body>

</html>

<?php
mysqli_close($connection);
?>