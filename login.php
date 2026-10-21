<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <style>

    </style>

    <title>Login</title>

</head>

<body>
    <?php

    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $_SESSION["date"] = $date;

    include("connection.php");


    // Returns true when $email exists in $table and the stored hash matches $password.
    function edoc_password_ok($db, $table, $emailcol, $pwcol, $email, $password)
    {
        $e = $db->esc($email);
        $res = $db->query("select $pwcol from $table where $emailcol='$e' limit 1");
        if (!$res || $res->num_rows != 1) {
            return false;
        }
        $hash = $res->fetch_assoc()[$pwcol];
        return password_verify($password, $hash);
    }

    $badLogin = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';

    if ($_POST) {

        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];

        $error = '<label for="promter" class="form-label"></label>';

        $result = $database->query("select usertype from webuser where email='{$database->esc($email)}' limit 1");
        if ($result && $result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];

            $loggedIn = false;
            if ($utype == 'p') {
                $loggedIn = edoc_password_ok($database, 'patient', 'pemail', 'ppassword', $email, $password);
                $target = 'patient/index.php';
            } elseif ($utype == 'a') {
                $loggedIn = edoc_password_ok($database, 'admin', 'aemail', 'apassword', $email, $password);
                $target = 'admin/index.php';
            } elseif ($utype == 'd') {
                $loggedIn = edoc_password_ok($database, 'doctor', 'docemail', 'docpassword', $email, $password);
                $target = 'doctor/index.php';
            }

            if ($loggedIn) {
                session_regenerate_id(true);
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = $utype;
                header('location: ' . $target); exit;
            }
            $error = $badLogin;
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
        }
    } else {
        $error = '<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>

    <div class="full-height">
        <center>
            <div class="container" style="height:100vh;">
                <table border="0" style="margin: 0;padding: 0;width: 80%;">

                    <tr>
                        <td>
                            <p class="header-text">Welcome Back!</p>
                        </td>
                    </tr>

                    <div class="form-body">
                        <tr>
                            <td>
                                <p class="sub-text">Login with your details to continue</p>
                            </td>
                        </tr>
                        <tr>
                            <form action="" method="POST">
                                <td class="label-td">
                                    <label for="useremail" class="form-label">Email: </label>
                                </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <label for="userpassword" class="form-label">Password: </label>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-td">
                                <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                            </td>
                        </tr>


                        <tr>
                            <td><br>
                                <?php echo $error ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" value="Login" class="login-btn btn-primary btn">
                            </td>
                        </tr>
                    </div>
                    <tr>
                        <td>
                            <br>
                            <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                            <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                            <br><br><br>
                        </td>
                    </tr>




                    </form>
                </table>

            </div>
        </center>
    </div>
</body>

</html>