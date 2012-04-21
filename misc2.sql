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
