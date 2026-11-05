CREATE DATABASE IF NOT EXISTS MiniProject;

USE MiniProject;

CREATE TABLE Books (
    BookID INT(250) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BookName varchar(250) NOT NULL,
    Language varchar(250) NOT NULL,
    Author varchar(250) NOT NULL,
    Publisher varchar(250) NOT NULL,
    Status varchar(250) NOT NULL
);

INSERT INTO Books (
    BookName,
    Language,
    Author,
    Publisher,
    Status
) VALUES 
    ("Patung Hina Hidup?", "Malay", "Honobu Yanezawa", "Kadokawa", "Available"),
    ("You've Reached Same", "English", "Dustin Thao", "Wednesday Books", "Available"),
    ("White Tear", "Chinese", "Wei Jun", "Gempak Starz", "Available");

CREATE TABLE Users(
    Username varchar(255) NOT NULL PRIMARY KEY,
    Password varchar(250) NOT NULL,
    Role varchar(250) NOT NULL
);

INSERT INTO Users(
    Username,
    Password,
    Role
) VALUES 
    ("admin", "123admin", "admin"),
    ("Sasha", "Password", "user");

CREATE TABLE BorrowedBook(
    BookID INT(250) NOT NULL REFERENCES Books(BookID),
    Username varchar(255) NOT NULL REFERENCES Users(Username),
    BorrowedDate DATE NOT NULL,
    DueDate DATE NOT NULL
);

INSERT INTO BorrowedBook(
    BookID,
    Username,
    BorrowedDate,
    DueDate
) VALUES 
    (1, "Sasha", "2026-11-04", "2026-11-18");
