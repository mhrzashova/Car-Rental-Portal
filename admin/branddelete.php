<?php
    if(isset($_POST['delete']))
    {
        $connection=new mysqli("localhost","root","","carrentalportal");
        if($connection->connect_errno!=0)
        {
        echo("Connection Error");
        }
        $brand_id=$_POST['brand_delete'];
        $sql="DELETE FROM brand WHERE brand_id='$brand_id'";
        if($result=$connection->query($sql))
        {
        header("location:brandread.php");
        }
        else{
        echo("Error");
        }
    }
?>