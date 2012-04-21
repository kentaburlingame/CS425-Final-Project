--Trigger for updating user's credits if they made the first comment or any comment in the Theater Forum
create trigger theaterCommentCredits after update of theaterForum
referencing new row as nrow
for each row
begin atomic 
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

--Trigger for updating user's credits if they made the first comment or any comment in the Movie Forum
create trigger movieCommentCredits after update of movieForum
referencing new row as nrow
for each row
begin atomic 
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

--Trigger for updating users' status based on the amount of credits they have
create trigger upgradingUserStatus after update of UserType 
referencing new row as nrow
for each row
begin atomic
	if (nrow.userCredits => 2000) then	
		set status = (select status from Tiers where credits = 2000);
	else if (nrow.userCredits => 1000 and nrow.userCredits < 2000) then
		set status = (select status from Tiers where credits = 1000);
	else if (nrow.userCredits => 500 and nrow.userCredits < 1000) then
		set status = (select status from Tiers where credits = 500);
	end if;
end;	

--Trigger updating users' credits after purchase???
--This might not be a trigger as much as a funtion once purchase has been made...depends how we implement
	
	
	
	
	
	
	
	
	
	
	
	
	