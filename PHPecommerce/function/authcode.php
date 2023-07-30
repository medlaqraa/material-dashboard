<?php

session_start();
include_once '../config/dbcon.php';
include 'myfunctions.php';

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $c_password = mysqli_real_escape_string($con, $_POST['c_password']);

    //Checking if email is already taken
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        $_SESSION['message'] = "Email is already taken";
        header('location:../register.php');
    } else {
        if ($password == $c_password) {
            //Insert user into database
            $sql = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['message'] = "Registered Successfully";
                header('location:../index.php');
            } else {
                $_SESSION['message'] = "Something went wrong";
                header('location:../register.php');
            }
        } else {
            $_SESSION['message'] = "Password do not match !!!";
            header('location:../register.php');
        }
    }
} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['auth'] = true;

        $userdata   =   mysqli_fetch_array($result);
        $username   =   $userdata['name'];
        $useremail  =   $userdata['email'];
        $role_as    =   $userdata['role_as'];


        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail
        ];

        $_SESSION['role_as']    =   $role_as;

        if ($role_as == 1) {
            redirect("../admin/index.php","Welcome To Admin Panel");
            //$_SESSION['message'] = "Welcome To Admin Panel";
            //header('location:../admin/index.php');
        }else{
            redirect("../index.php","Logged In Successfully");
            //$_SESSION['message'] = "Logged In Successfully";
            //header('location:../index.php');
        }

        

        //$_SESSION['email'] = $email;
        //header('location:../index.php');
    } else {
        redirect("../login.php","Invalid Credentials");
        //$_SESSION['message'] = "Invalid Credentials";
        //header('location:../login.php');
    }
}
