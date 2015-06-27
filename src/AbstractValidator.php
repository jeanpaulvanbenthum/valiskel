<?php namespace Ilyes512\Valiskel;

class AbstractValidator
{

    /**
     * Validator
     *
     * @var object
     */
    protected $validator;

    /**
     * Messages object that will contain the errors
     *
     * @var object
     */
    protected $messages;

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Data to be validated
     *
     * @var array
     */
    protected $data = [];

    /**
     * Failed validation rules
     *
     * @var array
     */
    protected $failed = [];

    /**
     * Whether or not to run the after() validation function
     *
     * @var bool
     */
    protected $after = true;

    /**
     * Set data thats to be validated
     *
     * @param array $data
     *
     * @return object $this
     */
    public function with(Array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Add an new error message
     *
     * @return object $this
     */
    public function addError($key, $value)
    {
        $this->messages->add($key, $value);

        return $this;
    }

    /**
     * Set the validation rules
     *
     * @param array $rules
     *
     * @return object $this
     */
    public function withRules(Array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Returns the validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->messages;
    }

    /**
     * Returns failed validation rules
     *
     * @return array
     */
    public function failed()
    {
        return $this->failed;
    }

    /**
     * Return the validation rules
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Return the data to be validated
     *
     * @return array
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Run the validation with the after() function
     *
     * @return $this
     */
    public function withAfter()
    {
        $this->after = true;

        return $this;
    }

    /**
     * Run the validation without the after() function
     *
     * @return $this
     */
    public function withoutAfter()
    {
        $this->after = false;

        return $this;
    }
}
