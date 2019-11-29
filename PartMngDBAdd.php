<?php
    //file_put_contents('data/'.$_POST['Unit'], $_POST['ParName'], $_POST['UsedTime'], $_POST['RemainingTime'], $_POST['RecommandRepairDate'],$_POST['RepairCheck']);

    $conn = mysqli_connect("localhost","root","10725544","pumpmon");

    /********************************************************
    echo "<p> Unit : ".$_POST['Unit']."</p>";
    echo "<p> ParName : ".$_POST['ParName']."</p>";
    echo "<p> PartLifeTime : ".$_POST['PartLifeTime']."</p>";
    echo "<p> RecentRepairDate : ".$_POST['RecentRepairDate']."</p>";
    echo "<p> UsedTime : ".$_POST['UsedTime']."</p>";
    echo "<p> RepairCheck : ".$_POST['RepairCheck']."</p>";
    /********************************************************/
    /* Add SQL                                              */
    $PartMngUnit = $_POST['Unit'];
    $PartMngPartName = $_POST['ParName'];
    $PartLifeTime = $_POST['PartLifeTime'];
    $RecentRepairDate = $_POST['RecentRepairDate'];
    $UsedTime = $_POST['UsedTime'];

    if($PartMngUnit != NULL && $PartMngPartName != NULL ){
      $sql = "
          INSERT INTO PartMng (
              PartMngUnit,
              PartMngPartName,
              PartMngLifeTime,
              PartMngRecentRepartDate,
              PartMngUsedTime
            ) VALUES (
              '$PartMngUnit',
              '$PartMngPartName',
              '$PartLifeTime',
              '$RecentRepairDate',
              '$UsedTime'
      )";
      $result = mysqli_query($conn,$sql);
      if( $result === false){
          echo mysqli_error($conn);
      }
    }
    header('Location: PartMng.php');
    /********************************************************/
?>
