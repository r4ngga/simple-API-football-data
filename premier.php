<?php
include 'getfootball.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Premier Standing League</title>
    <link rel="icon" type="image/icon" sizes="16x16" href="assets/images/ball.png">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teams.php">Teams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="premier.php">Standings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container mt-2">
        <h4>Standings Football League </h4>
        <div class="row">
            <div class="col">
                <form method="POST" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" name="keywordsearch" placeholder="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
                <table class="table table-striped mt-2">
                    <?php
                    $api = new GetFootball();
                    if (isset($_POST['keywordsearch'])) {
                        $id = $_POST['keywordsearch'];
                        $team = $api->findStandingsByCompetition($id);
                    ?>
                        <tr>
                            Standings of <?php echo $team->competition->name;
                                            ?>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <th>Team</th>
                            <th>Goal Agg</th>
                            <th>Points</th>
                        </tr>
                        <?php
                        $no = 1;
                        foreach ($team->standings as $standing) {
                            if ($standing->type == 'TOTAL') {
                                foreach ($standing->table as $standingrows) {
                        ?>
                                    <tr>
                                        <td><?php echo $standingrows->position; ?></td>
                                        <td><?php echo $standingrows->team->name; ?></td>
                                        <td><?php echo $standingrows->goalDifference; ?></td>
                                        <td><?php echo $standingrows->points; ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                    } else {
                        ?>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Date of birth</th>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
        </div>

    </div>

</body>
<footer>

</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>