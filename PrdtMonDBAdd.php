<?php

    $conn = mysqli_connect("localhost","root","10725544","pumpmon");

    /********************************************************/
    /* Read SQL                                             */
    /********************************************************/
    $sql = "SELECT * FROM prdtmon ORDER BY idPrdtMon DESC LIMIT 1";
    $result = mysqli_query($conn,$sql);
    //echo "result : ".$result."</p>";
    $row = mysqli_fetch_array($result);

    /********************************************************
    echo "<p> PumpRpm : ".$_POST['PumpRpm']."</p>";
    echo "<p> PumpPrs : ".$_POST['PumpPrs']."</p>";
    echo "<p> PumpFlw : ".$_POST['PumpFlw']."</p>";
    echo "<p> PumpRun : ".$_POST['PumpRun']."</p>";
    echo "<p> PumpIdl : ".$_POST['PumpIdl']."</p>";
    echo "<p> EngnRpm : ".$_POST['EngnRpm']."</p>";
    echo "<p> EngnTmp : ".$_POST['EngnTmp']."</p>";
    echo "<p> EngnEul : ".$_POST['EngnEul']."</p>";
    echo "<p> EngnRun : ".$_POST['EngnRun']."</p>";
    echo "<p> EngnIdl : ".$_POST['EngnIdl']."</p>";
    echo "<p> EngnStp : ".$_POST['EngnStp']."</p>";
    /********************************************************/
    /* Add SQL                                              */
    date_default_timezone_set("Asia/Seoul");
    $PrdtMonMonDate = date("Y/m/d H:i:s");
    $PrdtMonPumpRpm = $_POST['PumpRpm'];
    $PrdtMonPumpPrs = $_POST['PumpPrs'];
    $PrdtMonPumpFlw = $_POST['PumpFlw'];
    $PrdtMonPumpRun = $_POST['PumpRun'];
    $PrdtMonPumpIdl = $_POST['PumpIdl'];
    $PrdtMonEngnRpm = $_POST['EngnRpm'];
    $PrdtMonEngnTmp = $_POST['EngnTmp'];
    $PrdtMonEngnEul = $_POST['EngnEul'];
    $PrdtMonEngnRun = $_POST['EngnRun'];
    $PrdtMonEngnIdl = $_POST['EngnIdl'];
    $PrdtMonEngnStp = $_POST['EngnStp'];
    $PrdtMonSysmSta = $_POST['SysmSta'];
    $PrdtMonErroCod = $_POST['ErroCod'];

    if($PrdtMonPumpRpm != NULL && $PrdtMonPumpPrs != NULL ){
      $sql = "
          INSERT INTO prdtmon (
              MonDate, PumpRpm, PumpPrs, PumpFlw, PumpRun, PumpIdl, EngnRpm,
              EngnTmp, EngnEul, EngnRun, EngnIdl, EngnStp, SysmSta, ErroCod
            ) VALUES (
              '$PrdtMonMonDate', '$PrdtMonPumpRpm', '$PrdtMonPumpPrs',
              '$PrdtMonPumpFlw', '$PrdtMonPumpRun', '$PrdtMonPumpIdl',
              '$PrdtMonEngnRpm', '$PrdtMonEngnTmp', '$PrdtMonEngnEul',
              '$PrdtMonEngnRun', '$PrdtMonEngnIdl', '$PrdtMonEngnStp',
              '$PrdtMonSysmSta', '$PrdtMonErroCod'
      )";
      $result = mysqli_query($conn,$sql);
      if( $result === false){
          echo mysqli_error($conn);
      }
    }
    /********************************************************/

    /********************************************************/
    /* Add SQL  (Event Log)                                 */
    /********************************************************/
    $r = strtotime($PrdtMonMonDate) - strtotime($row['MonDate']) ;
    if ( $PrdtMonSysmSta != $row['SysmSta'] or $PrdtMonErroCod != $row['ErroCod'] or $r > 100 ){
        echo ceil($r);
        //Check DisConnnect
        if ($r > 100) {
          $r = strtotime($row['MonDate'])+100;
          $DisConTime = $row['MonDate'];
          $DisConSysmSta = 0;
          $DisConErroCod = 0;
          $sql = "
              INSERT INTO EvntLog (
                  LogDate, SysmSta, ErroCod
                ) VALUES (
                  '$DisConTime', '$DisConSysmSta', '$DisConErroCod'
          )";
          $result = mysqli_query($conn,$sql);
          if( $result === false){
              echo mysqli_error($conn);
          }
        }
        //Event Log
        $sql = "
            INSERT INTO EvntLog (
                LogDate, SysmSta, ErroCod
              ) VALUES (
                '$PrdtMonMonDate', '$PrdtMonSysmSta', '$PrdtMonErroCod'
        )";
        $result = mysqli_query($conn,$sql);
        if( $result === false){
            echo mysqli_error($conn);
        }
    }
    /********************************************************/
?>
