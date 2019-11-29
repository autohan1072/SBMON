<?php

    set_time_limit(0);
    date_default_timezone_set("Asia/Seoul");

    function test($testtick)
    {
      echo '5초마다 수행 : '.date('Y-m-d (H:i:s)').'<br />';
      $conn = mysqli_connect("localhost","root","10725544","pumpmon");

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
      echo "<p> EngnStp : ".$_POST['Alarm1']."</p>";
      echo "<p> EngnStp : ".$_POST['Alarm2']."</p>";
      /********************************************************/
      /* Add SQL                                              */
      $PrdtMonMonDate = date("Y/m/d H:i:s");
      $PrdtMonPumpRpm = rand(0,3000);
      $PrdtMonPumpPrs = rand(0,5000);
      $PrdtMonPumpFlw = rand(0,100);
      $PrdtMonPumpRun = $testtick+1006;
      $PrdtMonPumpIdl = $testtick+1007;
      $PrdtMonEngnRpm = rand(0,3000);
      $PrdtMonEngnTmp = rand(0,100);
      $PrdtMonEngnEul = rand(0,100);
      $PrdtMonEngnRun = $testtick+1008;
      $PrdtMonEngnIdl = $testtick+1009;
      $PrdtMonEngnStp = $testtick+1010;

      if($PrdtMonPumpRpm != NULL && $PrdtMonPumpPrs != NULL ){
        $sql = "
            INSERT INTO prdtmon (
                MonDate,
                PumpRpm,
                PumpPrs,
                PumpFlw,
                PumpRun,
                PumpIdl,
                EngnRpm,
                EngnTmp,
                EngnEul,
                EngnRun,
                EngnIdl,
                EngnStp
              ) VALUES (
                '$PrdtMonMonDate',
                '$PrdtMonPumpRpm',
                '$PrdtMonPumpPrs',
                '$PrdtMonPumpFlw',
                '$PrdtMonPumpRun',
                '$PrdtMonPumpIdl',
                '$PrdtMonEngnRpm',
                '$PrdtMonEngnTmp',
                '$PrdtMonEngnEul',
                '$PrdtMonEngnRun',
                '$PrdtMonEngnIdl',
                '$PrdtMonEngnStp'
        )";
        $result = mysqli_query($conn,$sql);
        if( $result === false){
            echo mysqli_error($conn);
        }

        $sql = "SELECT * FROM prdtmon ORDER BY idPrdtMon DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

      }
    }

    $chk_test2 = 0;
    $c = 1;
    while ($c<300)
    {
        //echo '기본 : '.date('Y-m-d (H:i:s)').'<br />';
        if ( $c%5==0 ){
          test($c); // 5초마다 후 실행
          $c++;
        }
        //flush();
        sleep(1); // 1초씩 지연
        $c++;
    }
    echo '종료 : '.date('Y-m-d (H:i:s)').'<br />';
    flush();
?>
