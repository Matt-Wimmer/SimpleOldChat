CREATE DATABASE IF NOT EXISTS messages;
USE messages;
CREATE TABLE IF NOT EXISTS users (username VARCHAR(25),password VARCHAR(50));
CREATE TABLE IF NOT EXISTS messages (written DATETIME,username VARCHAR(25),chat VARCHAR(1000),icon VARCHAR(100));
#INSERT INTO messages (written, username, chat, icon) VALUES (NOW(),"Matt Wimmer","Welcome!","https://i.postimg.cc/3x2r6JDV/Personal-Logo-Black.png");
#CREATE USER 'bear'@'localhost' IDENTIFIED WITH mysql_native_password BY 'D5iqiDqg8ZonVlQh';
#GRANT ALL PRIVILEGES ON messages.* To 'bear'@'localhost';