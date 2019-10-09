drop table message;
drop table thread;
drop table routine;
drop table added;
drop table reference;
drop table feedback;
drop table user;
drop table course;
drop table department;

create table department(name varchar(10), primary key(name));

create table course(course_no varchar(10) primary key, name varchar(100), dept_name varchar(10) not null, semester enum('1st year 1st term', '1st year second term', '2nd year 1st term', '2nd year 2nd term', '3rd year 1st term', '3rd year 2nd term', '4th year 1st term', '4th year 2nd term') not null, foreign key(dept_name) references department(name));

create table user(username varchar(30), password varchar(50) not null, login_cookie_hash varchar(50) not null, roll char(7) unique not null, email varchar(100) unique not null,  dept_name varchar(10) not null, primary key(username), foreign key (dept_name) references department(name));

create table feedback(id int auto_increment primary key, username varchar(30), subject varchar(127) not null, message varchar(1023) not null, time_submitted date, foreign key(username) references user(username));

create table reference(id int auto_increment primary key, title varchar(50), author varchar(50), edition int, dept_name varchar(10) not null, semester enum('1st year 1st term', '1st year second term', '2nd year 1st term', '2nd year 2nd term', '3rd year 1st term', '3rd year 2nd term', '4th year 1st term', '4th year 2nd term') not null, course_no varchar(10) not null, link varchar(2083), foreign key(dept_name) references department(name), foreign key(course_no) references course(course_no));

create table added(username varchar(30) not null, ref_id int, time_added datetime not null, foreign key(username) references user(username), foreign key(ref_id) references reference(id));

create table routine(dept_name varchar(10), semester enum('1st year 1st term', '1st year second term', '2nd year 1st term', '2nd year 2nd term', '3rd year 1st term', '3rd year 2nd term', '4th year 1st term', '4th year 2nd term'), day enum('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'), period enum('08:00 to 08:50',
												 '08:50 to 09:40',
												 '09:40 to 10:30',
												 '10:40 to 11:30',
												 '11:30 to 12:20',
												 '12:20 to 01:10',
												 '02:30 to 03:20',
												 '03:20 to 04:10',
												 '04:10 to 05:00'),
span tinyint(2) default 1, course_no varchar(10),
primary key(dept_name, semester, day, period, course_no),
foreign key(dept_name) references department(name),
foreign key(course_no) references course(course_no));

create table thread(id int auto_increment primary key, username varchar(30), starttime datetime not null, name varchar(512), foreign key(username) references user(username));

create table message(id int auto_increment primary key, username varchar(30), posttime datetime not null, msg varchar(4095), thr int, foreign key(username) references user(username), 
foreign key(thr) references thread(id));


insert into department values ('CSE');
insert into department values ('EEE');
insert into department values ('BME');
insert into department values ('ECE');

insert into course values('CSE 1100', 'Introduction to Computer', 'CSE', 1);
insert into course values('CSE 1107', 'Discrete Mathematics', 'CSE', 1);
insert into course values('MATH 1100', 'Differential and Integral Calculus', 'CSE', 1);
insert into course values('EEE 2101', 'Electrical', 'EEE', 3);
insert into course values('CSE 3100', 'Web Programming', 'CSE', 5);
insert into course values('CSE 2200', 'Advanced Programming', 'CSE', 4);
insert into course values('BME 1100', 'Intro to BME', 'BME', 1);
insert into course values('ECE 1201', 'Data And Signal', 'ECE', 2);
insert into course values('ECE 2201', 'Only SIgnal', 'ECE', 4);

insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('Discrete Mathematics', 'Kenneth H ROsen', 7, 'CSE', 1, 'CSE 1107', 'LJSDLFJDS');
insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('ABCDEDFDF', 'Kenneth H ROsen', 4, 'CSE', 1, 'CSE 1107', 'LJ465454fasdfDS');
insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('Dfdsaatics', 'KenneD  H ROsen', 7, 'CSE', 1, 'CSE 1107', 'LJS  JDS');
insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('DiscreasdfMathematics', 'Kenneth H Rasdfn', 7, 'CSE', 1, 'CSE 1107', 'LJSDLDS');
insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('Discrete Habijabi', 'BHUGOL', 7, 'CSE', 1, 'CSE 1107', 'LJ64654654');

insert into user values('raihanul', sha1('just a pass'), sha1('raihanuljust a pass'), 1507038, 'refat0167@gmail.com', 'CSE');
insert into user values('nahid', sha1('lipstick'), sha1('nahidlipstick'), 1507039, 'nahid@lipstick.com', 'CSE');
insert into user values('mohaimin', sha1('al barat'), sha1('mohaiminal barat'), 1507056, 'mohaimin@albarat.com', 'CSE');
insert into user values('sabbir', sha1('kosha!!!'), sha1('sabbirkosha!!!'), 1507035, 'sabbir@kosha.com', 'EEE');

insert into added values ('raihanul', 1, NOW());
insert into added values ('raihanul', 2, NOW());
insert into added values ('nahid', 3, NOW());
insert into added values ('sabbir', 4, NOW());
insert into added values ('raihanul', 5, NOW());

