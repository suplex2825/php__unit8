<?php 
require_once __DIR__ .'/../inc/bootstrap.php';

$user = findUserByUsername(request()->get('username'));

if(empty($user)) {
    $session->getFlashBag()->add('error', 'Username was not found');
}

if(!password_verify(request()->get('password'), $user['password'])) {
    $session->getFlashBag()->add('error', 'Invalid Password');
    redirect('/login.php');
}


saveUserSession($user);
redirect('/');
?>