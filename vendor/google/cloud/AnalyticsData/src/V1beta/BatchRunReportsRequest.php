<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/analytics/data/v1beta/analytics_data_api.proto

namespace Google\Analytics\Data\V1beta;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The batch request containing multiple report requests.
 *
 * Generated from protobuf message <code>google.analytics.data.v1beta.BatchRunReportsRequest</code>
 */
class BatchRunReportsRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * A Google Analytics GA4 property identifier whose events are tracked.
     * Specified in the URL path and not the body. To learn more, see [where to
     * find your Property
     * ID](https://developers.google.com/analytics/devguides/reporting/data/v1/property-id).
     * This property must be specified for the batch. The property within
     * RunReportRequest may either be unspecified or consistent with this
     * property.
     * Example: properties/1234
     *
     * Generated from protobuf field <code>string property = 1;</code>
     */
    private $property = '';
    /**
     * Individual requests. Each request has a separate report response. Each
     * batch request is allowed up to 5 requests.
     *
     * Generated from protobuf field <code>repeated .google.analytics.data.v1beta.RunReportRequest requests = 2;</code>
     */
    private $requests;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $property
     *           A Google Analytics GA4 property identifier whose events are tracked.
     *           Specified in the URL path and not the body. To learn more, see [where to
     *           find your Property
     *           ID](https://developers.google.com/analytics/devguides/reporting/data/v1/property-id).
     *           This property must be specified for the batch. The property within
     *           RunReportRequest may either be unspecified or consistent with this
     *           property.
     *           Example: properties/1234
     *     @type array<\Google\Analytics\Data\V1beta\RunReportRequest>|\Google\Protobuf\Internal\RepeatedField $requests
     *           Individual requests. Each request has a separate report response. Each
     *           batch request is allowed up to 5 requests.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Analytics\Data\V1Beta\AnalyticsDataApi::initOnce();
        parent::__construct($data);
    }

    /**
     * A Google Analytics GA4 property identifier whose events are tracked.
     * Specified in the URL path and not the body. To learn more, see [where to
     * find your Property
     * ID](https://developers.google.com/analytics/devguides/reporting/data/v1/property-id).
     * This property must be specified for the batch. The property within
     * RunReportRequest may either be unspecified or consistent with this
     * property.
     * Example: properties/1234
     *
     * Generated from protobuf field <code>string property = 1;</code>
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * A Google Analytics GA4 property identifier whose events are tracked.
     * Specified in the URL path and not the body. To learn more, see [where to
     * find your Property
     * ID](https://developers.google.com/analytics/devguides/reporting/data/v1/property-id).
     * This property must be specified for the batch. The property within
     * RunReportRequest may either be unspecified or consistent with this
     * property.
     * Example: properties/1234
     *
     * Generated from protobuf field <code>string property = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setProperty($var)
    {
        GPBUtil::checkString($var, True);
        $this->property = $var;

        return $this;
    }

    /**
     * Individual requests. Each request has a separate report response. Each
     * batch request is allowed up to 5 requests.
     *
     * Generated from protobuf field <code>repeated .google.analytics.data.v1beta.RunReportRequest requests = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * Individual requests. Each request has a separate report response. Each
     * batch request is allowed up to 5 requests.
     *
     * Generated from protobuf field <code>repeated .google.analytics.data.v1beta.RunReportRequest requests = 2;</code>
     * @param array<\Google\Analytics\Data\V1beta\RunReportRequest>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRequests($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Analytics\Data\V1beta\RunReportRequest::class);
        $this->requests = $arr;

        return $this;
    }

}
