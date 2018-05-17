CREATE_TABLE users (
	user_id int(11) not null AUTO_INCREMENT PRIMARY KEY,
	user_firstName varchar(256) not null,
	user_lastName varchar(256) not null,
	user_userId varchar(256) not null,
	user_email varchar(256) not null,
	user_password varchar(256) not null
);