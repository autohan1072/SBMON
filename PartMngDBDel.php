<?php
    $conn = mysqli_connect("localhost","root","10725544","pumpmon");
    /********************************************************/
    /* Delete SQL                                           */
    $sql = "select * from partmng";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($result);
    $sql = "
        DELETE
            FROM PartMng
            WHERE idPartMng = {$row['idPartMng']}
    ";
    $result = mysqli_query($conn,$sql);
    if( $result === false){
        echo mysqli_error($conn);
    }else{
        header('Location: PartMng.php');
    }
    /********************************************************/
?>
