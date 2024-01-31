DROP TABLE IF EXISTS participations;
DROP TABLE IF EXISTS exams;
DROP TABLE IF EXISTS users_resources;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS semesters;
DROP TABLE IF EXISTS resources;
DROP TABLE IF EXISTS students;

CREATE TABLE resources (
  id serial primary key NOT NULL,
  name varchar(255) NOT NULL
);

CREATE TABLE semesters (
  id serial primary key NOT NULL,
  annee varchar(255) NOT NULL,
  semester varchar(255) NOT NULL,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TABLE users (
  id serial primary key NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  type int NOT NULL,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TABLE users_resources (
  id serial primary key NOT NULL,
  user_id int REFERENCES users(id),
  resource_id int REFERENCES resources(id),
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TABLE exams (
  id serial primary key NOT NULL,
  date timestamp NOT NULL,
  duration int NOT NULL,
  class varchar(255) NOT NULL,
  type int NOT NULL,
  status int NOT NULL,
  comment varchar(255) NOT NULL,
  semester_id int REFERENCES semesters(id),
  resource_id int REFERENCES resources(id),
  original_id int REFERENCES exams(id),
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TABLE students (
  id serial primary key NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  promotion varchar(255) NOT NULL,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TABLE participations (
  id serial primary key NOT NULL,
  status varchar(255) NOT NULL,
  exam_id int REFERENCES exams(id),
  student_id int REFERENCES students(id),
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

