INSERT INTO resources (name) VALUES ('Maths');
INSERT INTO resources (name) VALUES ('Physique');
INSERT INTO resources (name) VALUES ('Chimie');
INSERT INTO resources (name) VALUES ('Informatique');

INSERT INTO semesters (annee, semester, created_at, updated_at) VALUES ('2018', '1', '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO semesters (annee, semester, created_at, updated_at) VALUES ('2018', '2', '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO semesters (annee, semester, created_at, updated_at) VALUES ('2019', '1', '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO users (firt_name, last_name, email, password, type, created_at, updated_at) VALUES ('Jean', 'Dupont', 'jean@dupont.com', '123456', '1', '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO users (firt_name, last_name, email, password, type, created_at, updated_at) VALUES ('Jake', 'Don', 'jean@don.com', '123456', '0', '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO students (firt_name, last_name, email, promotion, created_at, updated_at) VALUES ('Student1', 'Student1', 'test@exemple.com', '2018', '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO students (firt_name, last_name, email, promotion, created_at, updated_at) VALUES ('Student2', 'Student2', 'test@exemple.com', '2018', '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO students (firt_name, last_name, email, promotion, created_at, updated_at) VALUES ('Student3', 'Student3', 'test@exemple.com', '2018', '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO users_resources (user_id, resource_id, created_at, updated_at) VALUES (1, 1, '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO users_resources (user_id, resource_id, created_at, updated_at) VALUES (1, 2, '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO users_resources (user_id, resource_id, created_at, updated_at) VALUES (1, 3, '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO users_resources (user_id, resource_id, created_at, updated_at) VALUES (1, 4, '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO exams (date, duration, class, type, status, comment, semester_id, resource_id, original_id, created_at, updated_at) VALUES ('2018-01-01 00:00:00', 120, '1', '1', '1', '1', 1, 1, 1, '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO participations (status, exam_id, student_id, created_at, updated_at) VALUES ('1', 1, 1, '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO participations (status, exam_id, student_id, created_at, updated_at) VALUES ('1', 1, 2, '2018-01-01 00:00:00', '2018-01-01 00:00:00');
INSERT INTO participations (status, exam_id, student_id, created_at, updated_at) VALUES ('1', 1, 3, '2018-01-01 00:00:00', '2018-01-01 00:00:00');