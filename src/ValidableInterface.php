<?php namespace Ilyes512\Valiskel;

interface ValidableInterface
{

    /**
     * Check if validation passes
     *
     * @return boolean
     */
    public function passes();

    /**
     * Check if validation fails
     *
     * @return boolean
     */
    public function fails();

    /**
     * Checks if validation passes for selected fields
     *
     * @param array $fields
     *
     * @return boolean
     */
    public function onlyValidate(array $fields);

    /**
     * Set data thats to be validated
     *
     * @param array $data
     *
     * @return object $this
     */
    public function with(Array $data);

    /**
     * Add an new error message
     *
     * @param $key
     * @param $value
     *
     * @return object $this
     */
    public function addError($key, $value);

    /**
     * Set the validation rules
     *
     * @param array $rules
     *
     * @return object $this
     */
    public function withRules(Array $rules);

    /**
     * Returns the validation errors
     *
     * @return array
     */
    public function errors();

    /**
     * Returns failed validation rules
     *
     * @return array
     */
    public function failed();

    /**
     * Return the validation rules
     *
     * @return array
     */
    public function rules();

    /**
     * Return the data to be validated
     *
     * @return array
     */
    public function data();
}
