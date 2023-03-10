<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1\InterconnectDiagnosticsLinkStatus;

use UnexpectedValueException;

/**
 * The operational status of the link.
 *
 * Protobuf type <code>google.cloud.compute.v1.InterconnectDiagnosticsLinkStatus.OperationalStatus</code>
 */
class OperationalStatus
{
    /**
     * A value indicating that the enum field is not set.
     *
     * Generated from protobuf enum <code>UNDEFINED_OPERATIONAL_STATUS = 0;</code>
     */
    const UNDEFINED_OPERATIONAL_STATUS = 0;
    /**
     * The interface is unable to communicate with the remote end.
     *
     * Generated from protobuf enum <code>LINK_OPERATIONAL_STATUS_DOWN = 281653885;</code>
     */
    const LINK_OPERATIONAL_STATUS_DOWN = 281653885;
    /**
     * The interface has low level communication with the remote end.
     *
     * Generated from protobuf enum <code>LINK_OPERATIONAL_STATUS_UP = 305879862;</code>
     */
    const LINK_OPERATIONAL_STATUS_UP = 305879862;

    private static $valueToName = [
        self::UNDEFINED_OPERATIONAL_STATUS => 'UNDEFINED_OPERATIONAL_STATUS',
        self::LINK_OPERATIONAL_STATUS_DOWN => 'LINK_OPERATIONAL_STATUS_DOWN',
        self::LINK_OPERATIONAL_STATUS_UP => 'LINK_OPERATIONAL_STATUS_UP',
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


