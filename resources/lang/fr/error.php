<?php
/**
 * Created by PhpStorm.
 * User: Mathieu Lapointe
 * Date: 2016-05-26
 * Time: 12:28
 */

return [

    'loginFailed' => 'Usager inexistant ou mot de passe invalide.',
    'accessError' => 'Vous ne disposez pas des droits d\'accès nécessaire pour ce module.',
    'token_invalid' => 'Le jeton reçu n\'est pas valide.',
    'token_expired' => 'Le jeton reçu est expiré, veuillez vous reconnecter.',
    'token_not_provided' => 'Aucun jeton fourni, impossible de valider l\'identité de l\'utilisateur.',
    'user_not_found' => 'Votre utilisateur est introuvable dans notre sytème, veuillez contacter un coordonnateur.',
    'dberror' => 'Erreur lors de la mise à jour des données',
    'uniqueError' => 'Erreur lors de la mise à jour de ces entrées : ',
    'taskCreation' => 'La tâche ":name" est invalide et n\' pas pu être créée. Veuillez vérifier qu\'elle termine avec le format de date YYYY</br>',
    'session' => 'La valeur de session est invalide pour ":name". Veuillez vérifier qu\'elle commence par "A", "H", ou "E".</br>',
    'courseCode' => 'Le code du cours n\'est pas valide. Veuillez vérifier qu\'il suit le patron ***-***-**.</br>',
    'importError' => 'Les erreurs suivantes sont survenues : </br>',
    'upload' => 'Une erreur est survenue lors du traitement du fichier importé, veuillez vérifier que vous envoyez un fichier xls ou xlsx.</br>',
    'newTaskInsert' => 'Une erreur est survénu lors de la sauvegarde des données pour le cours ":cours" à la session ":sess".</br>',
    'noTeacher' => 'L\'enseignant ":name" n\'existe pas dans notre système et ne peut donc pas avoir de tâche réelle correspondante.</br>',
    'noTask' => 'Aucun élément de la tâche actuel n\'existe pour le cours ":cours" à la session ":sess"</br>',
    'realTaskInsert' => 'Une erreur est survenue lors de la sauvegarde des données pour ":prof" dans le cours ":cours" de la session ":sess".</br>',
    'marbleInsert' => 'Une erreur est survenu lors de la sauvegarde des données de billes de départ pour ":prof" avec le cours ":cours".</br>',
    'resetError' => 'Une erreur est survenue lors de la suppression des billes de départ.',
    'closeError' => 'Une erreur est survenue lors de la fermeture de la tâche actuelle.'
];