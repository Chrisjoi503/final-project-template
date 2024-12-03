<?php
// chnage to dairy and add id so can change/edit using Diary Entry number
namespace app\models;

//using the database class namespace
use app\models\Model;

class DiaryEntry extends Model {
    // make it by ID
    public function getDiaryEntryById($id) {
        $query = "select * from diaryEntry where id like :id";
        return $this->fetchAllWithParams ($query, ['id' => $id]);
    }

    public function getAllDiaryEntry() {
        $query = "select * from diaryEntry";
        return $this->fetchAll($query);
    }

    // get Diary Entry 
    public function getDiaryEntryByTitle($title){
        $query = "select * from diaryEntry where title = :title";
        return $this->fetchAllWithParams($query, ['title' => $title]);
    }
   

    public function saveDiaryEntry($inputData){
        $query = "insert into diaryEntry (title, content) values (:title, :content);";
        return $this->fetchAllWithParams($query, $inputData);
    }

    public function updateDiaryEntry($inputData){
        $query = "update diaryEntry set id= :id, title = :title, content = :content where id = :id";
        return $this->fetchAllWithParams($query, $inputData);
    }

    public function deleteDiaryEntry($inputData){
        $query = "DELETE FROM diaryEntry where id = :id";
        return $this->fetchAllWithParams($query, $inputData);
    }
    // login and sign out function 
}