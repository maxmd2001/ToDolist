<?php 

// just get the tasks and show theme by userId
class Tasks{

    function get($id){
        global $conn;

        try {

            $stmt = $conn->prepare("SELECT * FROM tasks WHERE userId = :userId ORDER BY complete DESC");

            $stmt->execute(['userId' => $id]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();

        } catch (PDOException $th) {
            // $_SESSION['err'] = 'no';
        }         

    }
    
}


$tasks = new Tasks();




?>