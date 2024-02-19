<?php 

session_start();

// make database 
// require('db/db.php')

// get PDO
require('db/pdo.php');

// get dir for css, js, imgs
include('vars.php');

// get main functions
include('inc/functions.php');

// get/ add/ remove tasks
include('inc/getTasks.php');

// make the database
// include('db/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php if(isset($title)) echo $title; else echo 'no title'; ?></title>

  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="<?php echo htmlspecialchars($cssFile . 'style.css') ?>">

</head>


<!-- if the user not signed in give them none signed nav without logout -->
<?php if (!isset($_SESSION['userId'])){ ?>
  <nav id='id' class="navNotSign">
    <p class='logo'>Logo</p>
  </nav>
  
<!-- if the user signed in give them signed nav with logout -->
<?php }else {?>
  <nav id='id' class="navSignIn">
    <div class="noting"></div>
    <p class='logo'>Logo</p>
    <form id='logout' action="" method="post">
      <input class='radius10px' type="submit" name='logout' value='logout'>
    </form>
  </nav>
<?php }?>