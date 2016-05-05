<?php

return [

    'welcome' => 'BIENVENUE',
    'connection' => 'Veuillez vous connectez.',
    'email' => 'Adresse Couriel:',
    'password' => 'Mot de passe:',
    'connect' => 'Se connecter',
    'connectedMessage' => (Session::get('connected_user') !== null ? 'Vous êtes présentement connecté en tant que '.Session::get('connected_user'): 'Vous devez vous connecter pour avoir accès au reste du site.')
];
    