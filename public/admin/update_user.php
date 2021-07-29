<?php
require_once 'header-require-models.php';
?>
<?php
$updateResult = -1;
if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['newpassword']) && isset($_POST['password2']) && isset($_POST['password']) && isset($_POST['permission'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $old_Password = $_POST['password'];
    $new_Password = str_replace(" ", "", $_POST['newpassword']);
    $permission = $_POST['permission'];
    $currentPass = (strlen($new_Password) == 0) ? $old_Password : $new_Password;
    $confirm_Password = (strlen($new_Password) == 0) ? $currentPass : $_POST['password2'];
    $flag = true;
    
    if (strlen($new_Password) != 0) {
        $validUsername = checkUsername($username);
        if ($validUsername !== true) {
            $flag = false;
        }
        $validPassword = checkPassword($currentPass);
        if ($validPassword !== true) {
            $flag = false;  
        }
    }
    if ($currentPass == $confirm_Password) {
        $getAllUsers_RemoveUserId = User::getAllUsers_RemoveUserId($id);
        foreach ($getAllUsers_RemoveUserId as $value) {
            if ($value['username'] == $username) {
                $flag = false;
            }
        }
        if ($flag == true) {
            $updateResult = User::updateUser($id, $username, md5($currentPass), $permission);
        }
    }
}
header("location:form_update.php?functionType=user&id=" . $id . "&updateResult=".(int)$updateResult);

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
