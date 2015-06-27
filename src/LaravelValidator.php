<?php namespace Ilyes512\Valiskel;

use Illuminate\Contracts\Validation\Factory;
use Ilyes512\Valiskel\Messages\MessagesInterface;
use Ilyes512\Valiskel\Traits\MakeActionable;

class LaravelValidator extends AbstractValidator implements ValidableInterface
{

    use MakeActionable;

    /**
     * Store the default/original validation rules
     *
     * @var array
     */
    protected $defaultRules;

    /**
     * @param Factory           $validator
     * @param MessagesInterface $messages
     */
    public function __construct(Factory $validator, MessagesInterface $messages)
    {
        $this->validator    = $validator;
        $this->messages     = $messages;
        $this->defaultRules = $this->rules;
    }

    /**
     * Return's the instance
     *
     * @return $this
     */
    public function instance()
    {
        return $this;
    }

    /**
     * Check if validation passes
     *
     * @param null $rules
     *
     * @return bool
     */
    public function passes($rules = null)
    {
        if (!empty($rules)) {
            $this->rules = $rules;
        }

        // see MakeActionable Trait
        $this->applyActionRules();

        $validator = $this->validator->make($this->data, $this->rules);

        if (method_exists($this, 'after') && $this->after) {
            $validator->after($this->after($this->data));
        }

        if ($validator->passes()) {
            return true;
        }

        $this->messages->merge($validator->messages());
        $this->failed = $validator->failed();

        return false;
    }

    /**
     * Check if validation fails
     *
     * @param null $rules
     *
     * @return bool
     */
    public function fails($rules = null)
    {
        return !$this->passes($rules);
    }

    /**
     * Checks if validation passes for selected fields
     *
     * @param array $fields
     *
     * @return boolean
     */
    public function onlyValidate(array $fields)
    {
        $partialRules = [];

        foreach ($fields as $fieldName) {
            if (array_key_exists($fieldName, $this->rules)) {
                $partialRules[$fieldName] = $this->rules[$fieldName];
            }
        }

        // Check if there are any rules for the field
        if (empty($partialRules)) {
            return true;
        }

        // Remove empty rules
        foreach ($partialRules as $field => $rules) {
            if (empty($rules)) {
                unset($partialRules[$field]);
            }
        }

        return $this->passes($partialRules);
    }

    /**
     * Return the default/original validation rules
     *
     * @return array
     */
    public function getDefaultRules()
    {
        return $this->defaultRules;
    }

    /**
     * Reset the validation rules to the initial values
     *
     * @return $this
     */
    public function resetRules()
    {
        $this->rules = $this->defaultRules;

        return $this;
    }
}