insert into routine values('CSE', 1, 1, 1, 1, 'CSE 1100');
insert into routine values('CSE', 1, 1, 2, 1, 'CSE 1107');
insert into routine values('CSE', 1, 1, 3, 1, 'MATH 1100');
insert into routine values('CSE', 1, 1, 4, 3, 'ECE 1201');
insert into routine values('CSE', 1, 1, 7, 1, 'CSE 1100');
insert into routine values('CSE', 1, 2, 1, 1, 'CSE 1100');
insert into routine values('CSE', 1, 2, 2, 1, 'CSE 1107');
insert into routine values('CSE', 1, 2, 3, 1, 'MATH 1100');
insert into routine values('CSE', 1, 2, 4, 3, 'ECE 1201');
insert into routine values('CSE', 1, 2, 7, 1, 'CSE 1100');
insert into routine values('CSE', 1, 3, 1, 3, 'CSE 1100');
insert into routine values('CSE', 1, 3, 4, 1, 'CSE 1107');
insert into routine values('CSE', 1, 3, 5, 1, 'MATH 1100');
insert into routine values('CSE', 1, 3, 6, 1, 'ECE 1201');
insert into routine values('CSE', 1, 3, 7, 1, 'CSE 1100');
insert into routine values('CSE', 1, 4, 1, 3, 'CSE 1100');
insert into routine values('CSE', 1, 4, 4, 1, 'CSE 1107');
insert into routine values('CSE', 1, 4, 5, 1, 'MATH 1100');
insert into routine values('CSE', 1, 4, 6, 1, 'ECE 1201');
insert into routine values('CSE', 1, 4, 7, 1, 'CSE 1100');
insert into routine values('CSE', 1, 5, 4, 1, 'CSE 1100');
insert into routine values('CSE', 1, 5, 5, 1, 'ECE 1201');
insert into routine values('CSE', 1, 5, 6, 1, 'MATH 1100');
insert into routine values('CSE', 1, 5, 7, 3, 'CSE 1107');

insert into routine values('EEE', 1, 1, 1, 1, 'EEE 2101');
insert into routine values('EEE', 1, 1, 2, 1, 'EEE 2101');
insert into routine values('EEE', 1, 1, 3, 1, 'MATH 1100');
insert into routine values('EEE', 1, 1, 4, 3, 'ECE 1201');
insert into routine values('EEE', 1, 1, 7, 1, 'CSE 1100');
insert into routine values('EEE', 1, 2, 1, 1, 'CSE 1100');
insert into routine values('EEE', 1, 2, 2, 1, 'CSE 1107');
insert into routine values('EEE', 1, 2, 3, 1, 'MATH 1100');
insert into routine values('EEE', 1, 2, 4, 3, 'EEE 2101');
insert into routine values('EEE', 1, 2, 7, 1, 'CSE 1100');
insert into routine values('EEE', 1, 3, 1, 3, 'CSE 1100');
insert into routine values('EEE', 1, 3, 4, 1, 'EEE 2101');
insert into routine values('EEE', 1, 3, 5, 1, 'MATH 1100');
insert into routine values('EEE', 1, 3, 6, 1, 'ECE 1201');
insert into routine values('EEE', 1, 3, 7, 1, 'CSE 1100');
insert into routine values('EEE', 1, 4, 1, 3, 'EEE 2101');
insert into routine values('EEE', 1, 4, 4, 1, 'CSE 1107');
insert into routine values('EEE', 1, 4, 5, 1, 'ECE 2201');
insert into routine values('EEE', 1, 4, 6, 1, 'ECE 1201');
insert into routine values('EEE', 1, 4, 7, 1, 'CSE 1100');
insert into routine values('EEE', 1, 5, 4, 1, 'CSE 1100');
insert into routine values('EEE', 1, 5, 5, 1, 'ECE 1201');
insert into routine values('EEE', 1, 5, 6, 1, 'MATH 1100');
insert into routine values('EEE', 1, 5, 7, 3, 'CSE 1107');

insert into thread(username, starttime, name) values('raihanul', date_sub(NOW(), interval 30 day), 'Is PHP better than ASP?');
insert into thread(username, starttime, name) values('sabbir', date_sub(NOW(), interval 20 day), 'How to implement autocomplete in wbesite?');
insert into thread(username, starttime, name) values('nahid', date_sub(NOW(), interval 10 day), 'Dostora ki khobor shobai!');

insert into message(username, posttime, msg, thr) values('raihanul', date_sub(NOW(), interval 30 day), 'I\'m confused which one to choose from ASP and PHP. Help me plz.', 1);
insert into message(username, posttime, msg, thr) values('sabbir', date_sub(NOW(), interval 29 day), 'PHP is easier to learn. There are lots of resources in the web.', 1);
insert into message(username, posttime, msg, thr) values('nahid', date_sub(NOW(), interval 5 day), 'lasjkdfljkasdfklj', 1);
insert into message(username, posttime, msg, thr) values('sabbir', date_sub(NOW(), interval 20 day), 'I need it for web lab project. Do I need javascript? or php? I\'e no clue', 2);
insert into message(username, posttime, msg, thr) values('raihanul', date_sub(NOW(), interval 15 day), 'You need both server side and client side programming. If you\'re using php then write php code to handle the autocomplete request. Same goes for ASP. For the client side code, use AJAX. Either use the JQuery library or native javascript code. The client side should request the server side whenever the input field is updated by the user and it shoudl also show the suggestions in a drop down box underneath the field. I hope it helps', 2);
insert into message(username, posttime, msg, thr) values('nahid', date_sub(NOW(), interval 10 day), 'Ki obostha shobar?', 3);
insert into message(username, posttime, msg, thr) values('sabbir', date_sub(NOW(), interval 10 day), 'sheii!', 3);
insert into message(username, posttime, msg, thr) values('mohaimin', date_sub(NOW(), interval 9 day), 'This site is for academic use. Not for social conversations. This is not facebook....', 3);
insert into message(username, posttime, msg, thr) values('nahid', date_sub(NOW(), interval 8 day), 'eh atel kothakar!!!', 3	);



