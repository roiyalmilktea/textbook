######################################################################

#「jikkyo_pension_Table.sql」実行時にエラーが出てしまったら
#下記の2つのDROP文にて、データベースとユーザーを一度削除してから、
#「localhost」の個所を「%」に変更し、再度実行して下さい。

#DROP DATABASE jikkyo_pension;    #「jikkyo_pension」データベース全体を削除
#DROP USER 'jikkyo'@'localhost';  #「jikkyo」ユーザーを削除

######################################################################

#ユーザの作成と権限の設定
CREATE USER 'jikkyo'@'localhost';
SET PASSWORD FOR 'jikkyo'@'localhost' = PASSWORD('pass');
GRANT USAGE ON * . * TO 'jikkyo'@'localhost' IDENTIFIED BY 'pass' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT ALL PRIVILEGES ON *.* TO 'jikkyo'@'localhost' WITH GRANT OPTION;


#テーブルの作成と主キー・外部キーの設定
CREATE TABLE room_type (
 type_id INT NOT NULL,
 type_name VARCHAR(30) NOT NULL
);

ALTER TABLE room_type ADD CONSTRAINT PK_room_type PRIMARY KEY (type_id);


CREATE TABLE customer (
 customer_id INT NOT NULL,
 customer_name VARCHAR(50) NOT NULL,
 customer_telno CHAR(11) NOT NULL,
 customer_address VARCHAR(255)
);

ALTER TABLE customer ADD CONSTRAINT PK_customer PRIMARY KEY (customer_id);


CREATE TABLE room (
 room_no INT NOT NULL,
 room_name VARCHAR(50) NOT NULL,
 information VARCHAR(255),
 main_image VARCHAR(50) NOT NULL,
 image1 VARCHAR(50),
 image2 VARCHAR(50),
 image3 VARCHAR(50),
 amenity VARCHAR(255),
 dayfee INT NOT NULL,
 capacity INT NOT NULL,
 type_id INT NOT NULL
);

ALTER TABLE room ADD CONSTRAINT PK_room PRIMARY KEY (room_no);


CREATE TABLE reserve (
 reserve_no INT NOT NULL,
 reserve_date DATETIME NOT NULL,
 room_no INT NOT NULL,
 customer_id INT NOT NULL,
 numbers INT NOT NULL,
 checkin_time CHAR(5) NOT NULL,
 message VARCHAR(255)
);

ALTER TABLE reserve ADD CONSTRAINT PK_reserve PRIMARY KEY (reserve_no);


ALTER TABLE room ADD CONSTRAINT FK_room_0 FOREIGN KEY (type_id) REFERENCES room_type (type_id);


ALTER TABLE reserve ADD CONSTRAINT FK_reserve_0 FOREIGN KEY (room_no) REFERENCES room (room_no);
ALTER TABLE reserve ADD CONSTRAINT FK_reserve_1 FOREIGN KEY (customer_id) REFERENCES customer (customer_id);