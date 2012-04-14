-----------------------------------------------------------------------------
--Theaters and Movies
-----------------------------------------------------------------------------
--Entity Set
Theater (ID 			int,
		 streetNumber	int, 
		 streetName		varchar(20), 
		 city			varchar(20), 
		 state			char(2), 
		 zipCode		varchar(10),
		 phoneNumber	varchar(12),
		 numScreens		int,
Primary Key (ID))

Movie (title			varchar(30),
	   director			varchar(20),
	   description		varchar(50),
Primary Key (title))

Screen (ID				int,
		capacity		int, 
Primary Key (ID)
check (capacity > 0))

Stars (ID				int,
	   firstName 		varchar(20),
	   lastName 		varchar(20),
Primary Key (firstName, lastName))

Genre (ID				int,
	   Type 			varchar(15),
Primary Key (ID))

--Relationship Set between Movie, Theater, and Screens
Showtimes (theater_ID	int, 
		   movie_Title	varchar(20), 
		   screen_ID 	int, 
		   date 		date,
		   time			time,
Foreign Key (theater_ID) references Theater,
Foreign Key (movie_Title) references Movie,
Foreign Key (screen_ID) references Screen)

--Relationship Set between Movie and Stars
appearsIn (movie_Title 	  varchar(30), 
		   star_ID		  int,
Foreign Key (movie_Title) references Movie,
Foreign Key (star_ID) references Stars) 

--Relationship Set between Movie and Genre
movieGenre (movie_Title 	varchar(30),
			genre_ID		int,
Foreign Key (movie_Title) references Movie, 
Foreign Key (genre_ID) references Genre)

-----------------------------------------------------------------------------
--Membership and Privileges 
-----------------------------------------------------------------------------
--Entity Sets
User (user_ID			varchar(15),
	  firstname			varchar(20), 
	  lastname			varchar(20), 
	  password			varchar(15),
	  email_ID			varchar(20),
	  streetNumber		int, 
	  streetName		varchar(20),
	  aptNumber			varchar(8),
	  city				varchar(20), 
	  state				varchar(2),
	  zipCode			varchar(10), 
	  phoneNumber		varchar(12), 
	  CCtype			varchar(10), 
	  CCNumber 			numeric(16,0), 
	  expDate			date, 
	  securityCode		char(3),
Primary Key (user_ID),
check (type in (‘Visa’, ‘Mastercard’)), check (cardNumber > 0))


Tiers (credits			int,
	   status			varchar(8),
	   privileges		varchar(50),
Primary Key (status)
check (credits > 0))

--Relationship Set between User and Tiers
UserType (user_ID		varchar(15),
		  userCredits	int,
		  status(),
Foreign  Key (user_ID) references User)

-----------------------------------------------------------------------------
--Discussion Forum
-----------------------------------------------------------------------------
--Relationship Set between Movie, Theater, and User
Reviews ( user_ID		varchar(15),
		  type			varchar(15),
		  movie_Title	varchar(20), 
		  theater_ID	int,
		  review		varchar(300),
Foreign Key (user_ID) references User, 
Foreign Key (movie_Title) references Movie, 
Foreign Key (theater_ID) references Theater)

-----------------------------------------------------------------------------
--Theater Staff and Functions
-----------------------------------------------------------------------------
--Entity Sets
Employee (ID			int, 
		  ssn			numeric(9,0),
		  location		int, 
		  firstName		varchar(20),
		  lastName		varchar(20),
		  streetNumber	int, 
		  streetName	varchar(20), 
		  aptNumber		varchar(8), 
		  city			varchar(20),
		  state			char(2),
		  zipCode		varchar(10),
		  phoneNumber	varchar(12),
Primary Key (ID),
Foreign Key (location) references Theater)

JobType (type			varchar(20),
		 description	varchar(200),
Primary Key (type))

--Relationship Set between Employee and JobType
Schedule (employee_ID	int, 
		  type			varchar(20), 
		  location_ID	int, 
		  date			date, 
		  time			time,
Foreign Key (employee_ID) references Employee,
Foreign Key (type) references JobType, 
Foreign Key (location) references Theater)

--Relationship Set between Employee and Theater
worksAt (theater_id 	int,
		 employee_id 	int,
Foreign Key (theater_id) references Theater,
Foreign Key (employee_id) references Employee)



