use cie;
select * from categories;

insert into categories(name,description)
VALUES ("announcements","This category is for every news-entry which deals mainly with announcements.");
insert into categories(name,description)
VALUES ("others","This category is for every news-entry which can't be related to any other category.");
insert into categories(name,description)
VALUES("reviews","This category is for every news-entry that contains information about events which happened in the past.");
insert into categories(name,description)
VALUES("info","This category is for every news-entry that general information such as maintenance-notifications.");
