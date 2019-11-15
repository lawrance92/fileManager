<?php
function requiredFieldValidator($field) {
    if (!isset($field) || $field === "") {
        $errors['value'] = "Field can not be blank.";
        return TRUE;
    } else {
        return FALSE;
    }
}

function emailValidator($email) {
    $emailPattern = "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function rangeValidator($min, $max) {
    if (strlen($value) < $min || strlen($value) > $max) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function nameValidator($name) {
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function userNameValidator($username) {
    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{2,30}$/', $username)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
?>