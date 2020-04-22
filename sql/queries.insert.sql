-- Create classroom with admin_id 1

insert into Classroom (FK_admin_id) values(1);

-- Add participants with id 2 in Classroom 

insert into Participants (FK_class_id,FK_user_id) values(1,2);