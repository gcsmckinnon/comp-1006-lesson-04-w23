<?php

    // Our super cool connection
    $conn = mysqli_connect("localhost", "root", "", "sakila", 3306);

    // Caching
    $total_count = isset($_COOKIE["total_film_count"]) ? $_COOKIE["total_film_count"] : 0;
    if ($total_count == 0) {
        // Get total record count
        $sql = "SELECT COUNT(film_id) FROM film";
        $result = mysqli_query($conn, $sql);
        $total_count = (int)(mysqli_fetch_row($result)[0]);
        setcookie("total_film_count", $total_count);
    }

    // Pagination
    $limit = 10;
    $page = (int)($_GET["page"] ?? 1);
    $offset = ($page * $limit) - $limit;

    // Build the SQL statement
    $sql = "SELECT * FROM film LIMIT {$limit} OFFSET {$offset}";

    // Fetch the rows
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Defaults
    $page_title = "Films Available to Rent";

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

        <table class="table table-striped table-dark table-bordered">
            <thead class="table-light">
                <tr class="align-middle text-center">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Year</th>
                    <th>Length (min)</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row["title"] ?></td>
                        <td><?= $row["description"] ?></td>
                        <td><?= $row["release_year"] ?></td>
                        <td><?= $row["length"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <nav>
                <?php
                $previous_enabled = $page > 1;
                $next_enabled = ($page * $limit) < $total_count;
                ?>
                <ul class="pagination">
                    <li class="page-item <?= $previous_enabled ? "" : "disabled" ?>"><a class="page-link" href="?page=<?= $previous_enabled ? $page - 1 : $page ?>">Previous</a></li>
                    <li class="page-item disabled"><span class="page-link" href="#"><?= $page ?></span></li>
                    <li class="page-item <?= $next_enabled ? "" : "disabled" ?>"><a class="page-link" href="?page=<?= $next_enabled ? $page + 1 : $page ?>">Next</a></li>
                </ul>
            </nav>
        </div>

    </body>

</html>