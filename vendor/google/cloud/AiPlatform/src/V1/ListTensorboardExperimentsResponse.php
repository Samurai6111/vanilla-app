<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/tensorboard_service.proto

namespace Google\Cloud\AIPlatform\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Response message for [TensorboardService.ListTensorboardExperiments][google.cloud.aiplatform.v1.TensorboardService.ListTensorboardExperiments].
 *
 * Generated from protobuf message <code>google.cloud.aiplatform.v1.ListTensorboardExperimentsResponse</code>
 */
class ListTensorboardExperimentsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The TensorboardExperiments mathching the request.
     *
     * Generated from protobuf field <code>repeated .google.cloud.aiplatform.v1.TensorboardExperiment tensorboard_experiments = 1;</code>
     */
    private $tensorboard_experiments;
    /**
     * A token, which can be sent as
     * [ListTensorboardExperimentsRequest.page_token][google.cloud.aiplatform.v1.ListTensorboardExperimentsRequest.page_token] to retrieve the next page.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\AIPlatform\V1\TensorboardExperiment>|\Google\Protobuf\Internal\RepeatedField $tensorboard_experiments
     *           The TensorboardExperiments mathching the request.
     *     @type string $next_page_token
     *           A token, which can be sent as
     *           [ListTensorboardExperimentsRequest.page_token][google.cloud.aiplatform.v1.ListTensorboardExperimentsRequest.page_token] to retrieve the next page.
     *           If this field is omitted, there are no subsequent pages.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Aiplatform\V1\TensorboardService::initOnce();
        parent::__construct($data);
    }

    /**
     * The TensorboardExperiments mathching the request.
     *
     * Generated from protobuf field <code>repeated .google.cloud.aiplatform.v1.TensorboardExperiment tensorboard_experiments = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTensorboardExperiments()
    {
        return $this->tensorboard_experiments;
    }

    /**
     * The TensorboardExperiments mathching the request.
     *
     * Generated from protobuf field <code>repeated .google.cloud.aiplatform.v1.TensorboardExperiment tensorboard_experiments = 1;</code>
     * @param array<\Google\Cloud\AIPlatform\V1\TensorboardExperiment>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTensorboardExperiments($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\AIPlatform\V1\TensorboardExperiment::class);
        $this->tensorboard_experiments = $arr;

        return $this;
    }

    /**
     * A token, which can be sent as
     * [ListTensorboardExperimentsRequest.page_token][google.cloud.aiplatform.v1.ListTensorboardExperimentsRequest.page_token] to retrieve the next page.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * A token, which can be sent as
     * [ListTensorboardExperimentsRequest.page_token][google.cloud.aiplatform.v1.ListTensorboardExperimentsRequest.page_token] to retrieve the next page.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

}

