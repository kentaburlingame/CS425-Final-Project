delimiter //
create trigger firstCommentTheater after update of theaterForum
for each row
when (new.commentNumber = 1)
begin
	update UserType
	set  userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;
//

delimiter ;

delimiter //
create trigger anyCommentTheater after update of theaterForum
for each row
when (new.commentNumber > 1)
begin 
	update UserType
	set userCredits = userCredits + 1 
	where UserType.user_ID = nrow.user_ID;
end;
//

delimiter ;

delimiter //
create trigger firstCommentMovie after update of movieForum
for each row
when (new.commentNumber = 1)
begin 
	update UserType
	set  userCredits = userCredits + 3 
	where UserType.user_ID = nrow.user_ID;
end;
//

delimiter ;

delimiter //
create trigger anyCommentMovie after update of movieForum
for each row
when (new.commentNumber > 1)
begin 
	update UserType
	set userCredits = userCredits + 1 
	where UserType.user_ID = nrow.user_ID;
end;
//

delimiter ;