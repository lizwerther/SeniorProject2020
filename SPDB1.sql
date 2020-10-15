
DROP TABLE Profiles CASCADE CONSTRAINTS
DROP TABLE Post CASCADE CONSTRAINTS
DROP TABLE Interests CASCADE CONSTRAINTS

--Users-- 
CREATE TABLE Profiles (

profileID int not null, 
fname varchar (25) not null,
lname varchar (25) not null, 
email varchar (30) not null, 
phonenumber int not null, 
username varchar (20) not null,
pword varchar (20) not null,

)

--Post--
CREATE TABLE Post (

postID int not null,
postTime int not null,
postTags varchar (50) not null,
postLikes varchar (25) not null,
postTitle varchar (50) not null,
postCategory varchar (30) not null,
postRating int not null,
postContent varchar not null
)

--Interests--
CREATE TABLE Interests (

interestCat varchar (30) not null,
interesttype varchar (30) not null,
interestID int not null,

)