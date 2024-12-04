-- create a database called "finalProject" first
-- CREATE DATABASE finalProject;
CREATE TABLE `diaryEntry`
(
    `id`   int(11) AUTO_INCREMENT,
    `title` varchar(254) NOT NULL,
    `content` varchar(1000) NOT NULL,
    primary key (`id`)
);

INSERT INTO diaryEntry (title, content)
VALUES ('First Diary Entry', 'My boyfriend helped dye my hair back to black today because the red started coming back');

INSERT INTO diaryEntry (title, content)
VALUES ('Second Diary Entry', 'I went to the new Capital One cafe that opened in Columbus circle');

INSERT INTO diaryEntry (title, content)
VALUES ('Third Diary Entry', 'Beekeeper is an okay movie I thought some of the lines were cheesy but I was engaged in the movie the whole time');

INSERT INTO diaryEntry (title, content)
VALUES ('Fourth Diary Entry', 'I was emailing resturants to figure out reservations and I accidentally emailed them that I was celebrating my "22th birthday"');
-- complete model and controller class
-- make get all diary entry
-- front end call index call controller call model and give back data 
-- base html on homework 10 homepage
