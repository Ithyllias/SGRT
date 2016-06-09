<?php

return [

    'welcome' => 'WELCOME',
    'connection' => 'Please login.',
    'email' => 'Login:',
    'password' => 'Password:',
    'connect' => 'Log In',
    'connectedMessage' => (Session::get('connected_user') !== null ? 'You are currently connected as '.Session::get('connected_user'): 'You need to log in in order to see the other pages of this website.')
];
