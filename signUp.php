<?php 

include('inc/header.php');



if (isset($_SESSION['userId'])) {
    header("Location: index.php"); 
}

if(isset($_SESSION['err'])){
    unset($_SESSION['err']);
}

// post data
if(isset($_POST['submit'])){
    // user login info for check
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rePass = $_POST['rePassword'];
    // $agremnt = $_POST['agremnt'] == 'on';

    // email, password check
    if($sign->validate($email, $pass, $rePass)){
        // check if the user agreed on tearms and contions
        if (isset($_POST['agremnt'])) {
            $sign->signUp($email, $pass);
            
        }
        else{
            $_SESSION['err'] = 'you must agree on tearms and condtions';
        }
        // make account
        
    }
 }

?>
<body>

    <div class="containerOfSign">

        <form class='signForm w50' id='signUp' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h1 class='signHeading'>sign up</h1>

            <p class="w50 <?php if(isset($_SESSION['err'])) echo 'err'?> radius10px"><?php if(isset($_SESSION['err'])) echo $_SESSION['err']; ?></p>
    
            <!-- <label for="email">Email</label> -->
            <input class='paddingForInput h35px inputs radius10px focusInput' type="email" name="email" id="emailInput" placeholder='email' required>
    
            <!-- <label for="password">password</label> -->
            <input class='paddingForInput h35px inputs radius10px focusInput' type="password" name="password" id="passwordInput" placeholder='password' required>
            
            <!-- <label for="rePassword">re-password</label> -->
            <input class='paddingForInput h35px inputs radius10px focusInput' type="password" name="rePassword" id="rePasswordInput" placeholder='re-password' required>

            <div class="checkboxWithLabel">
                <input type="checkbox" name="agremnt" id="" required>
                <label for="agremnt">agree on tearms and contions</label>
            </div>
    
            <input class='h35px inputs radius10px' type="submit" name='submit' value="sign up">
            <p class="forLink">have an account? <a href="signIn.php">sign up</a></p>
        </form>


        <div class="imgContainerOfSign w50">
            <img class='imgBG centerAbsolute' src="<?php echo htmlspecialchars($imgFile . 'signImgBG.svg') ?>" alt="">
            <img class='signImg centerAbsolute' src="<?php echo htmlspecialchars($imgFile . 'signImg.svg') ?>" alt="" srcset="">
        </div>

    </div>



    <?php include('inc/footer.php'); ?>
