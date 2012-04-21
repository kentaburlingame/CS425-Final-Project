--Trigger for updating user's credits if they made the first comment or any comment in the Theater Forum
create trigger theaterCommentCredits after update of theaterForum
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

