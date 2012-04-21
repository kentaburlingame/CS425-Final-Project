--Function updating users' credits after purchase
create function updateCreditPurchase (totalPrice int, user_ID int)
	returns integer
	begin 
		update UserType
		set userCredits = userCredits + totalPrice
		where UserType.user_ID = updateCreditPurchase.user_ID
		return userCredits;
	end
	


