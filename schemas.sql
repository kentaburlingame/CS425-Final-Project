create table Theater (
   ID 			      int,
   streetNumber	   int, 
   streetName		   varchar(20), 
   city			      varchar(20), 
   state			      char(2), 
   zipCode		      varchar(10),
   phoneNumber	      varchar(12) unique,
   numScreens		   int,
   Primary Key (ID),
   unique (streetName, city, state, zipCode));

create table Movie (
   ID				   int,
   title			      varchar(30),
   director			   varchar(20),
   description		   varchar(50),
   Primary Key (title));

create table Screen (
   ID				      int,
   capacity		      int, 
   Primary Key (ID),
   check (capacity > 0));

create table Stars (
   ID				      int,
   firstName 		   varchar(20),
   lastName 		   varchar(20),
   Primary Key (firstName, lastName));

create table Genre (
   ID				      int,
   Type 			      varchar(15),
   Primary Key (ID));

create table Showtimes (
   theater_ID	      int, 
   movie_Title	      varchar(20), 
   screen_ID 	      int, 
   date 		         date,
   time			      time,
   Foreign Key (theater_ID) references Theater,
   Foreign Key (movie_Title) references Movie,
   Foreign Key (screen_ID) references Screen,
   Primary Key (theater_ID, movie_Title, screen_ID, date, time));

create table appearsIn (
   movie_Title 	   varchar(30), 
   star_ID		      int,
   Foreign Key (movie_Title) references Movie,
   Foreign Key (star_ID) references Stars,
   Primary Key (movie_Title, star_ID)); 

create table movieGenre (
   movie_Title 	   varchar(30),
   genre_ID		      int,
   Foreign Key (movie_Title) references Movie, 
   Foreign Key (genre_ID) references Genre,
   Primary Key (movie_Title, genre_ID));

create table User (
   ID				   int,
   user_ID			   varchar(15) unique,
   firstname			varchar(20), 
   lastname			   varchar(20), 
   password			   varchar(15),
   email_ID			   varchar(20),
   streetNumber		int, 
   streetName		   varchar(20),
   aptNumber			varchar(8),
   city				   varchar(20), 
   state				   varchar(2),
   zipCode			   varchar(10), 
   phoneNumber		   varchar(12), 
   CCtype			   varchar(10), 
   CCNumber 			numeric(16,0), 
   expDate			   date, 
   securityCode		char(3),
   Primary Key (user_ID),
   check (type in ('Visa', 'Mastercard')), check (cardNumber > 0));


create table Tiers (
   credits			   int,
   status			   varchar(8),
   privileges		   varchar(50),
   Primary Key (status),
   check (credits > 0));

create table UserType (
   user_ID		      int,
   userCredits	      int,
   status            varchar(8),
   Foreign  Key (user_ID) references User,
   Primary Key (user_ID));

create table movieForum (
	comment_ID		  int auto_increment, 
	thread_ID		  int,
	user_ID 		  int, 
	movie_ID		  int,
	comment			  varchar(300),
	commentNumber     int,
	time 			  timestamp,
	Primary Key (comment_ID)
)   

create table theaterForum (
	comment_ID	  	  int auto_increment, 
	thread_ID		  int,
	user_ID 		  int, 
	theater_ID		  int,
	comment			  varchar(300),
	commentNumber     int,
	time 			  timestamp,
	Primary Key (comment_ID)
)   
   
create table Employee (
   ID			         int, 
   ssn			      numeric(9,0),
   location		      int, 
   firstName		   varchar(20),
   lastName		      varchar(20),
   streetNumber	   int, 
   streetName	      varchar(20), 
   aptNumber		   varchar(8), 
   city			      varchar(20),
   state			      char(2),
   zipCode		      varchar(10),
   phoneNumber	      varchar(12),
   Primary Key (ID),
   Foreign Key (location) references Theater,
   unique(ssn));

create table JobType (
   type			      varchar(20),
   description	      varchar(200),
   Primary Key (type));

create table Schedule (
   employee_ID	      int, 
   type			      varchar(20), 
   location_ID	      int, 
   date			      date, 
   time			      time,
   Foreign Key (employee_ID) references Employee,
   Foreign Key (type) references JobType, 
   Foreign Key (location_ID) references Theater,
   Primary Key (employee_ID, type, location_ID, date, time));

create table worksAt (
   theater_id 	      int,
   employee_id 	   int,
   Foreign Key (theater_id) references Theater,
   Foreign Key (employee_id) references Employee,
   Primary Key (theater_id, employee_id));

