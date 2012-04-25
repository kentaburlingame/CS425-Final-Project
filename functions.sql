-- Function updating users' credits after purchase

delimiter //
create function updateCreditPurchase (totalPrice int, user_ID int)
	returns int
   deterministic
	begin 
      declare userCredits int;
		update UserType
		set userCredits = userCredits + totalPrice
		where UserType.user_ID = updateCreditPurchase.user_ID
		return userCredits;
	end //

delimiter ;

