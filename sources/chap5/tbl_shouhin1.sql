CREATE TABLE  `my_blog`.`tbl_shouhin1` (
`shouhin_code` VARCHAR( 3 ) NOT NULL ,
`shouhin_mei` VARCHAR( 16 ) NOT NULL ,
`tanka` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `shouhin_code` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


INSERT INTO tbl_shouhin1(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'100',  'チョコレート', 200
);# 変更された行数: 1
INSERT INTO tbl_shouhin1(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'110',  'キャンディ', 300
);# 変更された行数: 1
INSERT INTO tbl_shouhin1(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'120',  'せんべい', 250
);# 変更された行数: 1
INSERT INTO tbl_shouhin1(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'130',  'ケーキ', 400
);# 変更された行数: 1
INSERT INTO tbl_shouhin1(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'140',  'ガム', 100
);# 変更された行数: 1

