<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/servicecontrol/v1/quota_controller.proto

namespace Google\Cloud\ServiceControl\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents information regarding a quota operation.
 *
 * Generated from protobuf message <code>google.api.servicecontrol.v1.QuotaOperation</code>
 */
class QuotaOperation extends \Google\Protobuf\Internal\Message
{
    /**
     * Identity of the operation. This is expected to be unique within the scope
     * of the service that generated the operation, and guarantees idempotency in
     * case of retries.
     * In order to ensure best performance and latency in the Quota backends,
     * operation_ids are optimally associated with time, so that related
     * operations can be accessed fast in storage. For this reason, the
     * recommended token for services that intend to operate at a high QPS is
     * Unix time in nanos + UUID
     *
     * Generated from protobuf field <code>string operation_id = 1;</code>
     */
    private $operation_id = '';
    /**
     * Fully qualified name of the API method for which this quota operation is
     * requested. This name is used for matching quota rules or metric rules and
     * billing status rules defined in service configuration.
     * This field should not be set if any of the following is true:
     * (1) the quota operation is performed on non-API resources.
     * (2) quota_metrics is set because the caller is doing quota override.
     * Example of an RPC method name:
     *     google.example.library.v1.LibraryService.CreateShelf
     *
     * Generated from protobuf field <code>string method_name = 2;</code>
     */
    private $method_name = '';
    /**
     * Identity of the consumer for whom this quota operation is being performed.
     * This can be in one of the following formats:
     *   project:<project_id>,
     *   project_number:<project_number>,
     *   api_key:<api_key>.
     *
     * Generated from protobuf field <code>string consumer_id = 3;</code>
     */
    private $consumer_id = '';
    /**
     * Labels describing the operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     */
    private $labels;
    /**
     * Represents information about this operation. Each MetricValueSet
     * corresponds to a metric defined in the service configuration.
     * The data type used in the MetricValueSet must agree with
     * the data type specified in the metric definition.
     * Within a single operation, it is not allowed to have more than one
     * MetricValue instances that have the same metric names and identical
     * label value combinations. If a request has such duplicated MetricValue
     * instances, the entire request is rejected with
     * an invalid argument error.
     * This field is mutually exclusive with method_name.
     *
     * Generated from protobuf field <code>repeated .google.api.servicecontrol.v1.MetricValueSet quota_metrics = 5;</code>
     */
    private $quota_metrics;
    /**
     * Quota mode for this operation.
     *
     * Generated from protobuf field <code>.google.api.servicecontrol.v1.QuotaOperation.QuotaMode quota_mode = 6;</code>
     */
    private $quota_mode = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $operation_id
     *           Identity of the operation. This is expected to be unique within the scope
     *           of the service that generated the operation, and guarantees idempotency in
     *           case of retries.
     *           In order to ensure best performance and latency in the Quota backends,
     *           operation_ids are optimally associated with time, so that related
     *           operations can be accessed fast in storage. For this reason, the
     *           recommended token for services that intend to operate at a high QPS is
     *           Unix time in nanos + UUID
     *     @type string $method_name
     *           Fully qualified name of the API method for which this quota operation is
     *           requested. This name is used for matching quota rules or metric rules and
     *           billing status rules defined in service configuration.
     *           This field should not be set if any of the following is true:
     *           (1) the quota operation is performed on non-API resources.
     *           (2) quota_metrics is set because the caller is doing quota override.
     *           Example of an RPC method name:
     *               google.example.library.v1.LibraryService.CreateShelf
     *     @type string $consumer_id
     *           Identity of the consumer for whom this quota operation is being performed.
     *           This can be in one of the following formats:
     *             project:<project_id>,
     *             project_number:<project_number>,
     *             api_key:<api_key>.
     *     @type array|\Google\Protobuf\Internal\MapField $labels
     *           Labels describing the operation.
     *     @type array<\Google\Cloud\ServiceControl\V1\MetricValueSet>|\Google\Protobuf\Internal\RepeatedField $quota_metrics
     *           Represents information about this operation. Each MetricValueSet
     *           corresponds to a metric defined in the service configuration.
     *           The data type used in the MetricValueSet must agree with
     *           the data type specified in the metric definition.
     *           Within a single operation, it is not allowed to have more than one
     *           MetricValue instances that have the same metric names and identical
     *           label value combinations. If a request has such duplicated MetricValue
     *           instances, the entire request is rejected with
     *           an invalid argument error.
     *           This field is mutually exclusive with method_name.
     *     @type int $quota_mode
     *           Quota mode for this operation.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Api\Servicecontrol\V1\QuotaController::initOnce();
        parent::__construct($data);
    }

    /**
     * Identity of the operation. This is expected to be unique within the scope
     * of the service that generated the operation, and guarantees idempotency in
     * case of retries.
     * In order to ensure best performance and latency in the Quota backends,
     * operation_ids are optimally associated with time, so that related
     * operations can be accessed fast in storage. For this reason, the
     * recommended token for services that intend to operate at a high QPS is
     * Unix time in nanos + UUID
     *
     * Generated from protobuf field <code>string operation_id = 1;</code>
     * @return string
     */
    public function getOperationId()
    {
        return $this->operation_id;
    }

    /**
     * Identity of the operation. This is expected to be unique within the scope
     * of the service that generated the operation, and guarantees idempotency in
     * case of retries.
     * In order to ensure best performance and latency in the Quota backends,
     * operation_ids are optimally associated with time, so that related
     * operations can be accessed fast in storage. For this reason, the
     * recommended token for services that intend to operate at a high QPS is
     * Unix time in nanos + UUID
     *
     * Generated from protobuf field <code>string operation_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setOperationId($var)
    {
        GPBUtil::checkString($var, True);
        $this->operation_id = $var;

        return $this;
    }

    /**
     * Fully qualified name of the API method for which this quota operation is
     * requested. This name is used for matching quota rules or metric rules and
     * billing status rules defined in service configuration.
     * This field should not be set if any of the following is true:
     * (1) the quota operation is performed on non-API resources.
     * (2) quota_metrics is set because the caller is doing quota override.
     * Example of an RPC method name:
     *     google.example.library.v1.LibraryService.CreateShelf
     *
     * Generated from protobuf field <code>string method_name = 2;</code>
     * @return string
     */
    public function getMethodName()
    {
        return $this->method_name;
    }

    /**
     * Fully qualified name of the API method for which this quota operation is
     * requested. This name is used for matching quota rules or metric rules and
     * billing status rules defined in service configuration.
     * This field should not be set if any of the following is true:
     * (1) the quota operation is performed on non-API resources.
     * (2) quota_metrics is set because the caller is doing quota override.
     * Example of an RPC method name:
     *     google.example.library.v1.LibraryService.CreateShelf
     *
     * Generated from protobuf field <code>string method_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMethodName($var)
    {
        GPBUtil::checkString($var, True);
        $this->method_name = $var;

        return $this;
    }

    /**
     * Identity of the consumer for whom this quota operation is being performed.
     * This can be in one of the following formats:
     *   project:<project_id>,
     *   project_number:<project_number>,
     *   api_key:<api_key>.
     *
     * Generated from protobuf field <code>string consumer_id = 3;</code>
     * @return string
     */
    public function getConsumerId()
    {
        return $this->consumer_id;
    }

    /**
     * Identity of the consumer for whom this quota operation is being performed.
     * This can be in one of the following formats:
     *   project:<project_id>,
     *   project_number:<project_number>,
     *   api_key:<api_key>.
     *
     * Generated from protobuf field <code>string consumer_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setConsumerId($var)
    {
        GPBUtil::checkString($var, True);
        $this->consumer_id = $var;

        return $this;
    }

    /**
     * Labels describing the operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Labels describing the operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLabels($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->labels = $arr;

        return $this;
    }

    /**
     * Represents information about this operation. Each MetricValueSet
     * corresponds to a metric defined in the service configuration.
     * The data type used in the MetricValueSet must agree with
     * the data type specified in the metric definition.
     * Within a single operation, it is not allowed to have more than one
     * MetricValue instances that have the same metric names and identical
     * label value combinations. If a request has such duplicated MetricValue
     * instances, the entire request is rejected with
     * an invalid argument error.
     * This field is mutually exclusive with method_name.
     *
     * Generated from protobuf field <code>repeated .google.api.servicecontrol.v1.MetricValueSet quota_metrics = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getQuotaMetrics()
    {
        return $this->quota_metrics;
    }

    /**
     * Represents information about this operation. Each MetricValueSet
     * corresponds to a metric defined in the service configuration.
     * The data type used in the MetricValueSet must agree with
     * the data type specified in the metric definition.
     * Within a single operation, it is not allowed to have more than one
     * MetricValue instances that have the same metric names and identical
     * label value combinations. If a request has such duplicated MetricValue
     * instances, the entire request is rejected with
     * an invalid argument error.
     * This field is mutually exclusive with method_name.
     *
     * Generated from protobuf field <code>repeated .google.api.servicecontrol.v1.MetricValueSet quota_metrics = 5;</code>
     * @param array<\Google\Cloud\ServiceControl\V1\MetricValueSet>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setQuotaMetrics($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\ServiceControl\V1\MetricValueSet::class);
        $this->quota_metrics = $arr;

        return $this;
    }

    /**
     * Quota mode for this operation.
     *
     * Generated from protobuf field <code>.google.api.servicecontrol.v1.QuotaOperation.QuotaMode quota_mode = 6;</code>
     * @return int
     */
    public function getQuotaMode()
    {
        return $this->quota_mode;
    }

    /**
     * Quota mode for this operation.
     *
     * Generated from protobuf field <code>.google.api.servicecontrol.v1.QuotaOperation.QuotaMode quota_mode = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setQuotaMode($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\ServiceControl\V1\QuotaOperation\QuotaMode::class);
        $this->quota_mode = $var;

        return $this;
    }

}

