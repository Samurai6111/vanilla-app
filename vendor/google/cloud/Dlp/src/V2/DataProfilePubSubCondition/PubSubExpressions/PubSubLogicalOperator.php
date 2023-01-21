<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2\DataProfilePubSubCondition\PubSubExpressions;

use UnexpectedValueException;

/**
 * Logical operators for conditional checks.
 *
 * Protobuf type <code>google.privacy.dlp.v2.DataProfilePubSubCondition.PubSubExpressions.PubSubLogicalOperator</code>
 */
class PubSubLogicalOperator
{
    /**
     * Unused.
     *
     * Generated from protobuf enum <code>LOGICAL_OPERATOR_UNSPECIFIED = 0;</code>
     */
    const LOGICAL_OPERATOR_UNSPECIFIED = 0;
    /**
     * Conditional OR.
     *
     * Generated from protobuf enum <code>OR = 1;</code>
     */
    const PBOR = 1;
    /**
     * Conditional AND.
     *
     * Generated from protobuf enum <code>AND = 2;</code>
     */
    const PBAND = 2;

    private static $valueToName = [
        self::LOGICAL_OPERATOR_UNSPECIFIED => 'LOGICAL_OPERATOR_UNSPECIFIED',
        self::PBOR => 'OR',
        self::PBAND => 'AND',
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
            $pbconst =  __CLASS__. '::PB' . strtoupper($name);
            if (!defined($pbconst)) {
                throw new UnexpectedValueException(sprintf(
                        'Enum %s has no value defined for name %s', __CLASS__, $name));
            }
            return constant($pbconst);
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PubSubLogicalOperator::class, \Google\Cloud\Dlp\V2\DataProfilePubSubCondition_PubSubExpressions_PubSubLogicalOperator::class);

