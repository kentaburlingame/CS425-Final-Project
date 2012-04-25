-- Here are all values that are inserted and will remain static
insert into Tiers 
	values(500, 'Silver', '  ');
insert into Tiers
	values(1000, 'Gold', '   ');
insert into Tiers
	values(2000, 'Platinum', '   ');
	
insert into ticketPrices 
	values(1, 'matinee', 8);
insert into ticketPrices 
	values(2, 'child', 7);
insert into ticketPrices 
	values(3, 'adult', 11);
insert into ticketPrices 
	values(4, 'student', 9);
insert into ticketPrices 
	values(5, 'senior', 9);

insert into Theater (streetNumber, streetName, city, state, zipCode, phoneNumber, numScreens) 
	values(233, 'State St.', 'Chicago', 'IL', '60616', '312-555-6666', 5);
insert into Theater (streetNumber, streetName, city, state, zipCode, phoneNumber, numScreens)
	values(444, 'Roosevelt', 'Chicago', 'IL', '60616', '312-334-4040', 3);
insert into Theater (streetNumber, streetName, city, state, zipCode, phoneNumber, numScreens)
	values(521, 'Ashland', 'Chicago', 'IL', '60616',  '312-999-6858', 4);
insert into Theater (streetNumber, streetName, city, state, zipCode, phoneNumber, numScreens)
	values(8595, 'Fullterton', 'Chicago', 'IL', '60616', '312-849-4949', 1);

insert into Movie (title, director, description)
	values('Five Year Engagement', 'Nicholas Stoler', 'Beginning where most 
		romantic comedies end, a look at what happens when an engaged couple, 
		Violet and Tom, keeps getting tripped up on the long walk down 
		the aisle and the strain it puts on their relationship.');

insert into Movie (title, director, description)
	values('21 Jump Street', 'Phil Lord', 'When cops Schmidt (Jonah Hill) 
		and Jenko (Channing Tatum) join the secret Jump Street unit, they 
		use their youthful appearances to go under cover as high-school 
		students.');

insert into Movie (title, director, description)
	values('Wrath of the Titans', 'Jonathan Liebesman', 'Sequel to the 
      2010 remake starring Sam Worthington as Perseus, who was born of 
		a god but raised as a man and sought revenge for the death his 
		family at the hand of Hades (Ralph Fiennes), the vengeful god of 
		the underworld.');

insert into Genre (Type)
   values ('drama');
insert into Genre (Type)
   values ('adventure');
insert into Genre (Type)
   values ('sci-fi');
insert into Genre (Type)
   values ('love story');
insert into Genre (Type)
   values ('comedy');
insert into Genre (Type)
   values ('family');
