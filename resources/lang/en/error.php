<?php
/**
 * Created by PhpStorm.
 * User: Mathieu Lapointe
 * Date: 2016-05-26
 * Time: 12:26
 */

return [
    'loginFailed' => 'User does not exist or your password is invalid.',
    'accessError' => 'You do not have the necessary access rights for this module.',
    'token_invalid' => 'Invalid token provided.',
    'token_expired' => 'Provided token is expired, please login again.',
    'token_not_provided' => 'No token has been provided, user identity validation impossible.',
    'user_not_found' => 'User could not be found in our system, please contact a coordinator.',
    'dberror' => 'Error updating data in database',
    'uniqueError' => 'Error updating the following records : </br>',
    'taskCreation' => 'The task ":name" is invalid and could not be created. Please ensure it ends with the date pattern YYYY.</br>',
    'session' => 'The semester value is invalid for ":name". Please ensure it starts with either "A", "H", or "E".</br>',
    'courseCode' => 'The course code does not have a valid format. Please ensure it follows the pattern ***-***-**.</br>',
    'importError' => 'The following errors occured : </br>',
    'upload' => 'An error occured during the treatment of the imported file, please ensure you are sending an xls or xlsx file.</br>',
    'newTaskInsert' => 'An error occured when trying to save data for course ":cours" in semester ":sess".</br>',
    'noTeacher' => 'The teacher ":name" does not exist in our systems and so cannot have any corresponding task.</br>',
    'noTask' => 'No element of current task exists for ":cours" in semester ":sess"</br>',
    'realTaskInsert' => 'An error occured while saving data for ":prof" in course ":cours" of semester ":sess".</br>',
    'marbleInsert' => 'An error occured while saving data of starting marbles for ":prof" with course ":cours".</br>'
];