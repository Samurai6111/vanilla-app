<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/cloudbuild/v1/cloudbuild.proto

namespace Google\Cloud\Build\V1\PubsubConfig;

use UnexpectedValueException;

/**
 * Enumerates potential issues with the underlying Pub/Sub subscription
 * configuration.
 *
 * Protobuf type <code>google.devtools.cloudbuild.v1.PubsubConfig.State</code>
 */
class State
{
    /**
     * The subscription configuration has not been checked.
     *
     * Generated from protobuf enum <code>STATE_UNSPECIFIED = 0;</code>
     */
    const STATE_UNSPECIFIED = 0;
    /**
     * The Pub/Sub subscription is properly configured.
     *
     * Generated from protobuf enum <code>OK = 1;</code>
     */
    const OK = 1;
    /**
     * The subscription has been deleted.
     *
     * Generated from protobuf enum <code>SUBSCRIPTION_DELETED = 2;</code>
     */
    const SUBSCRIPTION_DELETED = 2;
    /**
     * The topic has been deleted.
     *
     * Generated from protobuf enum <code>TOPIC_DELETED = 3;</code>
     */
    const TOPIC_DELETED = 3;
    /**
     * Some of the subscription's field are misconfigured.
     *
     * Generated from protobuf enum <code>SUBSCRIPTION_MISCONFIGURED = 4;</code>
     */
    const SUBSCRIPTION_MISCONFIGURED = 4;

    private static $valueToName = [
        self::STATE_UNSPECIFIED => 'STATE_UNSPECIFIED',
        self::OK => 'OK',
        self::SUBSCRIPTION_DELETED => 'SUBSCRIPTION_DELETED',
        self::TOPIC_DELETED => 'TOPIC_DELETED',
        self::SUBSCRIPTION_MISCONFIGURED => 'SUBSCRIPTION_MISCONFIGURED',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(State::class, \Google\Cloud\Build\V1\PubsubConfig_State::class);

