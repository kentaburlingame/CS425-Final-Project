--Trigger for updating user's status if they made the first comment in the Theater Forum
create trigger firstCommentTheater after update of theaterForum
referencing new row as nrow
for each row
when (nrow.commentNumber = 1)
begin atomic 
	update UserType
	set  userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;

--Trigger for updating user's status if they made any comment in the Theater Forum
create trigger anyCommentTheater after update of theaterForum
referencing new row as nrow
for each row
when (nrow.commenNumber > 1)
begin atomic
	update UserType
	set userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;

--Trigger for updating user's status if they made the first comment in the Movie Forum
create trigger firstCommentMovie after update of movieForum
referencing new row as nrow
for each row
when (nrow.commentNumber = 1)
begin atomic 
	update UserType
	set  userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;

--Trigger for updating user's status if they made any comment in the Movie Forum
create trigger anyCommentMovie after update of movieForum
referencing new row as nrow
for each row
when (nrow.commenNumber > 1)
begin atomic
	update UserType
	set userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;

--Trigger for updating user's credits if they made the first comment or any comment in the Theater Forum
create trigger theaterCommentCredits after update of theaterForum
referencing new row as nrow
for each row
begin atomic 
	update UserType
	set  userCredits = userCredits + 3 
	where nrow.commentNumber = 1 and UserType.user_ID = nrow.user_ID;
	
	update UserType
	set userCredits = userCredits + 1
	where nrow.commentNumber > 1 and UserType.user_ID = nrow.user_ID;
end;

--Trigger for updating user's credits if they made the first comment or any comment in the Movie Forum
create trigger movieCommentCredits after update of movieForum
referencing new row as nrow
for each row
begin atomic 
	update UserType
	set  userCredits = userCredits + 3 
	where nrow.commentNumber = 1 and UserType.user_ID = nrow.user_ID;
	
	update UserType
	set userCredits = userCredits + 1 
	where nrow.commentNumber > 1 UserType.user_ID = nrow.user_ID;
end;