<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/analytics/admin/v1alpha/analytics_admin.proto

namespace Google\Analytics\Admin\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for UpdateAttributionSettings RPC
 *
 * Generated from protobuf message <code>google.analytics.admin.v1alpha.UpdateAttributionSettingsRequest</code>
 */
class UpdateAttributionSettingsRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The attribution settings to update.
     * The `name` field is used to identify the settings to be updated.
     *
     * Generated from protobuf field <code>.google.analytics.admin.v1alpha.AttributionSettings attribution_settings = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $attribution_settings = null;
    /**
     * Required. The list of fields to be updated. Field names must be in snake case
     * (e.g., "field_to_update"). Omitted fields will not be updated. To replace
     * the entire entity, use one path with the string "*" to match all fields.
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
     *     @type \Google\Analytics\Admin\V1alpha\AttributionSettings $attribution_settings
     *           Required. The attribution settings to update.
     *           The `name` field is used to identify the settings to be updated.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Required. The list of fields to be updated. Field names must be in snake case
     *           (e.g., "field_to_update"). Omitted fields will not be updated. To replace
     *           the entire entity, use one path with the string "*" to match all fields.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Analytics\Admin\V1Alpha\AnalyticsAdmin::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The attribution settings to update.
     * The `name` field is used to identify the settings to be updated.
     *
     * Generated from protobuf field <code>.google.analytics.admin.v1alpha.AttributionSettings attribution_settings = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Analytics\Admin\V1alpha\AttributionSettings|null
     */
    public function getAttributionSettings()
    {
        return $this->attribution_settings;
    }

    public function hasAttributionSettings()
    {
        return isset($this->attribution_settings);
    }

    public function clearAttributionSettings()
    {
        unset($this->attribution_settings);
    }

    /**
     * Required. The attribution settings to update.
     * The `name` field is used to identify the settings to be updated.
     *
     * Generated from protobuf field <code>.google.analytics.admin.v1alpha.AttributionSettings attribution_settings = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Analytics\Admin\V1alpha\AttributionSettings $var
     * @return $this
     */
    public function setAttributionSettings($var)
    {
        GPBUtil::checkMessage($var, \Google\Analytics\Admin\V1alpha\AttributionSettings::class);
        $this->attribution_settings = $var;

        return $this;
    }

    /**
     * Required. The list of fields to be updated. Field names must be in snake case
     * (e.g., "field_to_update"). Omitted fields will not be updated. To replace
     * the entire entity, use one path with the string "*" to match all fields.
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
     * Required. The list of fields to be updated. Field names must be in snake case
     * (e.g., "field_to_update"). Omitted fields will not be updated. To replace
     * the entire entity, use one path with the string "*" to match all fields.
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

