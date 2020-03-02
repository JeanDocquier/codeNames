<!DOCTYPE html>
<?php session_start() ?>
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
        <form class="choix_role" method="post" action="game.php">
            <input type="radio" name="role" id="playerOne" value="playerOne">
            <label for="playerOne">Faire deviner les mots</label>
            <input type="radio" name="role" id="playerTwo" value="playerTwo">
            <label for="playerTwo">Deviner les mots</label>
            <input type="hidden" name="newgame" value="<?php echo $_POST['newgame'];?>">
            <input type="hidden" name="partieid" value="<?php echo $_POST['partieid'];?>">
            <button class="nouvelle_partie">Commencer partie</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="js/custom.min.js"></script>
</body>

</html>
