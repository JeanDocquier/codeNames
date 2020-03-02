        <?php 
session_start();
        $_SESSION['player'] = $_POST['role'];
        if($_POST['newgame'] == "true"){
        include('initializePDO.php');
        }
        else{
        $_SESSION['gameIDtoload'] = $_POST['partieid']; 
        include('loadPDO.php');
        }
        ?>
