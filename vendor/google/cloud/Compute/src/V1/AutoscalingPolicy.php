<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Cloud Autoscaler policy.
 *
 * Generated from protobuf message <code>google.cloud.compute.v1.AutoscalingPolicy</code>
 */
class AutoscalingPolicy extends \Google\Protobuf\Internal\Message
{
    /**
     * The number of seconds that the autoscaler waits before it starts collecting information from a new instance. This prevents the autoscaler from collecting information when the instance is initializing, during which the collected usage would not be reliable. The default time autoscaler waits is 60 seconds. Virtual machine initialization times might vary because of numerous factors. We recommend that you test how long an instance may take to initialize. To do this, create an instance and time the startup process.
     *
     * Generated from protobuf field <code>optional int32 cool_down_period_sec = 107692954;</code>
     */
    private $cool_down_period_sec = null;
    /**
     * Defines the CPU utilization policy that allows the autoscaler to scale based on the average CPU utilization of a managed instance group.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyCpuUtilization cpu_utilization = 381211147;</code>
     */
    private $cpu_utilization = null;
    /**
     * Configuration parameters of autoscaling based on a custom metric.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.AutoscalingPolicyCustomMetricUtilization custom_metric_utilizations = 131972850;</code>
     */
    private $custom_metric_utilizations;
    /**
     * Configuration parameters of autoscaling based on load balancer.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyLoadBalancingUtilization load_balancing_utilization = 429746403;</code>
     */
    private $load_balancing_utilization = null;
    /**
     * The maximum number of instances that the autoscaler can scale out to. This is required when creating or updating an autoscaler. The maximum number of replicas must not be lower than minimal number of replicas.
     *
     * Generated from protobuf field <code>optional int32 max_num_replicas = 62327375;</code>
     */
    private $max_num_replicas = null;
    /**
     * The minimum number of replicas that the autoscaler can scale in to. This cannot be less than 0. If not provided, autoscaler chooses a default value depending on maximum number of instances allowed.
     *
     * Generated from protobuf field <code>optional int32 min_num_replicas = 535329825;</code>
     */
    private $min_num_replicas = null;
    /**
     * Defines operating mode for this policy.
     * Check the Mode enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string mode = 3357091;</code>
     */
    private $mode = null;
    /**
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyScaleInControl scale_in_control = 527670872;</code>
     */
    private $scale_in_control = null;
    /**
     * Scaling schedules defined for an autoscaler. Multiple schedules can be set on an autoscaler, and they can overlap. During overlapping periods the greatest min_required_replicas of all scaling schedules is applied. Up to 128 scaling schedules are allowed.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.compute.v1.AutoscalingPolicyScalingSchedule> scaling_schedules = 355416580;</code>
     */
    private $scaling_schedules;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $cool_down_period_sec
     *           The number of seconds that the autoscaler waits before it starts collecting information from a new instance. This prevents the autoscaler from collecting information when the instance is initializing, during which the collected usage would not be reliable. The default time autoscaler waits is 60 seconds. Virtual machine initialization times might vary because of numerous factors. We recommend that you test how long an instance may take to initialize. To do this, create an instance and time the startup process.
     *     @type \Google\Cloud\Compute\V1\AutoscalingPolicyCpuUtilization $cpu_utilization
     *           Defines the CPU utilization policy that allows the autoscaler to scale based on the average CPU utilization of a managed instance group.
     *     @type array<\Google\Cloud\Compute\V1\AutoscalingPolicyCustomMetricUtilization>|\Google\Protobuf\Internal\RepeatedField $custom_metric_utilizations
     *           Configuration parameters of autoscaling based on a custom metric.
     *     @type \Google\Cloud\Compute\V1\AutoscalingPolicyLoadBalancingUtilization $load_balancing_utilization
     *           Configuration parameters of autoscaling based on load balancer.
     *     @type int $max_num_replicas
     *           The maximum number of instances that the autoscaler can scale out to. This is required when creating or updating an autoscaler. The maximum number of replicas must not be lower than minimal number of replicas.
     *     @type int $min_num_replicas
     *           The minimum number of replicas that the autoscaler can scale in to. This cannot be less than 0. If not provided, autoscaler chooses a default value depending on maximum number of instances allowed.
     *     @type string $mode
     *           Defines operating mode for this policy.
     *           Check the Mode enum for the list of possible values.
     *     @type \Google\Cloud\Compute\V1\AutoscalingPolicyScaleInControl $scale_in_control
     *     @type array|\Google\Protobuf\Internal\MapField $scaling_schedules
     *           Scaling schedules defined for an autoscaler. Multiple schedules can be set on an autoscaler, and they can overlap. During overlapping periods the greatest min_required_replicas of all scaling schedules is applied. Up to 128 scaling schedules are allowed.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Compute\V1\Compute::initOnce();
        parent::__construct($data);
    }

    /**
     * The number of seconds that the autoscaler waits before it starts collecting information from a new instance. This prevents the autoscaler from collecting information when the instance is initializing, during which the collected usage would not be reliable. The default time autoscaler waits is 60 seconds. Virtual machine initialization times might vary because of numerous factors. We recommend that you test how long an instance may take to initialize. To do this, create an instance and time the startup process.
     *
     * Generated from protobuf field <code>optional int32 cool_down_period_sec = 107692954;</code>
     * @return int
     */
    public function getCoolDownPeriodSec()
    {
        return isset($this->cool_down_period_sec) ? $this->cool_down_period_sec : 0;
    }

    public function hasCoolDownPeriodSec()
    {
        return isset($this->cool_down_period_sec);
    }

    public function clearCoolDownPeriodSec()
    {
        unset($this->cool_down_period_sec);
    }

    /**
     * The number of seconds that the autoscaler waits before it starts collecting information from a new instance. This prevents the autoscaler from collecting information when the instance is initializing, during which the collected usage would not be reliable. The default time autoscaler waits is 60 seconds. Virtual machine initialization times might vary because of numerous factors. We recommend that you test how long an instance may take to initialize. To do this, create an instance and time the startup process.
     *
     * Generated from protobuf field <code>optional int32 cool_down_period_sec = 107692954;</code>
     * @param int $var
     * @return $this
     */
    public function setCoolDownPeriodSec($var)
    {
        GPBUtil::checkInt32($var);
        $this->cool_down_period_sec = $var;

        return $this;
    }

    /**
     * Defines the CPU utilization policy that allows the autoscaler to scale based on the average CPU utilization of a managed instance group.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyCpuUtilization cpu_utilization = 381211147;</code>
     * @return \Google\Cloud\Compute\V1\AutoscalingPolicyCpuUtilization|null
     */
    public function getCpuUtilization()
    {
        return $this->cpu_utilization;
    }

    public function hasCpuUtilization()
    {
        return isset($this->cpu_utilization);
    }

    public function clearCpuUtilization()
    {
        unset($this->cpu_utilization);
    }

    /**
     * Defines the CPU utilization policy that allows the autoscaler to scale based on the average CPU utilization of a managed instance group.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyCpuUtilization cpu_utilization = 381211147;</code>
     * @param \Google\Cloud\Compute\V1\AutoscalingPolicyCpuUtilization $var
     * @return $this
     */
    public function setCpuUtilization($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\AutoscalingPolicyCpuUtilization::class);
        $this->cpu_utilization = $var;

        return $this;
    }

    /**
     * Configuration parameters of autoscaling based on a custom metric.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.AutoscalingPolicyCustomMetricUtilization custom_metric_utilizations = 131972850;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getCustomMetricUtilizations()
    {
        return $this->custom_metric_utilizations;
    }

    /**
     * Configuration parameters of autoscaling based on a custom metric.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.AutoscalingPolicyCustomMetricUtilization custom_metric_utilizations = 131972850;</code>
     * @param array<\Google\Cloud\Compute\V1\AutoscalingPolicyCustomMetricUtilization>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setCustomMetricUtilizations($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Compute\V1\AutoscalingPolicyCustomMetricUtilization::class);
        $this->custom_metric_utilizations = $arr;

        return $this;
    }

    /**
     * Configuration parameters of autoscaling based on load balancer.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyLoadBalancingUtilization load_balancing_utilization = 429746403;</code>
     * @return \Google\Cloud\Compute\V1\AutoscalingPolicyLoadBalancingUtilization|null
     */
    public function getLoadBalancingUtilization()
    {
        return $this->load_balancing_utilization;
    }

    public function hasLoadBalancingUtilization()
    {
        return isset($this->load_balancing_utilization);
    }

    public function clearLoadBalancingUtilization()
    {
        unset($this->load_balancing_utilization);
    }

    /**
     * Configuration parameters of autoscaling based on load balancer.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyLoadBalancingUtilization load_balancing_utilization = 429746403;</code>
     * @param \Google\Cloud\Compute\V1\AutoscalingPolicyLoadBalancingUtilization $var
     * @return $this
     */
    public function setLoadBalancingUtilization($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\AutoscalingPolicyLoadBalancingUtilization::class);
        $this->load_balancing_utilization = $var;

        return $this;
    }

    /**
     * The maximum number of instances that the autoscaler can scale out to. This is required when creating or updating an autoscaler. The maximum number of replicas must not be lower than minimal number of replicas.
     *
     * Generated from protobuf field <code>optional int32 max_num_replicas = 62327375;</code>
     * @return int
     */
    public function getMaxNumReplicas()
    {
        return isset($this->max_num_replicas) ? $this->max_num_replicas : 0;
    }

    public function hasMaxNumReplicas()
    {
        return isset($this->max_num_replicas);
    }

    public function clearMaxNumReplicas()
    {
        unset($this->max_num_replicas);
    }

    /**
     * The maximum number of instances that the autoscaler can scale out to. This is required when creating or updating an autoscaler. The maximum number of replicas must not be lower than minimal number of replicas.
     *
     * Generated from protobuf field <code>optional int32 max_num_replicas = 62327375;</code>
     * @param int $var
     * @return $this
     */
    public function setMaxNumReplicas($var)
    {
        GPBUtil::checkInt32($var);
        $this->max_num_replicas = $var;

        return $this;
    }

    /**
     * The minimum number of replicas that the autoscaler can scale in to. This cannot be less than 0. If not provided, autoscaler chooses a default value depending on maximum number of instances allowed.
     *
     * Generated from protobuf field <code>optional int32 min_num_replicas = 535329825;</code>
     * @return int
     */
    public function getMinNumReplicas()
    {
        return isset($this->min_num_replicas) ? $this->min_num_replicas : 0;
    }

    public function hasMinNumReplicas()
    {
        return isset($this->min_num_replicas);
    }

    public function clearMinNumReplicas()
    {
        unset($this->min_num_replicas);
    }

    /**
     * The minimum number of replicas that the autoscaler can scale in to. This cannot be less than 0. If not provided, autoscaler chooses a default value depending on maximum number of instances allowed.
     *
     * Generated from protobuf field <code>optional int32 min_num_replicas = 535329825;</code>
     * @param int $var
     * @return $this
     */
    public function setMinNumReplicas($var)
    {
        GPBUtil::checkInt32($var);
        $this->min_num_replicas = $var;

        return $this;
    }

    /**
     * Defines operating mode for this policy.
     * Check the Mode enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string mode = 3357091;</code>
     * @return string
     */
    public function getMode()
    {
        return isset($this->mode) ? $this->mode : '';
    }

    public function hasMode()
    {
        return isset($this->mode);
    }

    public function clearMode()
    {
        unset($this->mode);
    }

    /**
     * Defines operating mode for this policy.
     * Check the Mode enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string mode = 3357091;</code>
     * @param string $var
     * @return $this
     */
    public function setMode($var)
    {
        GPBUtil::checkString($var, True);
        $this->mode = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyScaleInControl scale_in_control = 527670872;</code>
     * @return \Google\Cloud\Compute\V1\AutoscalingPolicyScaleInControl|null
     */
    public function getScaleInControl()
    {
        return $this->scale_in_control;
    }

    public function hasScaleInControl()
    {
        return isset($this->scale_in_control);
    }

    public function clearScaleInControl()
    {
        unset($this->scale_in_control);
    }

    /**
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.AutoscalingPolicyScaleInControl scale_in_control = 527670872;</code>
     * @param \Google\Cloud\Compute\V1\AutoscalingPolicyScaleInControl $var
     * @return $this
     */
    public function setScaleInControl($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\AutoscalingPolicyScaleInControl::class);
        $this->scale_in_control = $var;

        return $this;
    }

    /**
     * Scaling schedules defined for an autoscaler. Multiple schedules can be set on an autoscaler, and they can overlap. During overlapping periods the greatest min_required_replicas of all scaling schedules is applied. Up to 128 scaling schedules are allowed.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.compute.v1.AutoscalingPolicyScalingSchedule> scaling_schedules = 355416580;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getScalingSchedules()
    {
        return $this->scaling_schedules;
    }

    /**
     * Scaling schedules defined for an autoscaler. Multiple schedules can be set on an autoscaler, and they can overlap. During overlapping periods the greatest min_required_replicas of all scaling schedules is applied. Up to 128 scaling schedules are allowed.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.compute.v1.AutoscalingPolicyScalingSchedule> scaling_schedules = 355416580;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setScalingSchedules($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Compute\V1\AutoscalingPolicyScalingSchedule::class);
        $this->scaling_schedules = $arr;

        return $this;
    }

}

