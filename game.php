        <?php 
session_start();

        if($_POST['newgame'] == "true"){
        include('initializePDO.php');
        }
        else{
        $_SESSION['gameIDtoload'] = $_POST['partieid']; 
        include('loadPDO.php');
        }
        ?>
