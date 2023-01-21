<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Next free: 7
 *
 * Generated from protobuf message <code>google.cloud.compute.v1.PacketIntervals</code>
 */
class PacketIntervals extends \Google\Protobuf\Internal\Message
{
    /**
     * Average observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 avg_ms = 204811827;</code>
     */
    private $avg_ms = null;
    /**
     * From how long ago in the past these intervals were observed.
     * Check the Duration enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string duration = 155471252;</code>
     */
    private $duration = null;
    /**
     * Maximum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 max_ms = 529474145;</code>
     */
    private $max_ms = null;
    /**
     * Minimum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 min_ms = 536564403;</code>
     */
    private $min_ms = null;
    /**
     * Number of inter-packet intervals from which these statistics were derived.
     *
     * Generated from protobuf field <code>optional int64 num_intervals = 186329813;</code>
     */
    private $num_intervals = null;
    /**
     * The type of packets for which inter-packet intervals were computed.
     * Check the Type enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string type = 3575610;</code>
     */
    private $type = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $avg_ms
     *           Average observed inter-packet interval in milliseconds.
     *     @type string $duration
     *           From how long ago in the past these intervals were observed.
     *           Check the Duration enum for the list of possible values.
     *     @type int|string $max_ms
     *           Maximum observed inter-packet interval in milliseconds.
     *     @type int|string $min_ms
     *           Minimum observed inter-packet interval in milliseconds.
     *     @type int|string $num_intervals
     *           Number of inter-packet intervals from which these statistics were derived.
     *     @type string $type
     *           The type of packets for which inter-packet intervals were computed.
     *           Check the Type enum for the list of possible values.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Compute\V1\Compute::initOnce();
        parent::__construct($data);
    }

    /**
     * Average observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 avg_ms = 204811827;</code>
     * @return int|string
     */
    public function getAvgMs()
    {
        return isset($this->avg_ms) ? $this->avg_ms : 0;
    }

    public function hasAvgMs()
    {
        return isset($this->avg_ms);
    }

    public function clearAvgMs()
    {
        unset($this->avg_ms);
    }

    /**
     * Average observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 avg_ms = 204811827;</code>
     * @param int|string $var
     * @return $this
     */
    public function setAvgMs($var)
    {
        GPBUtil::checkInt64($var);
        $this->avg_ms = $var;

        return $this;
    }

    /**
     * From how long ago in the past these intervals were observed.
     * Check the Duration enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string duration = 155471252;</code>
     * @return string
     */
    public function getDuration()
    {
        return isset($this->duration) ? $this->duration : '';
    }

    public function hasDuration()
    {
        return isset($this->duration);
    }

    public function clearDuration()
    {
        unset($this->duration);
    }

    /**
     * From how long ago in the past these intervals were observed.
     * Check the Duration enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string duration = 155471252;</code>
     * @param string $var
     * @return $this
     */
    public function setDuration($var)
    {
        GPBUtil::checkString($var, True);
        $this->duration = $var;

        return $this;
    }

    /**
     * Maximum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 max_ms = 529474145;</code>
     * @return int|string
     */
    public function getMaxMs()
    {
        return isset($this->max_ms) ? $this->max_ms : 0;
    }

    public function hasMaxMs()
    {
        return isset($this->max_ms);
    }

    public function clearMaxMs()
    {
        unset($this->max_ms);
    }

    /**
     * Maximum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 max_ms = 529474145;</code>
     * @param int|string $var
     * @return $this
     */
    public function setMaxMs($var)
    {
        GPBUtil::checkInt64($var);
        $this->max_ms = $var;

        return $this;
    }

    /**
     * Minimum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 min_ms = 536564403;</code>
     * @return int|string
     */
    public function getMinMs()
    {
        return isset($this->min_ms) ? $this->min_ms : 0;
    }

    public function hasMinMs()
    {
        return isset($this->min_ms);
    }

    public function clearMinMs()
    {
        unset($this->min_ms);
    }

    /**
     * Minimum observed inter-packet interval in milliseconds.
     *
     * Generated from protobuf field <code>optional int64 min_ms = 536564403;</code>
     * @param int|string $var
     * @return $this
     */
    public function setMinMs($var)
    {
        GPBUtil::checkInt64($var);
        $this->min_ms = $var;

        return $this;
    }

    /**
     * Number of inter-packet intervals from which these statistics were derived.
     *
     * Generated from protobuf field <code>optional int64 num_intervals = 186329813;</code>
     * @return int|string
     */
    public function getNumIntervals()
    {
        return isset($this->num_intervals) ? $this->num_intervals : 0;
    }

    public function hasNumIntervals()
    {
        return isset($this->num_intervals);
    }

    public function clearNumIntervals()
    {
        unset($this->num_intervals);
    }

    /**
     * Number of inter-packet intervals from which these statistics were derived.
     *
     * Generated from protobuf field <code>optional int64 num_intervals = 186329813;</code>
     * @param int|string $var
     * @return $this
     */
    public function setNumIntervals($var)
    {
        GPBUtil::checkInt64($var);
        $this->num_intervals = $var;

        return $this;
    }

    /**
     * The type of packets for which inter-packet intervals were computed.
     * Check the Type enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string type = 3575610;</code>
     * @return string
     */
    public function getType()
    {
        return isset($this->type) ? $this->type : '';
    }

    public function hasType()
    {
        return isset($this->type);
    }

    public function clearType()
    {
        unset($this->type);
    }

    /**
     * The type of packets for which inter-packet intervals were computed.
     * Check the Type enum for the list of possible values.
     *
     * Generated from protobuf field <code>optional string type = 3575610;</code>
     * @param string $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkString($var, True);
        $this->type = $var;

        return $this;
    }

}

