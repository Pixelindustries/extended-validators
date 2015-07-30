<?php namespace Pixelindustries\ExtendedValidators;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\MessageBag;

/**
 * Allow a class to be validated with validate()
 * use $attributes to set validatable data and
 * use $rules to set the validation rules
 *
 * Note that this requires a getAttributes() method,
 * so use the SimpleGetterSetterHandling trait or
 * set it yourself.
 */
trait ValidatableTrait
{
	/**
	 * Validator instance
	 * @var \Illuminate\Contracts\Validation\Validator
	 */
	protected $validator = null;


	/**
	 * Validates the filter data
	 *
	 * @return boolean
	 */
	public function validate()
	{
		$this->validator = Validator::make($this->getAttributes(), $this->getRules());

		return ! $this->validator->fails();
	}

	/**
	 * Returns validation errors, if any
	 *
	 * @return MessageBag
	 */
	public function messages()
	{
		if (is_null($this->validator))
		{
			$this->validate();
		}

		if ( ! $this->validator->fails()) {
			return App::make(MessageBag::class);
		}

		return $this->validator->messages();
	}

	/**
	 * Accessor method to check for validation data set
	 *
	 * @return array
	 */
	public function getRules()
	{
		return (isset($this->rules)) ? $this->rules : [];
	}

	/**
	 * Setter for $rules
	 */
	public function setRules(array $rules)
	{
		$this->rules = $rules;
	}

}