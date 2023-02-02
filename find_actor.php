<?php

    $conn = mysqli_connect("localhost", "root", "", "sakila", 3308);

    // If there's a search passed, look it up using a handy SQL statement

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

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="input-group mb-3">
                <!-- Preset the value for the search -->
                <input type="text" class="form-control" name="search" placeholder="Devon Devonston" value="">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>

        <!-- Output the table from the actors.php IF there are a $rows array and there are more than zero rows in the array -->

    </body>

</html>