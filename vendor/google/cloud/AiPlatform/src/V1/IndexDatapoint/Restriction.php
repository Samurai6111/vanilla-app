<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/index.proto

namespace Google\Cloud\AIPlatform\V1\IndexDatapoint;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Restriction of a datapoint which describe its attributes(tokens) from each
 * of several attribute categories(namespaces).
 *
 * Generated from protobuf message <code>google.cloud.aiplatform.v1.IndexDatapoint.Restriction</code>
 */
class Restriction extends \Google\Protobuf\Internal\Message
{
    /**
     * The namespace of this restriction. eg: color.
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     */
    private $namespace = '';
    /**
     * The attributes to allow in this namespace. eg: 'red'
     *
     * Generated from protobuf field <code>repeated string allow_list = 2;</code>
     */
    private $allow_list;
    /**
     * The attributes to deny in this namespace. eg: 'blue'
     *
     * Generated from protobuf field <code>repeated string deny_list = 3;</code>
     */
    private $deny_list;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $namespace
     *           The namespace of this restriction. eg: color.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $allow_list
     *           The attributes to allow in this namespace. eg: 'red'
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $deny_list
     *           The attributes to deny in this namespace. eg: 'blue'
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Aiplatform\V1\Index::initOnce();
        parent::__construct($data);
    }

    /**
     * The namespace of this restriction. eg: color.
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * The namespace of this restriction. eg: color.
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->namespace = $var;

        return $this;
    }

    /**
     * The attributes to allow in this namespace. eg: 'red'
     *
     * Generated from protobuf field <code>repeated string allow_list = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAllowList()
    {
        return $this->allow_list;
    }

    /**
     * The attributes to allow in this namespace. eg: 'red'
     *
     * Generated from protobuf field <code>repeated string allow_list = 2;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAllowList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->allow_list = $arr;

        return $this;
    }

    /**
     * The attributes to deny in this namespace. eg: 'blue'
     *
     * Generated from protobuf field <code>repeated string deny_list = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDenyList()
    {
        return $this->deny_list;
    }

    /**
     * The attributes to deny in this namespace. eg: 'blue'
     *
     * Generated from protobuf field <code>repeated string deny_list = 3;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDenyList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->deny_list = $arr;

        return $this;
    }

}

