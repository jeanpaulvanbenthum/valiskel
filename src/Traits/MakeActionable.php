<?php namespace Ilyes512\Valiskel\Traits;

trait MakeActionable
{

    /**
     * The possible action types (also see $actionType)
     */
    protected $actionTypes = ['store', 'update'];

    /**
     * Action can either be a 'store' or an 'update' type
     *
     * @var string
     */
    protected $actionType = 'store';

    /**
     * The extra parameters that will be passed to the action methods
     *
     * @var array
     */
    protected $extraParams = [];

    /**
     * Whether or not to apply to action rules
     *
     * @var bool
     */
    protected $action = true;

    /**
     * Set the action type
     *
     * @param null $action
     *
     * @param      $params
     *
     * @return $this
     */
    public function setActionType($action = null, ...$params)
    {
        if (isset($action) && in_array($action, $this->actionTypes)) {
            $this->actionType = $action;
            $this->setExtraParams(...$params);
        }

        return $this;
    }

    /**
     * Get the action type
     *
     * @return string
     */
    public function actionType()
    {
        return $this->actionType;
    }

    /**
     * Set the extra parameters that will be passed to the action methods
     *
     * @param $params
     *
     * @return $this
     */
    public function setExtraParams(...$params)
    {
        if (count($params)) {
            $this->extraParams = $params;
        }

        return $this;
    }

    /**
     * Get the extra parameters
     *
     * @return array
     */
    public function extraParams()
    {
        return $this->extraParams;
    }

    /**
     * Apply the action specific validation rules to the base rules
     *
     * @return $this
     */
    protected function applyActionRules()
    {
        if (isset($this->actionType)) {
            if (method_exists($this, $method = $this->actionType . 'Rules')) {
                $this->$method(...$this->extraParams);
            }
        }

        return $this;
    }

    /**
     * Apply the action rules before validation starts
     *
     * @return $this
     */
    public function withActionRules()
    {
        $this->action = true;

        return $this;
    }

    /**
     * Dont apply the action rules
     *
     * @return $this
     */
    public function withoutActionRules()
    {
        $this->action = false;

        return $this;
    }
}