<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$eloquent = new Eloquent();
$arr = array();

$name = $_POST['customer_name'];
$phone = $_POST['customer_phone'];
$address = $_POST['customer_address'];
$pass_current = $_POST['customer_pass_current'];
$npass = $_POST['customer_npass'];
$cpass = $_POST['customer_cpass'];

if ($name == "") {
    $arr = ["type" => "no_name"];
    echo json_encode($arr);
    exit();
} else if ($phone == "") {
    $arr = ["type" => "no_phone"];
    echo json_encode($arr);
    exit();
} else if ($address == "") {
    $arr = ["type" => "no_address"];
    echo json_encode($arr);
    exit();
}

if ($npass == "" && $cpass == "") {
    $_SESSION['SSCF_login_user_name'] = $name;
    $_SESSION['SSCF_login_user_mobile'] = $phone;
    $_SESSION['SSCF_login_user_address'] = $address;

    $tableName = "customers";
    $columnValue = [
        "customer_name" => $_SESSION['SSCF_login_user_name'],
        "customer_mobile" => $_SESSION['SSCF_login_user_mobile'],
        "customer_address" => $_SESSION['SSCF_login_user_address'],
        "updated_at" => date("Y-m-d H:i:s")
    ];
    $whereValue = [
        "id" => $_SESSION['SSCF_login_id']
    ];
    $updateCustomer = $eloquent->updateData($tableName, $columnValue, $whereValue);
    if ($updateCustomer > 0) {
        $arr = [
            "type" => "success_info",
            "name" => $_SESSION['SSCF_login_user_name'],
        ];
        echo json_encode($arr);
        exit();
    } else {
        $arr = ["type" => "error"];
        echo json_encode($arr);
        exit();
    }
} else {
    if ($pass_current == "") {
        $arr = ["type" => "no_pass_current"];
        echo json_encode($arr);
        exit();
    } else if ($pass_current != $_SESSION['SSCF_login_user_password']) {
        $arr = ["type" => "no_match_pass_current"];
        echo json_encode($arr);
        exit();
    } else if ($npass == "") {
        $arr = ["type" => "no_npass"];
        echo json_encode($arr);
        exit();
    } else if ($cpass == "") {
        $arr = ["type" => "no_cpass"];
        echo json_encode($arr);
        exit();
    } else if ($npass != $cpass) {
        $arr = ["type" => "no_match"];
        echo json_encode($arr);
        exit();
    } else {
        $_SESSION['SSCF_login_user_name'] = $name;
        $_SESSION['SSCF_login_user_password'] = $npass;
        $_SESSION['SSCF_login_user_mobile'] = $phone;
        $_SESSION['SSCF_login_user_address'] = $address;

        $tableName = "customers";
        $columnValue = [
            "customer_name" => $_SESSION['SSCF_login_user_name'],
            "customer_password" => sha1($_SESSION['SSCF_login_user_password']),
            "customer_mobile" => $_SESSION['SSCF_login_user_mobile'],
            "customer_address" => $_SESSION['SSCF_login_user_address'],
            "updated_at" => date("Y-m-d H:i:s")
        ];
        $whereValue = [
            "id" => $_SESSION['SSCF_login_id']
        ];
        $updateCustomer = $eloquent->updateData($tableName, $columnValue, $whereValue);
        if ($updateCustomer > 0) {
            $arr = [
                "type" => "success_password",
                "name" => $_SESSION['SSCF_login_user_name'],
                "pass" => $_SESSION['SSCF_login_user_password'],
            ];
            echo json_encode($arr);
            exit();
        } else {
            $arr = ["type" => "error"];
            echo json_encode($arr);
            exit();
        }
    }
}
