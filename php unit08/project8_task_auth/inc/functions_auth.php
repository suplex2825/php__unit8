<?php 
function isAuthenticated()
{
    global $session;
    return $session->get('auth_logged_in', false);
} 

function requireAuth()
{
    if(!isAuthenticated()) {
        global $session;
        $session->getFlashBag()->add('error', 'Not Authorized');
        redirect('/login.php');
    } 
}


function getAuthenticatedUser()
{
    global $session;
    return findUserById($session->get('auth_user_id'));
}

function saveUserSession($user)
{
    global $session;
    $session->set('auth_logged_in', true);
    $session->set('auth_user_id', (int) $user['id']);

    $session->getFlashBag()->add('success', 'Successfully Logged In');
}


function isOwner($Id)
{
    if(!isAuthenticated())
    {
        return false;
    }
    global $session;

    return $Id == $session->get('auth_user_id');

}

?>