CREATE TABLE `diaryEntry`
(
    `id`   int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(254) NOT NULL,
    `content` varchar(254) NOT NULL,
    primary key (`id`)
);

INSERT INTO diaryEntry (title, content)
VALUES ('first one', 'first content');

-- complete model and controller class
-- make get all diary entry
-- front end call index call controller call model and give back data 
-- base html on homework 10 homepage
-- make a get all diary entry post 