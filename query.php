<?php

  // TODO: Integrate with EPD database

  // Add param. : q=detail, index
  // Check param : tbname, uid
  $dbname = $_GET["tbname"];
  $uid=$_GET["uid"];

  $servername = "localhost";
  $username = "root";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection Error : " . $conn->connect_error);
  }

  // For MRPC detail
  $tables=array("main","qa","test","track");
  $result=array();

  for($i=0;$i<count($tables);$i++){
    $tb=$tables[$i];
    $sql = "SELECT * FROM " . $tb . " WHERE uid=" . $uid;
    $query = $conn->query($sql);
    if ($query->num_rows > 0){
      // For table 'track', it maybe multiple entries
      if($tb=="track"){
        $result["track"]=array();
        while($row = $query->fetch_assoc()){
          array_push($result["track"],$row);
        }
      }else{
        $result[$tb]=$query->fetch_assoc();
      }
      if($tb=="test"){
        $sql_opt = "SELECT * FROM setup WHERE id=" . $result[$tb]["sid"];
        $setup = $conn->query($sql_opt);
        $result["setup"]=$setup->fetch_assoc();
        $result["setup"]["gas"] = json_decode($result["setup"]["gas"]);
        $result["setup"]["env"] = json_decode($result["setup"]["env"]);
      }
    }
  }
  echo json_encode($result);

  $conn->close();
?>
