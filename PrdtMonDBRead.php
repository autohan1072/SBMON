<?php

    $conn = mysqli_connect("localhost","root","10725544","pumpmon");

    $sql = "SELECT * FROM prdtmon ORDER BY idPrdtMon DESC LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    /********************************************************
    echo "idPrdtMon : ".$row['idPrdtMon'];
    echo "<p> MonDate : ".$row['MonDate'];
    echo "<p> PumpRpm : ".$row['PumpRpm'];
    echo "<p> EngnStp : ".$row['EngnStp'];
    echo "<p> ---------------------------";
    /********************************************************/
    $data = array(
      'idPrdtMon'=>$row['idPrdtMon'],
      'MonDate'=>$row['MonDate'],
      'PumpRpm'=>$row['PumpRpm'],
      'PumpPrs'=>$row['PumpPrs'],
      'PumpFlw'=>$row['PumpFlw'],
      'PumpRun'=>$row['PumpRun'],
      'PumpIdl'=>$row['PumpIdl'],
      'EngnRpm'=>$row['EngnRpm'],
      'EngnTmp'=>$row['EngnTmp'],
      'EngnEul'=>$row['EngnEul'],
      'EngnRun'=>$row['EngnRun'],
      'EngnIdl'=>$row['EngnIdl'],
      'EngnStp'=>$row['EngnStp'],
      'SysmSta'=>$row['SysmSta'],
      'ErroCod'=>$row['ErroCod']
    );
    echo json_encode($data);
?>
