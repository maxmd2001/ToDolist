<?php 

include('inc/header.php');

if (isset($_SESSION['userId'])) {
    header("Location: index.php"); 
}

if(isset($_SESSION['err'])){
    unset($_SESSION['err']);
}



if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];


    // validate of user data 
    if($sign->validate($email, $pass)){
        try {

            $user = $sign->signInWIthEmail($email);
            
            // check if the email is exists
            if ($user) {
                                
                
                // check if the passwords are the same
                if (password_verify($pass,  $user['password'])) {

                    // make the user session
                    $_SESSION['userId'] = $user['id'];
                    header("Location: index.php");
                }else{
                    
                    $_SESSION['err'] = 'password or email is wrong';
                }

            }
            else{
                $_SESSION['err'] = 'password or email is wrong';

            }

        } catch (PDOException $th) {            
            $err= 'err can\'t sign up';
            // die($th);
        }

    }
}

?>

<body>

<div class="containerOfSign">

<form class='signForm w50' id='signUp' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <h1 class='signHeading'>sign up</h1>


    <form id='signIn' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <p class="<?php if(isset($_SESSION['err'])) echo 'err'?> radius10px"><?php if(isset($_SESSION['err'])) echo $_SESSION['err']; ?></p>

        <!-- <label for="email">Email</label> -->
        <input class='paddingForInput h35px inputs radius10px focusInput'  type="email" name="email" id="emailInput" placeholder='email'>

        <!-- <label for="password">password</label> -->
        <input class='paddingForInput h35px inputs radius10px focusInput'  type="password" name="password" id="passwordInput" placeholder='password'>
        
        <input class='h35px inputs radius10px'  type="submit" name='submit' value="sign up">
        <p class="forLink">have an account? <a href="signUp.php">sign up</a></p>
        </form>


        <div class="imgContainerOfSign w50">
            <img class='imgBG centerAbsolute' src="<?php echo htmlspecialchars($imgFile . 'signImgBG.svg') ?>" alt="">
            <img class='signImg centerAbsolute' src="<?php echo htmlspecialchars($imgFile . 'signImg.svg') ?>" alt="" srcset="">
        </div>

    </div>
    

<?php include('inc/footer.php'); ?>
