-- Trigger for updating user's credits if they made the first comment or any
-- comment in the Theater Forum

delimiter //
create trigger theaterCommentCredits after update on theaterForum
for each row
begin  
	update UserType
		set  userCredits = userCredits + 3 
		where (select commentNumber 
			   from theaterForum
			   where new.commentNumber = 1 )
			   and UserType.user_ID = new.user_ID;
	update UserType
		set userCredits = userCredits + 1
		where (select commentNumber 
			   from theaterForum
			   where new.commentNumber > 1 )
			   and UserType.user_ID = new.user_ID;
end;
//

delimiter ;

-- Trigger for updating user's credits if they made the first comment or any
-- comment in the Movie Forum

delimiter //
create trigger movieCommentCredits after update on movieForum
for each row
begin  
	update UserType
		set  userCredits = userCredits + 3 
		where (select commentNumber 
			   from theaterForum
			   where new.commentNumber = 1 )
			   and UserType.user_ID = new.user_ID;
	update UserType
		set userCredits = userCredits + 1
		where (select commentNumber 
			   from theaterForum
			   where new.commentNumber > 1 )
			   and UserType.user_ID = new.user_ID;
end;
//

delimiter ;

-- Trigger for updating users' status based on the amount of credits they have

delimiter //
create trigger upgradingUserStatus after update on UserType 
for each row
begin 
   declare status varchar(8);
	if new.userCredits >= 2000 then	
		set status = (select status from Tiers where credits = 2000);
	elseif new.userCredits >= 1000 and new.userCredits < 2000 then
		set status = (select status from Tiers where credits = 1000);
	elseif new.userCredits >= 500 and new.userCredits < 1000 then
		set status = (select status from Tiers where credits = 500);
	end if;
end;	
//

delimiter ;
