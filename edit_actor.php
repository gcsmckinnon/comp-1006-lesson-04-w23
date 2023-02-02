<?php

    $conn = mysqli_connect("localhost", "root", "", "sakila", 3306);

    // Step 4: If there's a post, update the record
    if (isset($_POST["first_name"]) && isset($_POST["last_name"])) {
        $sql = "UPDATE actor SET
            first_name = '{$_POST["first_name"]}',
            last_name = '{$_POST["last_name"]}',
            last_update = NOW()
        WHERE actor_id = {$_GET["actor_id"]}";

        mysqli_query($conn, $sql);

        echo "Actor was updated successfully";
    }

    // Step 1: Fetch the actor to be edited
    $sql = "SELECT * FROM actor WHERE actor_id = {$_GET["actor_id"]}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "This actor doesn't exist";
        die();
    }

    // Defaults
    $page_title = "Actors in Our Films";

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>

        <title><?= $page_title ?></title>
    </head>

    <body class="container">
        <header class="my-5">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Movie Madness</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="./" class="nav-link">Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="./actors.php" class="nav-link">Actors</a>
                            </li>

                            <li class="nav-item">
                                <a href="./new_actor.php" class="nav-link">New Actor</a>
                            </li>

                            <li class="nav-item">
                                <a href="./find_actor.php" class="nav-link">Find Actor</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 class="display-1 text-center"><?= $page_title ?></h1>
        </header>

        <!-- Step 2: Make sure you post to the same page WITH the actor_id query parameter set -->
        <form action="<?= $_SERVER['PHP_SELF'] ?>?actor_id=<?= $row['actor_id'] ?>" method="post">
            <!-- Step 3: Set the value with the retrieved actor -->
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="Devon" value="<?= $row['first_name'] ?? "" ?>">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Devonston" value="<?= $row['last_name'] ?? "" ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </body>

</html>