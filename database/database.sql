create database touristhelper;
use touristhelper;
alter database touristhelper default character set utf8 collate utf8_unicode_ci;


create table faq (
id int not null primary key auto_increment,
question text not null,
answer text not null
);
alter table faq default character set utf8 collate utf8_unicode_ci;


create table voivodeship (
id int not null primary key auto_increment,
voivodeship text not null
);
alter table voivodeship default character set utf8 collate utf8_unicode_ci;


create table city (
id int not null primary key auto_increment,
name text not null,
voivodeship int not null,
foreign key (voivodeship) references voivodeship(id)
);
alter table city default character set utf8 collate utf8_unicode_ci;


create table keywords (
id int not null primary key auto_increment,
keyword text not null
);
alter table keywords default character set utf8 collate utf8_unicode_ci;


create table type (
id int not null primary key auto_increment,
type text not null
);
alter table type default character set utf8 collate utf8_unicode_ci;


create table article_topic (
id int not null primary key auto_increment,
topic text not null
);
alter table article_topic default character set utf8 collate utf8_unicode_ci;


create table article (
id int not null primary key auto_increment,
topic int not null,
content text,
pubdate TIMESTAMP default current_timestamp,
title text not null,
author text not null,
foreign key (topic) references article_topic(id)
);
alter table article default character set utf8 collate utf8_unicode_ci;

create table message_topic (
id int not null primary key auto_increment,
topic text not null
);
alter table message_topic default character set utf8 collate utf8_unicode_ci;

insert into message_topic(topic) values ('Opinia o aplikacji');
insert into message_topic(topic) values ('Zgłoś problem');
insert into message_topic(topic) values ('Inny');

create table user_message (
id int not null primary key auto_increment,
topic int not null,
name text not null,
surname text not null,
mail text not null,
content text not null,
answer text,
public int default 0,
foreign key (topic) references message_topic(id)
);
alter table user_message default character set utf8 collate utf8_unicode_ci;
select * from user_message;

create table comment (
id int not null primary key auto_increment,
pubdate timestamp default current_timestamp,
author text not null,
content text not null,
article int not null,
foreign key (article) references article(id)
);
alter table comment default character set utf8 collate utf8_unicode_ci;

create table location (
id int not null primary key auto_increment,
name text not null,
description text not null,
type int not null,
foreign key (type) references type(id),
city int not null,
foreign key (city) references city(id),
street text,
number text,
postcode text,
position text not null
);
alter table location default character set utf8 collate utf8_unicode_ci;

create table photo (
id int not null primary key auto_increment,
photo text not null,
location int not null,
foreign key (location) references location(id),
url text not null
);
alter table photo default character set utf8 collate utf8_unicode_ci;
ALTER TABLE photo ADD visibility int(1) default 1;

create table comment_location (
  id int not null primary key auto_increment,
  pubdate timestamp default current_timestamp(),
  author text not null,
  content text not null,
  location int not null,
  foreign key (location) references location(id)
);
alter table comment_location default character set utf8 collate utf8_unicode_ci;

create table aboutus (
id int not null primary key auto_increment,
content text not null
);
alter table aboutus default character set utf8 collate utf8_unicode_ci;

/*------------------*/

/*Lista województw*/
insert into voivodeship(voivodeship) values
('dolnośląskie'),
('kujawsko-pomorskie'),
('lubelskie'),
('lubuskie'),
('łódzkie'),
('małopolskie'),
('mazowieckie'),
('opolskie'),
('podkarpackie'),
('podlaskie'),
('pomorskie'),
('śląskie'),
('świętokrzyskie'),
('warmińsko-mazurskie'),
('wielkopolskie'),
('zachodniopomorskie');

insert into article_topic(topic) value('W Polsce');
insert into article_topic(topic) value('Za granicą');
insert into article_topic(topic) value('Transport');
insert into article_topic(topic) value('Ciekawostki');
insert into article_topic(topic) value('Porady');
insert into article_topic(topic) value('Inne');
insert into article_topic(topic) value('Wydarzenia');


insert into type(type) value ('Zamek/Pałac');
insert into type(type) value ('Świątynia');
insert into type(type) value ('Hotel');
insert into type(type) value ('Restauracja');
insert into type(type) value ('Inne');


