#全テーブルのレコードを削除
DELETE FROM reserve;
DELETE FROM room;
DELETE FROM room_type;
DELETE FROM customer;

#CREATE TABLE customer (
# customer_id INT NOT NULL,
# customer_name VARCHAR(50) NOT NULL,
# customer_telno CHAR(11) NOT NULL,
# customer_status VARCHAR(50) NOT NULL, 
# customer_address VARCHAR(255)
#);

INSERT INTO customer VALUES (0,'勝地 徹','01011110000','vip','katsudi_tooru@example.com');
INSERT INTO customer VALUES (1,'山本 美佐','01011111111','nomal','yamamoto_misa@example.com');
INSERT INTO customer VALUES (2,'石井 良介','01011112222','vip','ishii_ryousuke@example.com');
INSERT INTO customer VALUES (3,'宮崎 菜々美','01011113333','nomal','miyasaki_nanami@example.com');
INSERT INTO customer VALUES (4,'平尾 広之','01011114444','vip','hirao_hiroyuki@example.com');
INSERT INTO customer VALUES (5,'堀北 大樹','01011115555','vip','horikita_hiroki@example.com');
INSERT INTO customer VALUES (6,'小寺 未來','01011116666','nomal','kodera_mirai@example.com');
INSERT INTO customer VALUES (7,'石井 友也','01011117777','nomal','ishii_tomoya@example.com');
INSERT INTO customer VALUES (8,'福山 真一','01011118888','vip','fukuyama_shinichi@example.com');
INSERT INTO customer VALUES (9,'石山 信吾','01011119999','vip','ishiyama_shingo@example.com');

#CREATE TABLE room_type (
# type_id INT NOT NULL,
# type_name VARCHAR(30) NOT NULL,
-- # type_count VARCHAR(30) NOT NULL
#);

INSERT INTO room_type VALUES (1,'和室');
INSERT INTO room_type VALUES (2,'洋室');
INSERT INTO room_type VALUES (3,'和洋室');


#CREATE TABLE room (
# room_no INT NOT NULL,
# room_name VARCHAR(50) NOT NULL,
# information VARCHAR(255),
# main_image VARCHAR(50) NOT NULL,
# image1 VARCHAR(50),
# image2 VARCHAR(50),
# image3 VARCHAR(50),
# amenity VARCHAR(255),
# dayfee INT NOT NULL,
# capacity INT NOT NULL,
# type_id INT NOT NULL
#);
INSERT INTO room VALUES (101,'ゆとりの和室','お風呂・トイレも部屋内にある、広めの和室です。部活・サークルなど、気の合う仲間たちと大人数で利用するのに適しています。','room_01_01.jpg','room_01_02.jpg','room_01_03.jpg','room_01_04.jpg','テレビ、エアコン、冷蔵庫、部屋着、ドライヤー、シャンプー、リンス',9000,4,1);
INSERT INTO room VALUES (102,'ゆとりの和室','お風呂・トイレも部屋内にある、広めの和室です。部活・サークルなど、気の合う仲間たちと大人数で利用するのに適しています。','room_01_01.jpg','room_01_02.jpg','room_01_03.jpg','room_01_04.jpg','テレビ、エアコン、冷蔵庫、部屋着、ドライヤー、シャンプー、リンス',9000,4,1);
INSERT INTO room VALUES (103,'ゆとりの和室','お風呂・トイレも部屋内にある、広めの和室です。部活・サークルなど、気の合う仲間たちと大人数で利用するのに適しています。','room_01_01.jpg','room_01_02.jpg','room_01_03.jpg','room_01_04.jpg','テレビ、エアコン、冷蔵庫、部屋着、ドライヤー、シャンプー、リンス',9000,4,1);
INSERT INTO room VALUES (201,'落ち着きのある洋室','2~3名でのご利用に最適な落ち着きのある洋室です。ファミリー様も大歓迎です。トイレは部屋内にありますが、お風呂は大浴場利用となります。。','room_02_01.jpg','room_02_02.jpg','room_02_03.jpg','room_02_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',8000,3,2);
INSERT INTO room VALUES (202,'落ち着きのある洋室','2~3名でのご利用に最適な落ち着きのある洋室です。ファミリー様も大歓迎です。トイレは部屋内にありますが、お風呂は大浴場利用となります。。','room_02_01.jpg','room_02_02.jpg','room_02_03.jpg','room_02_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',8000,3,2);
INSERT INTO room VALUES (203,'落ち着きのある洋室','2~3名でのご利用に最適な落ち着きのある洋室です。ファミリー様も大歓迎です。トイレは部屋内にありますが、お風呂は大浴場利用となります。。','room_02_01.jpg','room_02_02.jpg','room_02_03.jpg','room_02_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',8000,3,2);
INSERT INTO room VALUES (204,'落ち着きのある洋室','2~3名でのご利用に最適な落ち着きのある洋室です。ファミリー様も大歓迎です。トイレは部屋内にありますが、お風呂は大浴場利用となります。。','room_02_01.jpg','room_02_02.jpg','room_02_03.jpg','room_02_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',8000,3,2);
INSERT INTO room VALUES (205,'落ち着きのある洋室','2~3名でのご利用に最適な落ち着きのある洋室です。ファミリー様も大歓迎です。トイレは部屋内にありますが、お風呂は大浴場利用となります。。','room_02_01.jpg','room_02_02.jpg','room_02_03.jpg','room_02_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',8000,3,2);
INSERT INTO room VALUES (301,'みんなで和洋室','最大6名まで利用可能な和洋室です。ベッド3台、布団3組の形となります。シャワー、トイレは部屋内にありますが、お風呂は大浴場利用となります。','room_03_01.jpg','room_03_02.jpg','room_03_03.jpg','room_03_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',10000,6,3);
INSERT INTO room VALUES (302,'みんなで和洋室','最大6名まで利用可能な和洋室です。ベッド3台、布団3組の形となります。シャワー、トイレは部屋内にありますが、お風呂は大浴場利用となります。','room_03_01.jpg','room_03_02.jpg','room_03_03.jpg','room_03_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',10000,6,3);
INSERT INTO room VALUES (303,'みんなで和洋室','最大6名まで利用可能な和洋室です。ベッド3台、布団3組の形となります。シャワー、トイレは部屋内にありますが、お風呂は大浴場利用となります。','room_03_01.jpg','room_03_02.jpg','room_03_03.jpg','room_03_04.jpg','テレビ、エアコン、冷蔵庫、部屋着',10000,6,3);

#CREATE TABLE reserve (
# reserve_no INT NOT NULL,
# reserve_date DATETIME NOT NULL,
# room_no INT NOT NULL,
# customer_id INT NOT NULL,
# numbers INT NOT NULL,
# checkin_time CHAR(5) NOT NULL,
# message VARCHAR(255)
#);
INSERT INTO reserve VALUES (2016042001,'20160420202011',201,5,3,'12:10','初めての利用となります。よろしくお願いいたします。');
INSERT INTO reserve VALUES (2016042401,'20160424134402',303,8,4,'16:00','前回同様、サークルでの利用をさせて頂きます！');
INSERT INTO reserve VALUES (2016042901,'20160429084024',101,9,5,'17:30','家族での利用です。チェックイン時間が遅れる場合には連絡させて頂きます。');