<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/gkemulticloud/v1/aws_service.proto

namespace Google\Cloud\GkeMultiCloud\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for `AwsClusters.GetAwsCluster` method.
 *
 * Generated from protobuf message <code>google.cloud.gkemulticloud.v1.GetAwsClusterRequest</code>
 */
class GetAwsClusterRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The name of the [AwsCluster][google.cloud.gkemulticloud.v1.AwsCluster] resource to describe.
     * `AwsCluster` names are formatted as
     * `projects/<project-id>/locations/<region>/awsClusters/<cluster-id>`.
     * See [Resource Names](https://cloud.google.com/apis/design/resource_names)
     * for more details on GCP resource names.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Required. The name of the [AwsCluster][google.cloud.gkemulticloud.v1.AwsCluster] resource to describe.
     *           `AwsCluster` names are formatted as
     *           `projects/<project-id>/locations/<region>/awsClusters/<cluster-id>`.
     *           See [Resource Names](https://cloud.google.com/apis/design/resource_names)
     *           for more details on GCP resource names.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Gkemulticloud\V1\AwsService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The name of the [AwsCluster][google.cloud.gkemulticloud.v1.AwsCluster] resource to describe.
     * `AwsCluster` names are formatted as
     * `projects/<project-id>/locations/<region>/awsClusters/<cluster-id>`.
     * See [Resource Names](https://cloud.google.com/apis/design/resource_names)
     * for more details on GCP resource names.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. The name of the [AwsCluster][google.cloud.gkemulticloud.v1.AwsCluster] resource to describe.
     * `AwsCluster` names are formatted as
     * `projects/<project-id>/locations/<region>/awsClusters/<cluster-id>`.
     * See [Resource Names](https://cloud.google.com/apis/design/resource_names)
     * for more details on GCP resource names.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

}

