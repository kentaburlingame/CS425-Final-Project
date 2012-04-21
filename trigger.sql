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

delimiter //
create trigger upgradingUserStatus after update on UserType 
for each row
begin 
	if (new.userCredits >= 2000) then	
		set UserType.status = (select status from Tiers where credits = 2000);
	elseif (new.userCredits >= 1000 and new.userCredits < 2000) then
		set UserType.status = (select status from Tiers where credits = 1000);
	elseif (new.userCredits >= 500 and new.userCredits < 1000) then
		set UserType.status = (select status from Tiers where credits = 500);
	end if;
end;	
//

delimiter ;
