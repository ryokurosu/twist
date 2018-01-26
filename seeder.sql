insert into botrules(botrule_id,id,name,span,botlimit) value(0,0,'送信しない',10000,0);

update botrules set botrule_id = 0 where botrule_id =1;
insert into dmrules(id,name,span,dmlimit) value(0,'送信しない',10000,0);
update dmrules set dmrule_id = 0 where dmrule_id =1;
insert into botstories(name,id) value('送信しない',0);
update botstories set botstory_id = 0 where id = 0;
insert into dmstories(name,id) value('送信しない',0);
update dmstories set dmstory_id = 0 where id = 0;

INSERT INTO `users` VALUES (1,'kurosu','knowrop1208@gmail.com','$2y$10$6Sitv1HHn6SbLVmBg.meTeaEUJEfgn2TlSNGm2W7MpSMokWqi9B6S',0,NULL,'2017-10-29 19:11:13','2017-10-29 19:11:13');
