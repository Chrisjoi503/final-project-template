<?php
require_once "../app/models/Model.php";
require_once "../app/models/DiaryEntry.php";
require_once "../app/controllers/DiaryEntryController.php";

//set our env variables
$env = parse_ini_file('../.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

use app\controllers\DiaryEntryController;

//get uri without query strings
$uri = strtok($_SERVER["REQUEST_URI"], '?');

//get uri pieces
$uriArray = explode("/", $uri);
//0 = ""
//1 = DiaryEntrys
//2 = 1


//get all or a single DiaryEntry
if ($uriArray[1] === 'api' && $uriArray[2] === 'diaryEntry' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    //only title
    $id = isset($uriArray[3]) ? intval($uriArray[3]) : null;
    $DiaryEntryController = new DiaryEntryController();

    // if ($title) {
    //     $DiaryEntryController->getDiaryEntryByTitle($title);
    // }
    if($id){
        $DiaryEntryController->getDiaryEntryById($id);
    } 
    else {
        $DiaryEntryController->getAllDiaryEntry();
    }
}

//save post
if ($uriArray[1] === 'api' && $uriArray[2] === 'diaryEntry' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $DiaryEntryController = new DiaryEntryController();
    $DiaryEntryController->saveDiaryEntry();
}

//update DiaryEntry
if ($uriArray[1] === 'api' && $uriArray[2] === 'diaryEntry' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $DiaryEntryController = new DiaryEntryController();
    $title = isset($uriArray[3]) ? ($uriArray[3]) : null;
    $DiaryEntryController->updateDiaryEntry($title);
}

//delete DiaryEntry
if ($uriArray[1] === 'api' && $uriArray[2] === 'diaryEntry' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $DiaryEntryController = new DiaryEntryController();
    $id = isset($uriArray[3]) ? ($uriArray[3]) : null;
    $DiaryEntryController->deleteDiaryEntry($id);
}

//views


if ($uriArray[1] === 'diaryEntry-add' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $DiaryEntryController = new DiaryEntryController();
    $DiaryEntryController->DiaryEntryAddView();
}


if ($uriArray[1] === 'diaryEntry-update' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $DiaryEntryController = new DiaryEntryController();
    $DiaryEntryController->DiaryEntryUpdateView();
}


if ($uriArray[1] === 'diaryEntry-delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $DiaryEntryController = new DiaryEntryController();
    $DiaryEntryController->DiaryEntryDeleteView();
}

if ($uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $DiaryEntryController = new DiaryEntryController();
    $DiaryEntryController->DiaryEntryView();
}

include '../public/assets/views/notFound.html';
exit();

?>