#Sample4_01
SELECT *
  FROM customer;

#Sample4_02
SELECT room_no ,room_name
  FROM room
 WHERE dayfee >= 9000
   AND dayfee <= 10000
   AND room_no < 200;
   
#Sample4_03
SELECT *
  FROM customer
 WHERE customer_name LIKE '石%'
    OR customer_name LIKE '%山%';

#Sample4_04
SELECT customer_name , room_name
  FROM customer ,room , reserve
 WHERE customer.customer_id = reserve.customer_id
   AND reserve.room_no = room.room_no;

#Sample4_05
SELECT room_no, room_name, dayfee
  FROM room
 WHERE room_no IN (SELECT room_no FROM reserve)
 ORDER BY dayfee DESC;

#Sample4_06
INSERT INTO customer
( customer_id 
 ,customer_name 
 ,customer_telno 
 ,customer_address) 
VALUES 
( 10 
 ,'水谷 基祐' 
 ,'0118721200' 
 ,'mizutani_kisuke@example.com');
 
#Sample4_07
INSERT INTO customer
VALUES
( 11
 ,'出口 恵望子'
 ,'0118721222'
 ,'deguchi_emiko@example.com');

#Sample4_08
UPDATE room
   SET room_name = '広々した和室'
 WHERE room_name LIKE '%和室%';
 
#Sample4_09
UPDATE room
   SET dayfee   = dayfee - 500
      ,capacity = capacity - 1
 WHERE dayfee <= 9000
   AND room_no LIKE '%3';
   
#Sample4_10
DELETE FROM customer
 WHERE customer_id = '1';