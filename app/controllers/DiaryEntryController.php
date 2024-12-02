<?php
// change DiaryEntry to diary 
namespace app\controllers;

use app\models\DiaryEntry;

class DiaryEntryController
{
    // deals with input error
     // something not working 
     public function validateDiaryEntry($inputData) {
        $errors = [];
        $id = false;
        if(array_key_exists('id', $inputData)) {
            $id = $inputData['id'];
        }
        $title = $inputData['title'];
        $content = $inputData['content'];

        // deals with input error
        if ($id) {
            $id = htmlspecialchars($id, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($id) < 0) {
                $errors['requiredId'] = 'id is required';
            }
        }
        if ($title) {
            $title = htmlspecialchars($title, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($title) < 2) {
                $errors['titleShort'] = 'title is too short';
            }
        } else {
            $errors['requiredTitle'] = 'title is required';
        }

        if ($content) {
            $content = htmlspecialchars($content, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($content) < 2) {
                $errors['contentShort'] = 'content is too short';
            }
        } else {
            $errors['requiredContent'] = 'content is required';
        }

        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
        return [
            'id' => $id,
            'title' => $title,
            'content' => $content
        ];
    }

    public function getAllDiaryEntry() {
        $DiaryEntryModel = new DiaryEntry();
        header("Content-Type: application/json");
        $DiaryEntry = $DiaryEntryModel->getAllDiaryEntry();

        echo json_encode($DiaryEntry);
        exit();
    }

    public function getDiaryEntryById($id) {
        $DiaryEntryModel = new DiaryEntry();
        header("Content-Type: application/json");
        $DiaryEntry = $DiaryEntryModel->getDiaryEntryById($id);
        echo json_encode($DiaryEntry);
        exit();
    }

    public function getDiaryEntryByTitle($title) {
        $DiaryEntryModel = new DiaryEntry();
        header("Content-Type: application/json");
        $DiaryEntry = $DiaryEntryModel->getDiaryEntryByTitle($title);
        echo json_encode($DiaryEntry);
        exit();
    }

    public function saveDiaryEntry() {
        $inputData = [
            'title' => $_POST['title'] ? $_POST['title'] : false,
            'content' => $_POST['content'] ? $_POST['content'] : false,
        ];
        $DiaryEntryData = $this->validateDiaryEntry($inputData);

        $DiaryEntry = new DiaryEntry();
        $DiaryEntry->saveDiaryEntry(
            [
                'title' => $DiaryEntryData['title'],
                'content' => $DiaryEntryData['content'],
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function updateDiaryEntry($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        //no built-in super global for PUT
        parse_str(file_get_contents('php://input'), $_PUT);
        $inputData = [
            'id' => $_PUT['id'] ? $_PUT['id'] : false,
            'title' => $_PUT['title'] ? $_PUT['title'] : false,
            'content' => $_PUT['content'] ? $_PUT['content'] : false,
        ];
        $DiaryEntryData = $this->validateDiaryEntry($inputData);
        //we could save the data off to be saved here

        $DiaryEntry = new DiaryEntry();
        $DiaryEntry->updateDiaryEntry(
            [
                'id' => $DiaryEntryData['id'],
                'title' => $DiaryEntryData['title'],
                'content' => $DiaryEntryData['content']
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function deleteDiaryEntry($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        $DiaryEntry = new DiaryEntry();
        $DiaryEntry->deleteDiaryEntry(
            [
                'id' => $id,
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function DiaryEntryView() {
        include '../public/assets/views/main/diaryEntry/diaryEntry-view.html';
        exit();
    }

    public function DiaryEntryAddView() {
        include '../public/assets/views/main/diaryEntry/diaryEntry-add.html';
        exit();
    }

    public function DiaryEntryDeleteView() {
        include '../public/assets/views/main/diaryEntry/diaryEntry-delete.html';
        exit();
    }

    public function DiaryEntryUpdateView() {
        include '../public/assets/views/main/diaryEntry/diaryEntry-update.html';
        exit();
    }


}