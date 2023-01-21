<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dataplex/v1/resources.proto

namespace Google\Cloud\Dataplex\V1\Action;

use UnexpectedValueException;

/**
 * The category of issues.
 *
 * Protobuf type <code>google.cloud.dataplex.v1.Action.Category</code>
 */
class Category
{
    /**
     * Unspecified category.
     *
     * Generated from protobuf enum <code>CATEGORY_UNSPECIFIED = 0;</code>
     */
    const CATEGORY_UNSPECIFIED = 0;
    /**
     * Resource management related issues.
     *
     * Generated from protobuf enum <code>RESOURCE_MANAGEMENT = 1;</code>
     */
    const RESOURCE_MANAGEMENT = 1;
    /**
     * Security policy related issues.
     *
     * Generated from protobuf enum <code>SECURITY_POLICY = 2;</code>
     */
    const SECURITY_POLICY = 2;
    /**
     * Data and discovery related issues.
     *
     * Generated from protobuf enum <code>DATA_DISCOVERY = 3;</code>
     */
    const DATA_DISCOVERY = 3;

    private static $valueToName = [
        self::CATEGORY_UNSPECIFIED => 'CATEGORY_UNSPECIFIED',
        self::RESOURCE_MANAGEMENT => 'RESOURCE_MANAGEMENT',
        self::SECURITY_POLICY => 'SECURITY_POLICY',
        self::DATA_DISCOVERY => 'DATA_DISCOVERY',
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


