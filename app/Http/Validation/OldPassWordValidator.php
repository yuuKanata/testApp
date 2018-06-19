<?php 

namespace App\Http\Validation;

use Hash;

class oldPasswdValidator
{
	public function oldPassword($attribute,$value,$parameters)
	{
		return Hash::check($value,$parameters[0]);
	}
}
























 ?>