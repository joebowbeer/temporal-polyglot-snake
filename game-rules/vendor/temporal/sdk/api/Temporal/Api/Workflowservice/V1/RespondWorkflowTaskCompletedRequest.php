<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: temporal/api/workflowservice/v1/request_response.proto

namespace Temporal\Api\Workflowservice\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>temporal.api.workflowservice.v1.RespondWorkflowTaskCompletedRequest</code>
 */
class RespondWorkflowTaskCompletedRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes task_token = 1;</code>
     */
    protected $task_token = '';
    /**
     * Generated from protobuf field <code>repeated .temporal.api.command.v1.Command commands = 2;</code>
     */
    private $commands;
    /**
     * Generated from protobuf field <code>string identity = 3;</code>
     */
    protected $identity = '';
    /**
     * Generated from protobuf field <code>.temporal.api.taskqueue.v1.StickyExecutionAttributes sticky_attributes = 4;</code>
     */
    protected $sticky_attributes = null;
    /**
     * Generated from protobuf field <code>bool return_new_workflow_task = 5;</code>
     */
    protected $return_new_workflow_task = false;
    /**
     * Generated from protobuf field <code>bool force_create_new_workflow_task = 6;</code>
     */
    protected $force_create_new_workflow_task = false;
    /**
     * Generated from protobuf field <code>string binary_checksum = 7;</code>
     */
    protected $binary_checksum = '';
    /**
     * Generated from protobuf field <code>map<string, .temporal.api.query.v1.WorkflowQueryResult> query_results = 8;</code>
     */
    private $query_results;
    /**
     * Generated from protobuf field <code>string namespace = 9;</code>
     */
    protected $namespace = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $task_token
     *     @type \Temporal\Api\Command\V1\Command[]|\Google\Protobuf\Internal\RepeatedField $commands
     *     @type string $identity
     *     @type \Temporal\Api\Taskqueue\V1\StickyExecutionAttributes $sticky_attributes
     *     @type bool $return_new_workflow_task
     *     @type bool $force_create_new_workflow_task
     *     @type string $binary_checksum
     *     @type array|\Google\Protobuf\Internal\MapField $query_results
     *     @type string $namespace
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Temporal\Api\Workflowservice\V1\RequestResponse::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bytes task_token = 1;</code>
     * @return string
     */
    public function getTaskToken()
    {
        return $this->task_token;
    }

    /**
     * Generated from protobuf field <code>bytes task_token = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setTaskToken($var)
    {
        GPBUtil::checkString($var, False);
        $this->task_token = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .temporal.api.command.v1.Command commands = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Generated from protobuf field <code>repeated .temporal.api.command.v1.Command commands = 2;</code>
     * @param \Temporal\Api\Command\V1\Command[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setCommands($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Temporal\Api\Command\V1\Command::class);
        $this->commands = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string identity = 3;</code>
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Generated from protobuf field <code>string identity = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setIdentity($var)
    {
        GPBUtil::checkString($var, True);
        $this->identity = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.taskqueue.v1.StickyExecutionAttributes sticky_attributes = 4;</code>
     * @return \Temporal\Api\Taskqueue\V1\StickyExecutionAttributes
     */
    public function getStickyAttributes()
    {
        return isset($this->sticky_attributes) ? $this->sticky_attributes : null;
    }

    public function hasStickyAttributes()
    {
        return isset($this->sticky_attributes);
    }

    public function clearStickyAttributes()
    {
        unset($this->sticky_attributes);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.taskqueue.v1.StickyExecutionAttributes sticky_attributes = 4;</code>
     * @param \Temporal\Api\Taskqueue\V1\StickyExecutionAttributes $var
     * @return $this
     */
    public function setStickyAttributes($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Taskqueue\V1\StickyExecutionAttributes::class);
        $this->sticky_attributes = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool return_new_workflow_task = 5;</code>
     * @return bool
     */
    public function getReturnNewWorkflowTask()
    {
        return $this->return_new_workflow_task;
    }

    /**
     * Generated from protobuf field <code>bool return_new_workflow_task = 5;</code>
     * @param bool $var
     * @return $this
     */
    public function setReturnNewWorkflowTask($var)
    {
        GPBUtil::checkBool($var);
        $this->return_new_workflow_task = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool force_create_new_workflow_task = 6;</code>
     * @return bool
     */
    public function getForceCreateNewWorkflowTask()
    {
        return $this->force_create_new_workflow_task;
    }

    /**
     * Generated from protobuf field <code>bool force_create_new_workflow_task = 6;</code>
     * @param bool $var
     * @return $this
     */
    public function setForceCreateNewWorkflowTask($var)
    {
        GPBUtil::checkBool($var);
        $this->force_create_new_workflow_task = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string binary_checksum = 7;</code>
     * @return string
     */
    public function getBinaryChecksum()
    {
        return $this->binary_checksum;
    }

    /**
     * Generated from protobuf field <code>string binary_checksum = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setBinaryChecksum($var)
    {
        GPBUtil::checkString($var, True);
        $this->binary_checksum = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<string, .temporal.api.query.v1.WorkflowQueryResult> query_results = 8;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getQueryResults()
    {
        return $this->query_results;
    }

    /**
     * Generated from protobuf field <code>map<string, .temporal.api.query.v1.WorkflowQueryResult> query_results = 8;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setQueryResults($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Temporal\Api\Query\V1\WorkflowQueryResult::class);
        $this->query_results = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string namespace = 9;</code>
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Generated from protobuf field <code>string namespace = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->namespace = $var;

        return $this;
    }

}

