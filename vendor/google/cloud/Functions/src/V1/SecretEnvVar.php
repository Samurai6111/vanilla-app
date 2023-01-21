<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/functions/v1/functions.proto

namespace Google\Cloud\Functions\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Configuration for a secret environment variable. It has the information
 * necessary to fetch the secret value from secret manager and expose it as an
 * environment variable.
 *
 * Generated from protobuf message <code>google.cloud.functions.v1.SecretEnvVar</code>
 */
class SecretEnvVar extends \Google\Protobuf\Internal\Message
{
    /**
     * Name of the environment variable.
     *
     * Generated from protobuf field <code>string key = 1;</code>
     */
    private $key = '';
    /**
     * Project identifier (preferrably project number but can also be the project
     * ID) of the project that contains the secret. If not set, it will be
     * populated with the function's project assuming that the secret exists in
     * the same project as of the function.
     *
     * Generated from protobuf field <code>string project_id = 2;</code>
     */
    private $project_id = '';
    /**
     * Name of the secret in secret manager (not the full resource name).
     *
     * Generated from protobuf field <code>string secret = 3;</code>
     */
    private $secret = '';
    /**
     * Version of the secret (version number or the string 'latest'). It is
     * recommended to use a numeric version for secret environment variables as
     * any updates to the secret value is not reflected until new instances start.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     */
    private $version = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $key
     *           Name of the environment variable.
     *     @type string $project_id
     *           Project identifier (preferrably project number but can also be the project
     *           ID) of the project that contains the secret. If not set, it will be
     *           populated with the function's project assuming that the secret exists in
     *           the same project as of the function.
     *     @type string $secret
     *           Name of the secret in secret manager (not the full resource name).
     *     @type string $version
     *           Version of the secret (version number or the string 'latest'). It is
     *           recommended to use a numeric version for secret environment variables as
     *           any updates to the secret value is not reflected until new instances start.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Functions\V1\Functions::initOnce();
        parent::__construct($data);
    }

    /**
     * Name of the environment variable.
     *
     * Generated from protobuf field <code>string key = 1;</code>
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Name of the environment variable.
     *
     * Generated from protobuf field <code>string key = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->key = $var;

        return $this;
    }

    /**
     * Project identifier (preferrably project number but can also be the project
     * ID) of the project that contains the secret. If not set, it will be
     * populated with the function's project assuming that the secret exists in
     * the same project as of the function.
     *
     * Generated from protobuf field <code>string project_id = 2;</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Project identifier (preferrably project number but can also be the project
     * ID) of the project that contains the secret. If not set, it will be
     * populated with the function's project assuming that the secret exists in
     * the same project as of the function.
     *
     * Generated from protobuf field <code>string project_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * Name of the secret in secret manager (not the full resource name).
     *
     * Generated from protobuf field <code>string secret = 3;</code>
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Name of the secret in secret manager (not the full resource name).
     *
     * Generated from protobuf field <code>string secret = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSecret($var)
    {
        GPBUtil::checkString($var, True);
        $this->secret = $var;

        return $this;
    }

    /**
     * Version of the secret (version number or the string 'latest'). It is
     * recommended to use a numeric version for secret environment variables as
     * any updates to the secret value is not reflected until new instances start.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Version of the secret (version number or the string 'latest'). It is
     * recommended to use a numeric version for secret environment variables as
     * any updates to the secret value is not reflected until new instances start.
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

}
