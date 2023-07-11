<?php
    if(isset($_POST['delete']))
    {
        $connection=new mysqli("localhost","root","","carrentalportal");
        if($connection->connect_errno!=0)
        {
        echo("Connection Error");
        }
        $vehicleid=$_POST['vehicle_delete'];
        $sql="DELETE FROM crud WHERE vehicleid='$vehicleid'";
        if($result=$connection->query($sql))
        {
        header("location:read.php");
        }
        else{
        echo("Error");
        }
    }
?>