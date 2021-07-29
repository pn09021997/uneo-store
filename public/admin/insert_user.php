<?php
require_once 'header-require-models.php';
?>
<?php
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['permission'])) {
    $insertResult = -1;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_Password = $_POST['password2'];
    $permission = $_POST['permission'];
    $flag = true;
    $validUsername = checkUsername($username);
    if ($validUsername !== true) {
        $flag = false;
    }
    $validPassword = checkPassword($password);
    if ($validPassword !== true) {
        $flag = false;  
    }
    if ($password == $confirm_Password) {
        $getAllUser = User::getAllUsers();
        foreach ($getAllUser as $key) {
            if ($key['username'] == $username) {
                $flag = false;
            }
        }
        if ($flag == true) {
            $insertUser = User::insertUser($username, md5($password), $permission);
            if ($insertUser) {
                $getUserLogin = User::getUserLogin($username, $permission);
                if (count($getUserLogin) != 0) {
                    $getOrder_ByCustomerId = Cart::getOrder_ByCustomerId($getUserLogin[0]['id']);
                    if (count($getOrder_ByCustomerId) == 0) {
                        $insertResult = Cart::insertOrder($getUserLogin[0]['id']);
                    }
                }
            }
        }
    }
} 
header("location:./form.php?functionType=users&insertResult=".(int)$insertResult);

function checkUsername($username)
{
    $username = trim($username);
    if (strlen($username) < 4) {
        return false;
    } elseif (strlen($username) > 26) {
        return false;
    } elseif (!preg_match('~^[a-z]{2}~i', $username)) {
        return false;
    } elseif (preg_match('~[^a-z0-9_.]+~i', $username)) {
        return false;
    } elseif (substr_count($username, ".") > 1) {
        return false;
    } elseif (substr_count($username, "_") > 1) {
        return false;
    }

    return true;
}

function checkPassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if (!$uppercase) {
        return false;
    } else     if (!$lowercase) {
        return false;
    } else  if (!$number) {
        return false;
    }
    return true;
}
