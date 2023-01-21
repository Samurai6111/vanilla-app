<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/orchestration/airflow/service/v1/environments.proto

namespace Google\Cloud\Orchestration\Airflow\Service\V1\WebServerNetworkAccessControl;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Allowed IP range with user-provided description.
 *
 * Generated from protobuf message <code>google.cloud.orchestration.airflow.service.v1.WebServerNetworkAccessControl.AllowedIpRange</code>
 */
class AllowedIpRange extends \Google\Protobuf\Internal\Message
{
    /**
     * IP address or range, defined using CIDR notation, of requests that this
     * rule applies to.
     * Examples: `192.168.1.1` or `192.168.0.0/16` or `2001:db8::/32`
     *           or `2001:0db8:0000:0042:0000:8a2e:0370:7334`.
     * IP range prefixes should be properly truncated. For example,
     * `1.2.3.4/24` should be truncated to `1.2.3.0/24`. Similarly, for IPv6,
     * `2001:db8::1/32` should be truncated to `2001:db8::/32`.
     *
     * Generated from protobuf field <code>string value = 1;</code>
     */
    private $value = '';
    /**
     * Optional. User-provided description. It must contain at most 300 characters.
     *
     * Generated from protobuf field <code>string description = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $description = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $value
     *           IP address or range, defined using CIDR notation, of requests that this
     *           rule applies to.
     *           Examples: `192.168.1.1` or `192.168.0.0/16` or `2001:db8::/32`
     *                     or `2001:0db8:0000:0042:0000:8a2e:0370:7334`.
     *           IP range prefixes should be properly truncated. For example,
     *           `1.2.3.4/24` should be truncated to `1.2.3.0/24`. Similarly, for IPv6,
     *           `2001:db8::1/32` should be truncated to `2001:db8::/32`.
     *     @type string $description
     *           Optional. User-provided description. It must contain at most 300 characters.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Orchestration\Airflow\Service\V1\Environments::initOnce();
        parent::__construct($data);
    }

    /**
     * IP address or range, defined using CIDR notation, of requests that this
     * rule applies to.
     * Examples: `192.168.1.1` or `192.168.0.0/16` or `2001:db8::/32`
     *           or `2001:0db8:0000:0042:0000:8a2e:0370:7334`.
     * IP range prefixes should be properly truncated. For example,
     * `1.2.3.4/24` should be truncated to `1.2.3.0/24`. Similarly, for IPv6,
     * `2001:db8::1/32` should be truncated to `2001:db8::/32`.
     *
     * Generated from protobuf field <code>string value = 1;</code>
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * IP address or range, defined using CIDR notation, of requests that this
     * rule applies to.
     * Examples: `192.168.1.1` or `192.168.0.0/16` or `2001:db8::/32`
     *           or `2001:0db8:0000:0042:0000:8a2e:0370:7334`.
     * IP range prefixes should be properly truncated. For example,
     * `1.2.3.4/24` should be truncated to `1.2.3.0/24`. Similarly, for IPv6,
     * `2001:db8::1/32` should be truncated to `2001:db8::/32`.
     *
     * Generated from protobuf field <code>string value = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setValue($var)
    {
        GPBUtil::checkString($var, True);
        $this->value = $var;

        return $this;
    }

    /**
     * Optional. User-provided description. It must contain at most 300 characters.
     *
     * Generated from protobuf field <code>string description = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Optional. User-provided description. It must contain at most 300 characters.
     *
     * Generated from protobuf field <code>string description = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

}

