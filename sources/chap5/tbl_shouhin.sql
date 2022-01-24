CREATE TABLE  `my_blog`.`tbl_shouhin` (
`shouhin_code` VARCHAR( 3 ) NOT NULL ,
`hinmoku` VARCHAR( 16 ) NOT NULL ,
`hinmei` VARCHAR( 16 ) NOT NULL ,
`tanka` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `shouhin_code` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'110',  'せんべい', '塩せんべい', 200
);# 変更された行数: 1
INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'120',  'せんべい', 'えびせんべい', 300
);# 変更された行数: 1
INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'130',  'せんべい', 'のりせんべい', 350
);# 変更された行数: 1
INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'210',  'チョコレート', '板チョコレート', 200
);# 変更された行数: 1
INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'220',  'チョコレート', '棒チョコレート', 250
);# 変更された行数: 1
INSERT INTO tbl_shouhin(  `shouhin_code` ,  `hinmoku` ,  `hinmei` ,  `tanka` ) 
VALUES (
'310',  'つまみ', 'つまみ詰め合わせ', 500
);# 変更された行数: 1

