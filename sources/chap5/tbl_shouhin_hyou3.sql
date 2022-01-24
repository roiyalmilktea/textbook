CREATE TABLE  `my_blog`.`tbl_shouhin_hyou3` (
`shouhin_code` VARCHAR( 4 ) NOT NULL ,
`shouhin_mei` VARCHAR( 16 ) NOT NULL ,
`tanka` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `shouhin_code` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1001',  '田舎定食', 1000
);# 変更された行数: 1
INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1002',  '山の幸定食', 1200
);# 変更された行数: 1
INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1003',  '海の幸定食', 1500
);# 変更された行数: 1
INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1004',  '七福神御前', 3000
);# 変更された行数: 1
INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1005',  '松竹梅御前', 2000
);# 変更された行数: 1
INSERT INTO tbl_shouhin_hyou3(  `shouhin_code` ,  `shouhin_mei` ,  `tanka` ) 
VALUES (
'1006',  '鶴亀御前', 2500
);# 変更された行数: 1

