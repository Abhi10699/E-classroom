-- Select User with id

select * from Users where id = 1;

-- Select classroom with id

select * from Classroom where classroom_id = 1;

-- Get all classrooms of a particular user

select FK_class_id from Participants where FK_user_id = 1;

-- Select User from Participant table (something like that)

select * from Users inner join Participants on User.id = Participants.FK_user_id;

-- Select all the classrooms of a teacher with a given id

select Classroom.classroom_id,Users.username,Users.email,Classroom.classroom_name,Classroom.description from Classroom inner join Users on Users.id = Classroom.FK_admin_id where Users.id = ?;

-- Select all the classrooms of a student with a given id
select Classroom.classroom_id,Classroom.classroom_name,Classroom.description from Classroom inner join Participants on Participants.FK_class_id=Classroom.classroom_id inner join Users on Users.id = Participants.FK_user_id where Participants.FK_user_id = ?;

-- Select a student of id ? from a classroom ?
select * from Participants where FK_user_id = 1 and FK_class_id = 1