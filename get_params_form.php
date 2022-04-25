<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Second form</title>
</head>

<body>
    <section>
        <?php
        $username = $_GET["username"];
        $email = $_GET["email"];
        $country = $_GET["country"];
        $age = $_GET["age"];
        $Rank = $_GET["Rank"];
        $image = $_GET["image"];


        echo "<h2> Good morning " . $username . "</h2> <br> <h3> your inserted data is:<br>" ."email: ". $email."<br>country: " . $country."<br>age: " . $age."<br>rank: " . $Rank." " . "</h3>";

        ?>
    </section>
</body>

</html>