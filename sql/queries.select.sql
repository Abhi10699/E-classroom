-- Select User with id

select * from Users where id = 1;

-- Select classroom with id

select * from Classroom where classroom_id = 1;

-- Get all classrooms of a particular user

select FK_class_id from Participants where FK_user_id;

-- Select User from Participant table (something like that)

select * from Users inner join Participants on User.id = Participants.FK_user_id;