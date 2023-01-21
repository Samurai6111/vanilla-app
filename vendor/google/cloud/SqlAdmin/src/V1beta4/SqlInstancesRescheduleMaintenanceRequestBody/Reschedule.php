<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/sql/v1beta4/cloud_sql_resources.proto

namespace Google\Cloud\Sql\V1beta4\SqlInstancesRescheduleMaintenanceRequestBody;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>google.cloud.sql.v1beta4.SqlInstancesRescheduleMaintenanceRequestBody.Reschedule</code>
 */
class Reschedule extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The type of the reschedule.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.SqlInstancesRescheduleMaintenanceRequestBody.RescheduleType reschedule_type = 1;</code>
     */
    private $reschedule_type = 0;
    /**
     * Optional. Timestamp when the maintenance shall be rescheduled to if
     * reschedule_type=SPECIFIC_TIME, in
     * [RFC 3339](https://tools.ietf.org/html/rfc3339) format, for example
     * `2012-11-15T16:19:00.094Z`.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp schedule_time = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $schedule_time = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $reschedule_type
     *           Required. The type of the reschedule.
     *     @type \Google\Protobuf\Timestamp $schedule_time
     *           Optional. Timestamp when the maintenance shall be rescheduled to if
     *           reschedule_type=SPECIFIC_TIME, in
     *           [RFC 3339](https://tools.ietf.org/html/rfc3339) format, for example
     *           `2012-11-15T16:19:00.094Z`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Sql\V1Beta4\CloudSqlResources::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The type of the reschedule.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.SqlInstancesRescheduleMaintenanceRequestBody.RescheduleType reschedule_type = 1;</code>
     * @return int
     */
    public function getRescheduleType()
    {
        return $this->reschedule_type;
    }

    /**
     * Required. The type of the reschedule.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.SqlInstancesRescheduleMaintenanceRequestBody.RescheduleType reschedule_type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRescheduleType($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Sql\V1beta4\SqlInstancesRescheduleMaintenanceRequestBody\RescheduleType::class);
        $this->reschedule_type = $var;

        return $this;
    }

    /**
     * Optional. Timestamp when the maintenance shall be rescheduled to if
     * reschedule_type=SPECIFIC_TIME, in
     * [RFC 3339](https://tools.ietf.org/html/rfc3339) format, for example
     * `2012-11-15T16:19:00.094Z`.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp schedule_time = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getScheduleTime()
    {
        return $this->schedule_time;
    }

    public function hasScheduleTime()
    {
        return isset($this->schedule_time);
    }

    public function clearScheduleTime()
    {
        unset($this->schedule_time);
    }

    /**
     * Optional. Timestamp when the maintenance shall be rescheduled to if
     * reschedule_type=SPECIFIC_TIME, in
     * [RFC 3339](https://tools.ietf.org/html/rfc3339) format, for example
     * `2012-11-15T16:19:00.094Z`.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp schedule_time = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setScheduleTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->schedule_time = $var;

        return $this;
    }

}

