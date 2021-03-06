-- Create classroom with admin_id 1

insert into Classroom (FK_admin_id,classroom_name,description) values(1,"Java from zero to hero","A computer programming language");

-- Add participants with id 2 in Classroom 

insert into Participants (FK_class_id,FK_user_id) values(2,4);

-- Update classroom admin

update Classroom set FK_admin_id = ? where classroom_id = ?


-- Insert comment

insert into Comments (FK_class_id,FK_user_id,comment) values (?,?,?);