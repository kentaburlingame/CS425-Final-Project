create trigger theaterCommentCredits after update of theaterForum
for each row
begin  
	update UserType
		set  userCredits = userCredits + 3 
		where new.commentNumber = 1 and UserType.user_ID = new.user_ID;
	update UserType
		set userCredits = userCredits + 1
		where new.commentNumber > 1 and UserType.user_ID = new.user_ID;
end;
