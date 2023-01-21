<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/datastream/v1/datastream_resources.proto

namespace Google\Cloud\Datastream\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Forward SSH Tunnel connectivity.
 *
 * Generated from protobuf message <code>google.cloud.datastream.v1.ForwardSshTunnelConnectivity</code>
 */
class ForwardSshTunnelConnectivity extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Hostname for the SSH tunnel.
     *
     * Generated from protobuf field <code>string hostname = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $hostname = '';
    /**
     * Required. Username for the SSH tunnel.
     *
     * Generated from protobuf field <code>string username = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $username = '';
    /**
     * Port for the SSH tunnel, default value is 22.
     *
     * Generated from protobuf field <code>int32 port = 3;</code>
     */
    private $port = 0;
    protected $authentication_method;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $hostname
     *           Required. Hostname for the SSH tunnel.
     *     @type string $username
     *           Required. Username for the SSH tunnel.
     *     @type int $port
     *           Port for the SSH tunnel, default value is 22.
     *     @type string $password
     *           Input only. SSH password.
     *     @type string $private_key
     *           Input only. SSH private key.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Datastream\V1\DatastreamResources::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Hostname for the SSH tunnel.
     *
     * Generated from protobuf field <code>string hostname = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Required. Hostname for the SSH tunnel.
     *
     * Generated from protobuf field <code>string hostname = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setHostname($var)
    {
        GPBUtil::checkString($var, True);
        $this->hostname = $var;

        return $this;
    }

    /**
     * Required. Username for the SSH tunnel.
     *
     * Generated from protobuf field <code>string username = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Required. Username for the SSH tunnel.
     *
     * Generated from protobuf field <code>string username = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setUsername($var)
    {
        GPBUtil::checkString($var, True);
        $this->username = $var;

        return $this;
    }

    /**
     * Port for the SSH tunnel, default value is 22.
     *
     * Generated from protobuf field <code>int32 port = 3;</code>
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Port for the SSH tunnel, default value is 22.
     *
     * Generated from protobuf field <code>int32 port = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setPort($var)
    {
        GPBUtil::checkInt32($var);
        $this->port = $var;

        return $this;
    }

    /**
     * Input only. SSH password.
     *
     * Generated from protobuf field <code>string password = 100 [(.google.api.field_behavior) = INPUT_ONLY];</code>
     * @return string
     */
    public function getPassword()
    {
        return $this->readOneof(100);
    }

    public function hasPassword()
    {
        return $this->hasOneof(100);
    }

    /**
     * Input only. SSH password.
     *
     * Generated from protobuf field <code>string password = 100 [(.google.api.field_behavior) = INPUT_ONLY];</code>
     * @param string $var
     * @return $this
     */
    public function setPassword($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(100, $var);

        return $this;
    }

    /**
     * Input only. SSH private key.
     *
     * Generated from protobuf field <code>string private_key = 101 [(.google.api.field_behavior) = INPUT_ONLY];</code>
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->readOneof(101);
    }

    public function hasPrivateKey()
    {
        return $this->hasOneof(101);
    }

    /**
     * Input only. SSH private key.
     *
     * Generated from protobuf field <code>string private_key = 101 [(.google.api.field_behavior) = INPUT_ONLY];</code>
     * @param string $var
     * @return $this
     */
    public function setPrivateKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(101, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthenticationMethod()
    {
        return $this->whichOneof("authentication_method");
    }

}

