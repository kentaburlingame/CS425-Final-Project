delimiter //
create trigger theaterCommentCredits after update of theaterForum
for each row
begin 
	if (nrow.commentNumber = 1) then
		update UserType
		set  userCredits = userCredits + 3 
		where UserType.user_ID = nrow.user_ID;
	else if (nrow.commentNumber > 1) then 
		update UserType
		set userCredits = userCredits + 1
		where UserType.user_ID = nrow.user_ID;
	end if;
end;
//

delimiter ;

delimiter //
create trigger movieCommentCredits after update of movieForum
for each row
begin 
	if (nrow.commentNumber = 1) then
		update UserType
		set  userCredits = userCredits + 3 
		where UserType.user_ID = nrow.user_ID;
	else if (nrow.commentNumber > 1) then 
		update UserType
		set userCredits = userCredits + 1
		where UserType.user_ID = nrow.user_ID;
	end if;
end;
//

delimiter ;

delimiter //
create trigger upgradingUserStatus after update of UserType 
for each row
begin 
	if (nrow.userCredits => 2000) then	
		set status = (select status from Tiers where credits = 2000);
	else if (nrow.userCredits => 1000 and nrow.userCredits < 2000) then
		set status = (select status from Tiers where credits = 1000);
	else if (nrow.userCredits => 500 and nrow.userCredits < 1000) then
		set status = (select status from Tiers where credits = 500);
	end if;
end;	
//

delimiter ;