insert into keywords(keyword) value ('CentralAutoLogin');
insert into keywords(keyword) value ('szlak');
insert into keywords(keyword) value ('logo');
insert into keywords(keyword) value ('Mapa');
insert into keywords(keyword) value ('Obiekt zabytkowy');
insert into keywords(keyword) value ('Flag');
insert into keywords(keyword) value ('Legenda');
insert into keywords(keyword) value ('Disambig');
insert into keywords(keyword) value ('information_icon');
insert into keywords(keyword) value ('Red_pog');
insert into keywords(keyword) value ('Portal');
insert into keywords(keyword) value ('Herb');
insert into keywords(keyword) value ('Wikivoyage');
insert into keywords(keyword) value ('Quote-alpha');
insert into keywords(keyword) value ('svg');
insert into keywords(keyword) value ('plan');
insert into keywords(keyword) value ('Plan');

insert into city(name, voivodeship) values ('Kraków', '1');

insert into aboutus(content) values ('Pomocnik Turysty to nowa aplikacja na polskim rynku, która ma ułatwić podróżowanie każdemu z nas');
insert into aboutus(content) values ('Przed wyruszeniem na wycieczkę, niezbędne jest odpowiednie przygotowanie. Należy zapoznać się z informacjami
o atrakcjach turystycznych w miejscu, do którego się wybieramy.');
insert into aboutus(content) values ('Warto poznać opinie, czy dane miejsce jest warte odwiedzenia czy adres danego miejsca.
Nie można zapomnieć też o restauracjach czy hotelach, bo przecież musimy mieć gdzie zjeść i spać.');
insert into aboutus(content) values ('Z pomocą przychodzi Pomocnik Turysty. Dzięki naszej aplikacji dowiesz się wszystkich niezbędnych informacji o
atrakcjach turystycznych, poczytasz opinie pozostałych turystów, poczytasz aktualności ze świata turystyki, dowiesz się o ciekawych wydarzeniach
oraz zaplanujesz krok po kroku swoją idealną podróż!');
insert into aboutus(content) values ('Pomocnik Turysty to skarbnica wiedzy niezbędnej każdemu turysty, który nie lubi spontanicznych wyjazdów,
a zamiast tego woli zaplanować podróż od A do Z.');
insert into aboutus(content) values ('Przekonaj się jakie korzyści niesie nasza aplikacja. Załóż konto już teraz i odkryj, co dla Ciebie przygotowaliśmy!');

CREATE TABLE IF NOT EXISTS `users` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `name` varchar(50) NOT NULL,
       `surname` varchar(50) NOT NULL,
       `login` varchar(50) NOT NULL,
       `email` varchar(50) NOT NULL,
       `password` varchar(50) NOT NULL,
       `registerdate` datetime NOT NULL,
       `admin` int(1) default 0,
       PRIMARY KEY (`id`)
);
alter table users default character set utf8 collate utf8_unicode_ci;
alter table users add column image int not null default 1;

create table location_comment (
  id int not null primary key auto_increment,
  location int not null,
  author int not null,
  content text not null,
  pubdate TIMESTAMP default current_timestamp,
  foreign key(location) references location(id),
  foreign key(author) references users(id)
);
alter table location_comment default character set utf8 collate utf8_unicode_ci;

create table location_subcomment (
     id int not null primary key auto_increment,
     comment int not null,
     content text not null,
     pubdate TIMESTAMP default current_timestamp,
     author int not null,
     foreign key (comment) references location_comment(id),
     foreign key(author) references users(id)
);
alter table location_subcomment default character set utf8 collate utf8_unicode_ci;

create table location_rate (
id int not null primary key auto_increment,
author int not null,
location int not null,
rate int not null,
foreign key(author) references users(id),
foreign key(location) references location(id)
);
alter table location_rate default character set utf8 collate utf8_unicode_ci;

create table users_favourite (
 id int not null primary key auto_increment,
 user int not null,
 location int not null,
 foreign key (user) references users(id),
 foreign key(location) references location(id)
);
alter table users_favourite default character set utf8 collate utf8_unicode_ci;

create table sysinfo (
id int not null primary key auto_increment,
name text not null,
value text not null
);

insert into sysinfo(name,value) values ('profile-photo',10);

create table article_comment(
id int not null primary key auto_increment,
content text not null,
article int not null,
author int not null,
pubdate TIMESTAMP default current_timestamp,
foreign key(article) references article(id),
foreign key(author) references users(id)
);
alter table article_comment default character set utf8 collate utf8_unicode_ci;

create table article_subcomment (
    id int not null primary key auto_increment,
    content text not null,
    comment int not null,
    author int not null,
    pubdate TIMESTAMP default current_timestamp,
    foreign key(comment) references article_comment(id),
    foreign key(author) references users(id)
);
alter table article_subcomment default character set utf8 collate utf8_unicode_ci;

create table event (
id int not null primary key auto_increment,
name text not null,
startdate date not null,
enddate date not null,
location int not null,
description text not null,
foreign key (location) references location(id)
);
alter table event default character set utf8 collate utf8_unicode_ci;

create table event_favourite (
 id int not null primary key auto_increment,
 user int not null,
 event int not null,
 foreign key(user) references users(id),
 foreign key(event) references event(id)
);
alter table event_favourite default character set utf8 collate utf8_u/nicode_ci;

create table active_session (
id int not null primary key auto_increment,
user int not null,
ip text not null,
browser text not null,
foreign key(user) references users(id)
);

create table logs(
id int not null primary key auto_increment,
information text not null,
type int,
date timestamp default current_timestamp()
);


delimiter |
    create trigger t_newsessioninfo after insert on active_session
    for each row
    begin
        declare newsession varchar(80);
        declare username varchar(40);
        set username = (select login from users where users.id = NEW.user);
        set newsession = CONCAT('Aktywna sesja: Użytkownik ', username, '; IP: ', NEW.ip);
        insert into logs (information, type) values (newsession, '1');
    end |
delimiter ;


delimiter |
create trigger t_finishsession after delete on active_session
for each row
begin
declare newsession varchar(80);
declare username varchar(40);
set username = (select login from users where users.id = OLD.user);
set newsession = CONCAT('Koniec sesji: Użytkownik ', username, '; IP: ', OLD.ip);
insert into logs (information, type) values (newsession, '2');
end |
delimiter ;

delimiter |
create trigger t_newuser after insert on users
for each row
begin
declare newuser varchar(80);
declare username varchar(40);
set username = (select login from users where users.id = NEW.id);
set newuser = CONCAT('Nowy użytkownik:', username);
insert into logs (information, type) values (newuser, '3');
end |
delimiter ;

delimiter |
create trigger t_newlocation after insert on location
for each row
begin
declare newlocation varchar(80);
declare locationname varchar(40);
set locationname = (select name from location where location.id = NEW.id);
set newlocation = CONCAT('Nowa lokacja: ', locationname);
insert into logs (information, type) values (newlocation, '4');
end |
delimiter ;

delimiter |
create trigger t_newevent after insert on event
for each row
begin
declare newevent varchar(500);
declare eventname varchar(500);
declare locationname varchar(500);
set eventname = (select name from event where event.id = NEW.id);
set locationname = (select name from location where location.id = NEW.location);
set newevent = CONCAT('Nowe wydarzenie: ', eventname, ' w lokacji: ', locationname);
insert into logs (information, type) values (newevent, '5');
end |
delimiter ;

delimiter |
create trigger t_newarticle after insert on article
for each row
begin
declare newarticle varchar(500);
declare articlename varchar(500);
set articlename = (select title from article where article.id = NEW.id);
set newarticle = CONCAT('Nowy artykuł: ', articlename);
insert into logs (information, type) values (newarticle, '6');
end |
delimiter ;

delimiter |
create trigger t_deletelocation before delete on location
for each row
begin
declare locationname varchar(80);
declare location varchar(80);
set locationname = (select name from location where location.id = OLD.id);
set location = CONCAT('Usunięta lokacja: ', locationname);
insert into logs (information, type) values (location, '7');
end |
delimiter ;

delimiter |
create trigger t_deletearticle before delete on article
for each row
begin
declare articlename varchar(500);
declare article varchar(500);
set articlename = (select title from article where article.id = OLD.id);
set article = CONCAT('Usunięty artykuł: ', articlename);
insert into logs (information, type) values (article, '8');
end |
delimiter ;

delimiter |
create trigger t_deleteevent before delete on event
for each row
begin
declare eventname varchar(500);
declare event varchar(500);
set eventname = (select name from event where event.id = OLD.id);
set event = CONCAT('Usunięte wydarzenie: ', eventname);
insert into logs (information, type) values (event, '9');
end |
delimiter ;

create table trip (
id int not null primary key auto_increment,
user int not null,
name text not null,
description text,
foreign key (user) references users(id)
);

create table triplocation (
id int not null primary key auto_increment,
trip int not null,
location int not null,
foreign key (trip) references trip(id),
foreign key(location) references location(id)
);

ALTER TABLE users ADD distance int default 30;