<?php
namespace Pixelindustries\ExtendedValidators;

use Illuminate\Support\ServiceProvider;

class ExtendedValidationServiceProvider extends ServiceProvider
{
  	public function register() { }

	public function boot()
	{
		\Illuminate\Support\Facades\Validator::resolver(function($translator, $data, $rules, $messages)
		{
			return new Validator($translator, $data, $rules, $messages);
		});
  	}

}