<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/run/v2/k8s.min.proto

namespace Google\Cloud\Run\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * ResourceRequirements describes the compute resource requirements.
 *
 * Generated from protobuf message <code>google.cloud.run.v2.ResourceRequirements</code>
 */
class ResourceRequirements extends \Google\Protobuf\Internal\Message
{
    /**
     * Only memory and CPU are supported. Note: The only
     * supported values for CPU are '1', '2',  '4', and '8'. Setting 4 CPU
     * requires at least 2Gi of memory. The values of the map is string form of
     * the 'quantity' k8s type:
     * https://github.com/kubernetes/kubernetes/blob/master/staging/src/k8s.io/apimachinery/pkg/api/resource/quantity.go
     *
     * Generated from protobuf field <code>map<string, string> limits = 1;</code>
     */
    private $limits;
    /**
     * Determines whether CPU should be throttled or not outside of requests.
     *
     * Generated from protobuf field <code>bool cpu_idle = 2;</code>
     */
    private $cpu_idle = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array|\Google\Protobuf\Internal\MapField $limits
     *           Only memory and CPU are supported. Note: The only
     *           supported values for CPU are '1', '2',  '4', and '8'. Setting 4 CPU
     *           requires at least 2Gi of memory. The values of the map is string form of
     *           the 'quantity' k8s type:
     *           https://github.com/kubernetes/kubernetes/blob/master/staging/src/k8s.io/apimachinery/pkg/api/resource/quantity.go
     *     @type bool $cpu_idle
     *           Determines whether CPU should be throttled or not outside of requests.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Run\V2\K8SMin::initOnce();
        parent::__construct($data);
    }

    /**
     * Only memory and CPU are supported. Note: The only
     * supported values for CPU are '1', '2',  '4', and '8'. Setting 4 CPU
     * requires at least 2Gi of memory. The values of the map is string form of
     * the 'quantity' k8s type:
     * https://github.com/kubernetes/kubernetes/blob/master/staging/src/k8s.io/apimachinery/pkg/api/resource/quantity.go
     *
     * Generated from protobuf field <code>map<string, string> limits = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * Only memory and CPU are supported. Note: The only
     * supported values for CPU are '1', '2',  '4', and '8'. Setting 4 CPU
     * requires at least 2Gi of memory. The values of the map is string form of
     * the 'quantity' k8s type:
     * https://github.com/kubernetes/kubernetes/blob/master/staging/src/k8s.io/apimachinery/pkg/api/resource/quantity.go
     *
     * Generated from protobuf field <code>map<string, string> limits = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLimits($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->limits = $arr;

        return $this;
    }

    /**
     * Determines whether CPU should be throttled or not outside of requests.
     *
     * Generated from protobuf field <code>bool cpu_idle = 2;</code>
     * @return bool
     */
    public function getCpuIdle()
    {
        return $this->cpu_idle;
    }

    /**
     * Determines whether CPU should be throttled or not outside of requests.
     *
     * Generated from protobuf field <code>bool cpu_idle = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setCpuIdle($var)
    {
        GPBUtil::checkBool($var);
        $this->cpu_idle = $var;

        return $this;
    }

}

