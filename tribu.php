<?php
include "header.php";


  class Tribu {
    function get($json) {
        include 'connection.php';
        $json = json_decode($json, true);
        $sql = "SELECT * FROM tbltribu ORDER BY tribu_Id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $returnValue = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($conn); unset($stmt);
        return json_encode($returnValue);
    }
  
    function save($json){
        //{username:'pitok',password:'12345', fullname:'PItok Batolata'}
        include 'connection.php';
        $json = json_decode($json, true);
        $sql = "INSERT INTO tbltribu(tribu_Name) VALUES(:name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $json['name']);
        $stmt->execute();
        $returnValue = $stmt->rowCount() > 0 ? 1 : 0;
        unset($conn); unset($stmt);
        return json_encode($returnValue);
    }
  }


  $json = isset($_POST["json"]) ? $_POST["json"] : "0";
  $operation = isset($_POST["operation"]) ? $_POST["operation"] : "0";


  $tribu = new Tribu();
  switch($operation){
    case "get":
      echo $tribu->get($json);
      break;
    case "save":
      echo $tribu->save($json);
      break;
  }

