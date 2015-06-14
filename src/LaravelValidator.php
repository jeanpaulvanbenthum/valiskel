<?php namespace Ilyes512\Valiskel;

use Illuminate\Contracts\Validation\Factory;
use Ilyes512\Valiskel\Messages\MessagesInterface;
use Ilyes512\Valiskel\Traits\MakeActionable;

class LaravelValidator extends AbstractValidator implements ValidableInterface
{

    use MakeActionable;

    protected $backupRules;

    /**
     * @param Factory           $validator
     * @param MessagesInterface $messages
     */
    public function __construct(Factory $validator, MessagesInterface $messages)
    {
        $this->validator   = $validator;
        $this->messages    = $messages;
        $this->backupRules = $this->rules;
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
     * @param bool $applyActionRules
     *
     * @return bool
     */
    public function passes($rules = null, $applyActionRules = true)
    {
        if (!empty($rules)) {
            $this->rules = $rules;
        }

        if ($applyActionRules) {
            $this->applyActionRules(); // see MakeActionable Trait
        }

        $validator = $this->validator->make($this->data, $this->rules);

        if (method_exists($this, 'after')) {
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
     * Resetd the rules to the initial values
     *
     * @return $this
     */
    public function resetRules()
    {
        $this->rules = $this->backupRules;

        return $this;
    }
}
