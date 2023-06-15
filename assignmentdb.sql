CREATE DATABASE assignmentdb;

use assignmentdb;

create table userinfo(
id int auto_increment primary key,
username varchar(255),
email varchar(255),
mobile int(10),
address  varchar(255),
qty int(10),
price int(10),total int(10)
);

select * from userinfo;

alter table userinfo
add column option_val int(100);
select * from userinfo;
drop table userinfo;
ALTER TABLE userinfo
DROP COLUMN option_val;
delete from userinfo where id>=74;
delete from userinfo where option_val  IS NULL;