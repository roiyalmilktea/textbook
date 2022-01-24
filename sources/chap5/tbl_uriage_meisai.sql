CREATE TABLE  `my_blog`.`tbl_uriage_meisai` (
`denpyo_code` VARCHAR( 4 ) NOT NULL ,
`shouhin_code` VARCHAR( 3 ) NOT NULL ,
`kosuu` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `shouhin_code` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


INSERT INTO tbl_uriage_meisai(  `denpyo_code` ,  `shouhin_code` ,  `kosuu` ) 
VALUES (
'1101',  '100', 100
);# 変更された行数: 1
INSERT INTO tbl_uriage_meisai(  `denpyo_code` ,  `shouhin_code` ,  `kosuu` ) 
VALUES (
'1101',  '110', 150
);# 変更された行数: 1
INSERT INTO tbl_uriage_meisai(  `denpyo_code` ,  `shouhin_code` ,  `kosuu` ) 
VALUES (
'1120',  '120', 80
);# 変更された行数: 1
INSERT INTO tbl_uriage_meisai(  `denpyo_code` ,  `shouhin_code` ,  `kosuu` ) 
VALUES (
'1128',  '130', 100
);# 変更された行数: 1

