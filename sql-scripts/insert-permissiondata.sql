use cie;

select * from users;
select * from roles;
select * from rolegroups;

select * from role_rolegroup;

delete from role_rolegroup where role_id = 8 and rolegroup_id = 8;

insert into roles (id,name,description)
VALUES (1,"newsmanager","role required to manage news");
insert into roles (id,name,description)
VALUES (2,"gamedaymanager","role required to manage gamedays");
insert into roles (id,name,description)
VALUES (3,"usermanager","role required to manage users");
insert into roles (id,name,description)
VALUES (4,"playercardmanager","role required to manage playercards");
insert into roles (id,name,description)
VALUES (5,"permissionmanager","role required to manage permissions");
insert into roles (id,name,description)
VALUES (6,"troubleshooter","role required to be authorized for troubleshooting");
insert into roles (id,name,description)
VALUES (7,"statisticviewer","role required to be authorized for viewing the statistic-page");
insert into roles (id,name,description)
VALUES (8,"logviewer","role required to be authorized for viewing the logentries");

insert into rolegroups (id,name,description)
VALUES(1,"newsmanager","rolegroup required to manage news");
insert into rolegroups (id,name,description)
VALUES (2,"gamedaymanager","rolegroup required to manage gamedays");
insert into rolegroups (id,name,description)
VALUES (3,"usermanager","rolegroup required to manage users");
insert into rolegroups (id,name,description)
VALUES (4,"playercardmanager","rolegroup required to manage playercards");
insert into rolegroups (id,name,description)
VALUES (5,"permissionmanager","rolegroup required to manage permissions");
insert into rolegroups (id,name,description)
VALUES (6,"troubleshooter","rolegroup required to be authorized for troubleshooting");
insert into rolegroups (id,name,description)
VALUES (7,"statisticviewer","rolegroup required to be authorized for viewing the statistic-page");
insert into rolegroups (id,name,description)
VALUES (8,"webmaster","rolegroup required to be authorized for everything except troubleshooting");
insert into rolegroups (id,name,description)
VALUES (9,"administrator","rolegroup required to be authorized for everything");
insert into rolegroups (id,name,description)
VALUES (10,"logviewer","rolegroup required to be authorized for viewing the logentries");

insert into role_rolegroup (rolegroup_id,role_id)
VALUES (1,1);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (2,2);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (3,3);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (4,4);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (5,5);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (6,6);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (7,7);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,1);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,2);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,3);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,4);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,5);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,7);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (8,8);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,1);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,2);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,3);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,4);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,5);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,6);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,7);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (9,8);
insert into role_rolegroup (rolegroup_id,role_id)
VALUES (10,8);


insert into rolegroup_user (rolegroup_id, user_id)
VALUES (9,1);
insert into rolegroup_user (rolegroup_id, user_id)
VALUES (1,2);
insert into rolegroup_user (rolegroup_id, user_id)
VALUES (2,2);
insert into rolegroup_user (rolegroup_id, user_id)
VALUES (4,2);
insert into rolegroup_user (rolegroup_id, user_id)
VALUES (7,2);
insert into rolegroup_user (rolegroup_id, user_id)
VALUES (1,3);

select distinct r.id, r.name
from roles r inner join role_rolegroup rr on rr.role_id = r.id
inner join rolegroups rg on rr.rolegroup_id = rg.id
inner join rolegroup_user ru on ru.rolegroup_id = rg.id
inner join users u on u.id = ru.user_id
where ru.user_id = 9;