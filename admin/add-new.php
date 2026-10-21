<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Doctor</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php


    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php"); exit;
        }

    }else{
        header("location: ../login.php"); exit;
    }
    
    

    include("../connection.php");



    if($_POST){
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select * from webuser where email='{$database->esc($email)}';");
            if($result->num_rows==1){
                $error='1';
            }else{

                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('{$database->esc($email)}','{$database->esc($name)}','{$database->esc($hash)}','{$database->esc($nic)}','{$database->esc($tele)}',{$database->int($spec)});";
                $sql2="insert into webuser values('{$database->esc($email)}','d')";
                $database->query($sql1);
                $database->query($sql2);

                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php'); exit;
        $error='3';
    }
    

    header("location: doctors.php?action=add&error=".$error); exit;
    ?>
    
   

</body>
</html>