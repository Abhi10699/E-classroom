-- Users Tables

create table Users(
  id int(10) primary key auto_increment,
  username varchar(40),
  email varchar(150),
  password varchar(150)

);

-- Classroom Table

create table Classroom (
  classroom_name varchar(100),
  classroom_id int(10) primary key auto_increment,
  FK_admin_id int,
  foreign key (FK_admin_id) references Users(id)
);

-- Participants table

create table Participants(
  FK_class_id int,
  FK_user_id int,
  participantId int(10) primary key auto_increment,
  foreign key (FK_class_id) references Classroom(classroom_id),
  foreign key (FK_user_id) references Users(id)
);