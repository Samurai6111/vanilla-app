<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v2/cloud_speech.proto

namespace Google\Cloud\Speech\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Final results for a single file.
 *
 * Generated from protobuf message <code>google.cloud.speech.v2.BatchRecognizeFileResult</code>
 */
class BatchRecognizeFileResult extends \Google\Protobuf\Internal\Message
{
    /**
     * The GCS URI to which recognition results were written.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     */
    private $uri = '';
    /**
     * Error if one was encountered.
     *
     * Generated from protobuf field <code>.google.rpc.Status error = 2;</code>
     */
    private $error = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $uri
     *           The GCS URI to which recognition results were written.
     *     @type \Google\Rpc\Status $error
     *           Error if one was encountered.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Speech\V2\CloudSpeech::initOnce();
        parent::__construct($data);
    }

    /**
     * The GCS URI to which recognition results were written.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * The GCS URI to which recognition results were written.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->uri = $var;

        return $this;
    }

    /**
     * Error if one was encountered.
     *
     * Generated from protobuf field <code>.google.rpc.Status error = 2;</code>
     * @return \Google\Rpc\Status|null
     */
    public function getError()
    {
        return $this->error;
    }

    public function hasError()
    {
        return isset($this->error);
    }

    public function clearError()
    {
        unset($this->error);
    }

    /**
     * Error if one was encountered.
     *
     * Generated from protobuf field <code>.google.rpc.Status error = 2;</code>
     * @param \Google\Rpc\Status $var
     * @return $this
     */
    public function setError($var)
    {
        GPBUtil::checkMessage($var, \Google\Rpc\Status::class);
        $this->error = $var;

        return $this;
    }

}

