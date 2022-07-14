<?php
  include "config.php";
  include 'db.php';

  session_start();
  if(!empty($_POST["loginMail"])) {
    $query = "SELECT * FROM tbl_204_user WHERE email='"
    . $_POST["loginMail"]
    . "' and password = '"
    . $_POST["loginPass"]
    . "'";
    
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if(is_array($row)) {
      $_SESSION["user_id"] = $row["user_id"];
      $_SESSION["user_name"] = $row["user_name"]; 
      $_SESSION["is_admin"] = $row["is_admin"];

      header('Location:' . 'home.php');
    }

    else{
      $message = "Invalid email or password";
    }

    mysqli_close($connection);
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Log in!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="display login-color">
    <a class=" logo" href="index.html"><img src="./images/logo_transparent.png" alt="logo"
            class="d-inline-block align-text-top"></a>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your login and password!</p>

                            <form action="#" method="post" id="frm">
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                        name="loginMail">
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                        name="loginPass">
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
                            </form>
                        </div>

                        <div>
                            <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign
                                    Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
</body>

</html>