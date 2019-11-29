<?php
    $conn = mysqli_connect("localhost","root","10725544","pumpmon");
    /***********************************************************/
    /* function PartMngDBAdd                                   */
    /***********************************************************/
    function PartMngDBAdd($connl = '')
    {
      /********************************************************/
      /* Add SQL                                              */
      $sql = "
          INSERT INTO PartMng (
              PartMngUnit,
              PartMngPartName
            ) VALUES (
              'Pump',
              'Plunger'
      )";
      $result = mysqli_query($connl,$sql);
      if( $result === false){
          echo mysqli_error($connl);
      }
      /********************************************************/
    }
    /***********************************************************/
    /***********************************************************/
    /* function PartMngDBDel                                   */
    /***********************************************************/
    function PartMngDBDel($connl = '')
    {
      /********************************************************/
      /* Delete SQL                                           */
      $sql = "select * from partmng";
      $result = mysqli_query($connl,$sql);

      $row = mysqli_fetch_array($result);
      $sql = "
          DELETE
              FROM PartMng
              WHERE idPartMng = {$row['idPartMng']}
      ";
      $result = mysqli_query($connl,$sql);
      if( $result === false){
          echo mysqli_error($connl);
      }
      /********************************************************/
    }
    /***********************************************************/
?>
<!doctype html>
<html>
    <head>
        <title>SAMBO MONITORING</title>
        <meta charset="utf-8">
        <style>
              body {
                  margin: 0px;
              }
              h1 {
                  font-size: 45px;
                  text-align: center;
                  /*border-bottom: 1px solid gray;*/
                  width: 1200px;
                  margin: 0px;
                  padding: 20px;
                }
              ul {
                  border-right: 1px solid gray;
                  width: 100px;
                  margin: 0px;
                  padding: 20px;
              }
              #grid {
                  border-top: 1px solid gray;
                  display: grid;
                  grid-template-columns: 150px 1fr;
              }
              .btn-group .button {
                background-color: #4CAF50; /* Green */
                border: 1px solid green;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                float: left;
                width: 25%;
              }

              .btn-group .button:not(:last-child) {
                border-right: none; /* Prevent double borders */
              }

              .btn-group .button:hover {
                background-color: #3e8e41;
              }
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- Table Chart -->
        <script type="text/javascript">
          google.charts.load('current', {'packages':['table']});
          google.charts.setOnLoadCallback(drawTable);
          var data;
          var table
          function drawTable() {
            data = new google.visualization.DataTable();
            data.addColumn('string', 'Unit');
            data.addColumn('string', 'Part Name');
            data.addColumn('string', 'Part Life Time(hour)');
            data.addColumn('string', 'Recent Repair Date');
            data.addColumn('string', 'Used Time(hour)');
            data.addColumn('string', 'Remaining Time(hour)');
            data.addColumn('string', 'Recommand Repair Date');
            data.addColumn('boolean', 'Repair Check');
            /*
            data.addRows([
              ['Pump', 'Plunger',  {v: 10000, f: '10,000'}, {v: 10000, f: '10,000'}, '2019.08.12', true],
              ['Pump', 'Packing',   {v:8000,   f: '8,000'}, {v: 1000, f: '1,000'}, '2019.09.12', false],
              ['Pump', 'Discharge valve', {v: 12500, f: '12,500'}, {v: 5000, f: '5,000'}, '2019.06.12', true],
              ['Pump', 'Backup Ring',   {v: 7000,  f: '7,000'}, {v: 6000, f: '6,000'}, '2019.04.13', true],
              ['Pump', 'Suction Valve',  {v: 10000, f: '10,000'}, {v: 2000, f: '2,000'}, '2019.04.12', true],
              ['Pump', 'Throught Bushing',   {v:8000,   f: '8,000'}, {v: 2020, f: '2,020'}, '2019.11.12', false],
              ['Pump', 'Valve Seat', {v: 12500, f: '12,500'}, {v: 9080, f: '9,080'}, '2019.04.12', true],
              ['Engine', 'Fuel Filter',   {v: 7000,  f: '7,000'}, {v: 8050, f: '8,050'}, '2019.08.14', true],
              ['Engine', 'Oil Cleaner',  {v: 10000, f: '10,000'}, {v: 10000, f: '10,000'}, '2019.08.15', true]
            ]);

            data.addRow(
              ['Pump', 'Plunger',  {v: 10000, f: '10,000'}, {v: 10000, f: '10,000'}, '2019.08.12', true]
            );
            */
            <?php
                $sql = "select * from partmng";
                $result = mysqli_query($conn,$sql);

                while ($row = mysqli_fetch_array($result)) {
                    $sidPartMng = $row['idPartMng'];
                    $sPartMngUnit = $row['PartMngUnit'];
                    $sPartMngPartName = $row['PartMngPartName'];
                    $sPartMngLifeTime = $row['PartMngLifeTime'];
                    $sPartMngRecentRepartDate = $row['PartMngRecentRepartDate'];
                    $sPartMngUsedTime = $row['PartMngUsedTime'];
                    $sPartMngRemainTime = $row['PartMngRemainTime'];
                    $sPartMngRecmdRepairDate = $row['PartMngRecmdRepairDate'];
                    $sPartMngRepairCheck = $row['PartMngRepairCheck'];
                    $filtered = array(
                      'idPartMng' => htmlspecialchars($sidPartMng),
                      'PartMngUnit' => htmlspecialchars($sPartMngUnit),
                      'PartMngPartName' => htmlspecialchars($sPartMngPartName),
                      'PartMngLifeTime' => htmlspecialchars($sPartMngLifeTime),
                      'PartMngRecentRepartDate' => htmlspecialchars($sPartMngRecentRepartDate),
                      'PartMngUsedTime' => htmlspecialchars($sPartMngUsedTime),
                      'PartMngRemainTime' => htmlspecialchars($sPartMngRemainTime),
                      'PartMngRecmdRepairDate' => htmlspecialchars($sPartMngRecmdRepairDate),
                      'PartMngRepairCheck' => htmlspecialchars($sPartMngRepairCheck),
                    );
            ?>
                    var PartMngUnit = '<?= $filtered['PartMngUnit'] ?>';
                    var PartMngPartName = '<?= $filtered['PartMngPartName'] ?>';
                    var PartMngLifeTime = '<?= $filtered['PartMngLifeTime'] ?>';
                    var PartMngRecentRepartDate = '<?= $filtered['PartMngRecentRepartDate'] ?>';
                    var PartMngUsedTime =  '1000';
                    var PartMngRemainTime = '1000';
                    var PartMngRecmdRepairDate = '2019-10-15';
                    var PartMngRepairCheck = 'true';
                    data.addRow(
                      [PartMngUnit, PartMngPartName,  PartMngLifeTime, PartMngRecentRepartDate,
                      PartMngUsedTime, PartMngRemainTime, PartMngRecmdRepairDate, true]
                    );
            <?php
                }
            ?>
            table = new google.visualization.Table(document.getElementById('table_div'));

            table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
          }

          function addRowTable() {
            data.addRows([
              ['Pump', 'Plunger',  {v: 10000, f: '10,000'}, {v: 10000, f: '10,000'}, '2019.08.12', true],
            ]);
            table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
          }
        </script>
    </head>
    <body>
        <table class="columns">
            <tr>
              <td><img src="images/Sambo-Logo_WJ3_web-200x66.png" alt="My Image" width="200" height="66"></td>
              <td><h1>PUMPMON</h1></td>
            </tr>
        </table>
        <div id="grid">
          <ul>
              <li>Pump #1</li>
              <li>Pump #2</li>
              <li>Pump #3</li>
              <li>Pump #4</li>
          </ul>
          <div>
              <div class="btn-group">
                <button class="button"><a href="index.html">Overview</a></button>
                <button class="button"><a href="PrdtMon.html">Product Monitoring</a></button>
                <button class="button"><a href="PartMng.php">Part Management</a></button>
                <button class="button"><a href="EventMng.html">Event Management</a></button>
              </div>
              <!--------------------------------------------------------------->
              <!-- Part Mangement Section-------------------------------------->
              <!--------------------------------------------------------------->
              <table class="columns">
                  <tr>
                    <td>
                      <div id="partTitle_div" style="border: 1px solid #ccc; background-color:DodgerBlue; color:white; width: 1360px; height: 28px; text-align: center;">
                        Part Management
                      </div>
                    </td>
                  </tr>
              </table>
              <div id="table_div" style="width: 1360px; height: 520px;"></div>
              <!--------------------------------------------------------------->

              <!--------------------------------------------------------------->
              <!-- Part Mangement Database ------------------------------------>
              <!--------------------------------------------------------------->
              <table class="columns">
                  <tr>
                    <td>
                      <div id="partTitle_div" style="border: 1px solid #ccc; background-color:DodgerBlue; color:white; width: 1360px; height: 28px; text-align: center;">
                        Part DataBase Management
                      </div>
                    </td>
                  </tr>
              </table>
              <table class="columns">
                  <tr>
                    <td>
                      <div id="PartDBAdd1_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 200px; height: 28px; text-align: center;">
                        Unit
                      </div>
                    </td>
                    <td>
                      <div id="PartDBAdd2_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 330px; height: 28px; text-align: center;">
                        Part Name
                      </div>
                    </td>
                    <td>
                      <div id="PartDBAdd3_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 200px; height: 28px; text-align: center;">
                        Part Life Time
                      </div>
                    </td>
                    <td>
                      <div id="PartDBAdd4_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 200px; height: 28px; text-align: center;">
                        Recent Repair Date
                      </div>
                    </td>
                    <td>
                      <div id="PartDBAdd5_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 200px; height: 28px; text-align: center;">
                        Used Time
                      </div>
                    </td>
                    <td>
                      <div id="PartDBAdd6_div" style="border: 1px solid #ccc; background-color:#000000; color:white; width: 200px; height: 28px; text-align: center;">
                        Repair Check
                      </div>
                    </td>
                  </tr>
              </table>
              <form action="PartMngDBAdd.php" method = "post">
                <table class="columns">
                <tr>
                  <td>
                    <input type="text" name="Unit" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 200px; height: 28px; text-align: center;"/>
                  </td>
                  <td>
                    <input type="text" name="ParName" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 330px; height: 28px; text-align: center;"/>
                  </td>
                  <td>
                    <input type="text" name="PartLifeTime" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 200px; height: 28px; text-align: center;"/>
                  </td>
                  <td>
                    <input type="text" name="RecentRepairDate" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 200px; height: 28px; text-align: center;"/>
                  </td>
                  <td>
                    <input type="text" name="UsedTime" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 200px; height: 28px; text-align: center;"/>
                  </td>
                  <td>
                    <input type="text" name="RepairCheck" style="border: 1px solid #ccc; background-color:#FFFFFF; color:black; width: 200px; height: 28px; text-align: center;"/>
                  </td>
                </tr>
                </table>
                <input type="hidden">
                <input type="submit" value = "Database Add" style="border: 3px solid #ccc; background-color:#e7e7e7; color:black; width: 100%; height: 35px; text-align: center;">
                echo "<p> PumpRpm : ".$_POST['PumpRpm']."</p>";
              </form>
                <form class="button" action="PartMngDBDel.php" method = "post">
                  <input type="hidden">
                  <input type="submit" value = "Database Delete" style="border: 3px solid #ccc; background-color:#e7e7e7; color:black; width: 100%; height: 35px; text-align: center;">
                </form>
              </div>
              <!--------------------------------------------------------------->
          </div>
        </div>
    </body>
</html>
