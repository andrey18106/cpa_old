<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: db.proto

namespace OCA\Cloud_Py_API\Proto;

use UnexpectedValueException;

/**
 * Protobuf type <code>OCA.Cloud_Py_API.Proto.pValueType</code>
 */
class pValueType
{
    /**
     * Generated from protobuf enum <code>NULL = 0;</code>
     */
    const NULL = 0;
    /**
     * Generated from protobuf enum <code>BOOL = 1;</code>
     */
    const BOOL = 1;
    /**
     * Generated from protobuf enum <code>INT = 2;</code>
     */
    const INT = 2;
    /**
     * Generated from protobuf enum <code>STR = 3;</code>
     */
    const STR = 3;
    /**
     * Generated from protobuf enum <code>LOB = 4;</code>
     */
    const LOB = 4;
    /**
     * Generated from protobuf enum <code>DATE = 5;</code>
     */
    const DATE = 5;
    /**
     * Generated from protobuf enum <code>INT_ARRAY = 6;</code>
     */
    const INT_ARRAY = 6;
    /**
     * Generated from protobuf enum <code>STR_ARRAY = 7;</code>
     */
    const STR_ARRAY = 7;

    private static $valueToName = [
        self::NULL => 'NULL',
        self::BOOL => 'BOOL',
        self::INT => 'INT',
        self::STR => 'STR',
        self::LOB => 'LOB',
        self::DATE => 'DATE',
        self::INT_ARRAY => 'INT_ARRAY',
        self::STR_ARRAY => 'STR_ARRAY',
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

