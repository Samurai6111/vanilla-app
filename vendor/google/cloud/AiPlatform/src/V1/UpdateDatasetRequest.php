<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/dataset_service.proto

namespace Google\Cloud\AIPlatform\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for [DatasetService.UpdateDataset][google.cloud.aiplatform.v1.DatasetService.UpdateDataset].
 *
 * Generated from protobuf message <code>google.cloud.aiplatform.v1.UpdateDatasetRequest</code>
 */
class UpdateDatasetRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The Dataset which replaces the resource on the server.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.Dataset dataset = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $dataset = null;
    /**
     * Required. The update mask applies to the resource.
     * For the `FieldMask` definition, see [google.protobuf.FieldMask][google.protobuf.FieldMask].
     * Updatable fields:
     *   * `display_name`
     *   * `description`
     *   * `labels`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $update_mask = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\AIPlatform\V1\Dataset $dataset
     *           Required. The Dataset which replaces the resource on the server.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Required. The update mask applies to the resource.
     *           For the `FieldMask` definition, see [google.protobuf.FieldMask][google.protobuf.FieldMask].
     *           Updatable fields:
     *             * `display_name`
     *             * `description`
     *             * `labels`
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Aiplatform\V1\DatasetService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The Dataset which replaces the resource on the server.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.Dataset dataset = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\AIPlatform\V1\Dataset|null
     */
    public function getDataset()
    {
        return $this->dataset;
    }

    public function hasDataset()
    {
        return isset($this->dataset);
    }

    public function clearDataset()
    {
        unset($this->dataset);
    }

    /**
     * Required. The Dataset which replaces the resource on the server.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.Dataset dataset = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\AIPlatform\V1\Dataset $var
     * @return $this
     */
    public function setDataset($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AIPlatform\V1\Dataset::class);
        $this->dataset = $var;

        return $this;
    }

    /**
     * Required. The update mask applies to the resource.
     * For the `FieldMask` definition, see [google.protobuf.FieldMask][google.protobuf.FieldMask].
     * Updatable fields:
     *   * `display_name`
     *   * `description`
     *   * `labels`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }

    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }

    /**
     * Required. The update mask applies to the resource.
     * For the `FieldMask` definition, see [google.protobuf.FieldMask][google.protobuf.FieldMask].
     * Updatable fields:
     *   * `display_name`
     *   * `description`
     *   * `labels`
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}

