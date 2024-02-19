<?php 
//this file for ajax only add/remove tasks 
include('../db/pdo.php');

session_start();


// Tasks class start
class Tasks{
    function add($task, $userId){
        global $conn;

        // create table for accounts
        try {

            // $conn->query("use app1");
            $sql = "INSERT INTO tasks (text, userId) VALUES (:text, :userId)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['text' => $task, 'userId' => $userId]);
            
            // get the last TaskID for put it in a new div for delete
            $stmt = $conn->prepare("SELECT MAX(taskId) as taskId FROM `tasks` WHERE userId = :userId");
            $stmt->execute(['userId' => $userId]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // send the last
            print_r( $stmt->fetch()['taskId']);
            
            
            
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }
    function remove($taskId){
        global $conn; 
        try {
            $sql = "DELETE FROM tasks WHERE taskId = :taskId";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['taskId' => $taskId]);
        } catch (\Throwable $th) {
            echo 'err';
        }
        // echo $taskId;
    }
    function toggleCheck($taskId){
        global $conn;
        try {
            $sql = "UPDATE `tasks` SET `complete` = NOT complete Where taskId = :taskId ";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['taskId' => $taskId]);
        } catch (\Throwable $th) {

        }

    }
}
// Tasks class End


$tasks = new Tasks();

// check if the user is alredy signed in
if (isset($_SESSION['userId'])) {
    
    // check if ajax sends the taskName for adding
    if (isset($_POST['taskName'])) {
        $tasks->add($_POST['taskName'], $_SESSION['userId']);
        
        
    }
    // remove the task with taskID
    elseif (isset($_POST['taskIdForRemove'])) {

        $tasks->remove($_POST['taskIdForRemove']);
    }
    // toggle complete task
    elseif (isset($_POST['taskIdToggleComplete'])) {
        $tasks->toggleCheck($_POST['taskIdToggleComplete']);
    }
    
}




?>