<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1\InterconnectDiagnostics;

use UnexpectedValueException;

/**
 * The aggregation type of the bundle interface.
 *
 * Protobuf type <code>google.cloud.compute.v1.InterconnectDiagnostics.BundleAggregationType</code>
 */
class BundleAggregationType
{
    /**
     * A value indicating that the enum field is not set.
     *
     * Generated from protobuf enum <code>UNDEFINED_BUNDLE_AGGREGATION_TYPE = 0;</code>
     */
    const UNDEFINED_BUNDLE_AGGREGATION_TYPE = 0;
    /**
     * LACP is enabled.
     *
     * Generated from protobuf enum <code>BUNDLE_AGGREGATION_TYPE_LACP = 27758925;</code>
     */
    const BUNDLE_AGGREGATION_TYPE_LACP = 27758925;
    /**
     * LACP is disabled.
     *
     * Generated from protobuf enum <code>BUNDLE_AGGREGATION_TYPE_STATIC = 50678873;</code>
     */
    const BUNDLE_AGGREGATION_TYPE_STATIC = 50678873;

    private static $valueToName = [
        self::UNDEFINED_BUNDLE_AGGREGATION_TYPE => 'UNDEFINED_BUNDLE_AGGREGATION_TYPE',
        self::BUNDLE_AGGREGATION_TYPE_LACP => 'BUNDLE_AGGREGATION_TYPE_LACP',
        self::BUNDLE_AGGREGATION_TYPE_STATIC => 'BUNDLE_AGGREGATION_TYPE_STATIC',
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


