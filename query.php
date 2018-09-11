<?php

  // Add param. : q=detail, index
  // Check param : tbname, uid
  include_once 'utils.php';

  if(check_param('tbname')){
    $dbname = strtolower($_GET["tbname"]);
  }else{
    return;
  }

  // EPD : Adapt to OLD data format (deprecated?)
  if($dbname != "mrpc"){
    $DATA_DIR = './DATA/';
    $file = $DATA_DIR . $_GET['tbname'] . '.json';
    $data = json_decode(file_get_contents($file), true);
    echo json_encode($data);
    return;
  }

  // Link to MySQL database server
  $servername = "localhost";
  $username = "webview";
  $password = '9u3$T';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection Error : " . $conn->connect_error);
  }

  $result=array();

  if(check_param('uid')){
    // Query for detail
    $uid = $_GET['uid'];
    $tables=array("main","qa","test","track");
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
  }else{
    $sql = "SELECT * FROM `main` WHERE 1";
    $query = $conn->query($sql);
    if ($query->num_rows > 0){
      while($row = $query->fetch_assoc()){
        array_push($result,$row);
      }// More than 1 lines.
    }// Query success.
  }

  echo json_encode($result);

  $conn->close();
?>
