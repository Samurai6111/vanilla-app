<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vmwareengine/v1/vmwareengine.proto

namespace Google\Cloud\VmwareEngine\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Details about a vCenter Server management appliance.
 *
 * Generated from protobuf message <code>google.cloud.vmwareengine.v1.Vcenter</code>
 */
class Vcenter extends \Google\Protobuf\Internal\Message
{
    /**
     * Internal IP address of the appliance.
     *
     * Generated from protobuf field <code>string internal_ip = 2;</code>
     */
    private $internal_ip = '';
    /**
     * Version of the appliance.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     */
    private $version = '';
    /**
     * Output only. The state of the appliance.
     *
     * Generated from protobuf field <code>.google.cloud.vmwareengine.v1.Vcenter.State state = 5 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     */
    private $state = 0;
    /**
     * Fully qualified domain name of the appliance.
     *
     * Generated from protobuf field <code>string fqdn = 6;</code>
     */
    private $fqdn = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $internal_ip
     *           Internal IP address of the appliance.
     *     @type string $version
     *           Version of the appliance.
     *     @type int $state
     *           Output only. The state of the appliance.
     *     @type string $fqdn
     *           Fully qualified domain name of the appliance.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vmwareengine\V1\Vmwareengine::initOnce();
        parent::__construct($data);
    }

    /**
     * Internal IP address of the appliance.
     *
     * Generated from protobuf field <code>string internal_ip = 2;</code>
     * @return string
     */
    public function getInternalIp()
    {
        return $this->internal_ip;
    }

    /**
     * Internal IP address of the appliance.
     *
     * Generated from protobuf field <code>string internal_ip = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setInternalIp($var)
    {
        GPBUtil::checkString($var, True);
        $this->internal_ip = $var;

        return $this;
    }

    /**
     * Version of the appliance.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Version of the appliance.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->version = $var;

        return $this;
    }

    /**
     * Output only. The state of the appliance.
     *
     * Generated from protobuf field <code>.google.cloud.vmwareengine.v1.Vcenter.State state = 5 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Output only. The state of the appliance.
     *
     * Generated from protobuf field <code>.google.cloud.vmwareengine.v1.Vcenter.State state = 5 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param int $var
     * @return $this
     */
    public function setState($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\VmwareEngine\V1\Vcenter\State::class);
        $this->state = $var;

        return $this;
    }

    /**
     * Fully qualified domain name of the appliance.
     *
     * Generated from protobuf field <code>string fqdn = 6;</code>
     * @return string
     */
    public function getFqdn()
    {
        return $this->fqdn;
    }

    /**
     * Fully qualified domain name of the appliance.
     *
     * Generated from protobuf field <code>string fqdn = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setFqdn($var)
    {
        GPBUtil::checkString($var, True);
        $this->fqdn = $var;

        return $this;
    }

}

