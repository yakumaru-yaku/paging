create database dotinstall_paging_php;
grant all on dotinstall_paging_php.* to dbuser@localhost identified by '0000';
use dotinstall_paging_php

create table comments (
    id int not null auto_increment primary key,
    comment text,
    created datetime,
    modified datetime
);

insert into comments (comment, created, modified) values 
('コメント1', now(),now()),
('コメント2', now(),now()),
('コメント3', now(),now()),
('コメント4', now(),now()),
('コメント5', now(),now()),
('コメント6', now(),now()),
('コメント7', now(),now()),
('コメント8', now(),now()),
('コメント9', now(),now()),
('コメント10', now(),now()),
('コメント11', now(),now()),
('コメント12', now(),now()),
('コメント13', now(),now()),
('コメント14', now(),now()),
('コメント15', now(),now()),
('コメント16', now(),now()),
('コメント17', now(),now()),
('コメント18', now(),now());