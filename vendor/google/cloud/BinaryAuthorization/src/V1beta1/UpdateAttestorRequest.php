<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/binaryauthorization/v1beta1/service.proto

namespace Google\Cloud\BinaryAuthorization\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for [BinauthzManagementService.UpdateAttestor][].
 *
 * Generated from protobuf message <code>google.cloud.binaryauthorization.v1beta1.UpdateAttestorRequest</code>
 */
class UpdateAttestorRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The updated [attestor][google.cloud.binaryauthorization.v1beta1.Attestor] value. The service will
     * overwrite the [attestor name][google.cloud.binaryauthorization.v1beta1.Attestor.name] field with the resource name
     * in the request URL, in the format `projects/&#42;&#47;attestors/&#42;`.
     *
     * Generated from protobuf field <code>.google.cloud.binaryauthorization.v1beta1.Attestor attestor = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $attestor = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\BinaryAuthorization\V1beta1\Attestor $attestor
     *           Required. The updated [attestor][google.cloud.binaryauthorization.v1beta1.Attestor] value. The service will
     *           overwrite the [attestor name][google.cloud.binaryauthorization.v1beta1.Attestor.name] field with the resource name
     *           in the request URL, in the format `projects/&#42;&#47;attestors/&#42;`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Binaryauthorization\V1Beta1\Service::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The updated [attestor][google.cloud.binaryauthorization.v1beta1.Attestor] value. The service will
     * overwrite the [attestor name][google.cloud.binaryauthorization.v1beta1.Attestor.name] field with the resource name
     * in the request URL, in the format `projects/&#42;&#47;attestors/&#42;`.
     *
     * Generated from protobuf field <code>.google.cloud.binaryauthorization.v1beta1.Attestor attestor = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\BinaryAuthorization\V1beta1\Attestor|null
     */
    public function getAttestor()
    {
        return $this->attestor;
    }

    public function hasAttestor()
    {
        return isset($this->attestor);
    }

    public function clearAttestor()
    {
        unset($this->attestor);
    }

    /**
     * Required. The updated [attestor][google.cloud.binaryauthorization.v1beta1.Attestor] value. The service will
     * overwrite the [attestor name][google.cloud.binaryauthorization.v1beta1.Attestor.name] field with the resource name
     * in the request URL, in the format `projects/&#42;&#47;attestors/&#42;`.
     *
     * Generated from protobuf field <code>.google.cloud.binaryauthorization.v1beta1.Attestor attestor = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\BinaryAuthorization\V1beta1\Attestor $var
     * @return $this
     */
    public function setAttestor($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\BinaryAuthorization\V1beta1\Attestor::class);
        $this->attestor = $var;

        return $this;
    }

}

