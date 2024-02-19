<?php 

include('inc/header.php');


// check if user has session login
if (!isset($_SESSION['userId'])) {
    header("Location: signIn.php"); 
}

// logout and delete sessions
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: signIn.php"); 
}



?>

<body>
    <!-- <p id="pForTest">chaow</p> -->
    
    <form id='taskForm' action="" method="POST">
        <input class='inputs' type="text" name="taskText" id='taskText' placeholder="enter the task...">
        <input id='taskSubmitInput' type="submit" name='submit'  value="add">
    </form>

    
    <div id="tasks">

            <?php 
                $userTasks = $tasks->get($_SESSION['userId']);
                // echo count($userTasks);

                // print_r($userTasks);
                if ($userTasks) {

                    // print_r( $userTasks[count($userTasks) - 1] );

                    foreach (array_reverse($userTasks) as $task) {
                        // echo $task['text'];
                 

            ?>
                <div class="task <?php if($task['complete']) echo 'opacity5' ?>" taskId='<?php echo $task['taskId'] ?>'>
                    <input class="checkTasksToggle " type="checkbox" name="taskCheck"  <?php if($task['complete']) echo 'checked' ?>>
                    <p><?php echo $task['text'] ?></p>
                    <button class='removeTask'>x</button>
                </div>
            <?php 
                    }
                }
            ?>
    </div>


    



<?php include('inc/footer.php'); ?>
