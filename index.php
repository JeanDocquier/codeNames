<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="css/styles.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <title>Code Names</title>

</head>

<body>

    <h1>CODE NAMES</h1>
    <div class="intro-wrapper">
        <form method="post" action="game.php">
            <input type="hidden" name="newgame" value="true">
            <button class="nouvelle_partie">Nouvelle partie</button>
        </form>
        <form method="post" action="game.php">

            <span class="entrer_partie">
               Charger ID partie existante : <input required name="partieid" type="number">
            </span>
            <input type="hidden" name="newgame" value="false">
            <button class="charger_partie">
                GO
            </button>
        </form>
        <button class="ajouter_mot">Ajouter un mot</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="js/custom.min.js"></script>
</body>

</html>
