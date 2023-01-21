<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/build/v1/publish_build_event.proto

namespace Google\Cloud\Build\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Streaming request message for PublishBuildToolEventStream.
 *
 * Generated from protobuf message <code>google.devtools.build.v1.PublishBuildToolEventStreamRequest</code>
 */
class PublishBuildToolEventStreamRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The build event with position info.
     * New publishing clients should use this field rather than the 3 above.
     *
     * Generated from protobuf field <code>.google.devtools.build.v1.OrderedBuildEvent ordered_build_event = 4 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $ordered_build_event = null;
    /**
     * The keywords to be attached to the notification which notifies the start
     * of a new build event stream. BES only reads this field when sequence_number
     * or ordered_build_event.sequence_number is 1 in this message. If this field
     * is empty, BES will not publish notification messages for this stream.
     *
     * Generated from protobuf field <code>repeated string notification_keywords = 5;</code>
     */
    private $notification_keywords;
    /**
     * Required. The project this build is associated with.
     * This should match the project used for the initial call to
     * PublishLifecycleEvent (containing a BuildEnqueued message).
     *
     * Generated from protobuf field <code>string project_id = 6 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $project_id = '';
    /**
     * Whether to require a previously received matching InvocationAttemptStarted
     * event before continuing event processing for the event in the current
     * request. BES only performs this check for events with sequence_number 1
     * i.e. the first event in the stream.
     *
     * Generated from protobuf field <code>bool check_preceding_lifecycle_events_present = 7;</code>
     */
    private $check_preceding_lifecycle_events_present = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Build\V1\OrderedBuildEvent $ordered_build_event
     *           Required. The build event with position info.
     *           New publishing clients should use this field rather than the 3 above.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $notification_keywords
     *           The keywords to be attached to the notification which notifies the start
     *           of a new build event stream. BES only reads this field when sequence_number
     *           or ordered_build_event.sequence_number is 1 in this message. If this field
     *           is empty, BES will not publish notification messages for this stream.
     *     @type string $project_id
     *           Required. The project this build is associated with.
     *           This should match the project used for the initial call to
     *           PublishLifecycleEvent (containing a BuildEnqueued message).
     *     @type bool $check_preceding_lifecycle_events_present
     *           Whether to require a previously received matching InvocationAttemptStarted
     *           event before continuing event processing for the event in the current
     *           request. BES only performs this check for events with sequence_number 1
     *           i.e. the first event in the stream.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Devtools\Build\V1\PublishBuildEvent::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The build event with position info.
     * New publishing clients should use this field rather than the 3 above.
     *
     * Generated from protobuf field <code>.google.devtools.build.v1.OrderedBuildEvent ordered_build_event = 4 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Build\V1\OrderedBuildEvent|null
     */
    public function getOrderedBuildEvent()
    {
        return $this->ordered_build_event;
    }

    public function hasOrderedBuildEvent()
    {
        return isset($this->ordered_build_event);
    }

    public function clearOrderedBuildEvent()
    {
        unset($this->ordered_build_event);
    }

    /**
     * Required. The build event with position info.
     * New publishing clients should use this field rather than the 3 above.
     *
     * Generated from protobuf field <code>.google.devtools.build.v1.OrderedBuildEvent ordered_build_event = 4 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Build\V1\OrderedBuildEvent $var
     * @return $this
     */
    public function setOrderedBuildEvent($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Build\V1\OrderedBuildEvent::class);
        $this->ordered_build_event = $var;

        return $this;
    }

    /**
     * The keywords to be attached to the notification which notifies the start
     * of a new build event stream. BES only reads this field when sequence_number
     * or ordered_build_event.sequence_number is 1 in this message. If this field
     * is empty, BES will not publish notification messages for this stream.
     *
     * Generated from protobuf field <code>repeated string notification_keywords = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNotificationKeywords()
    {
        return $this->notification_keywords;
    }

    /**
     * The keywords to be attached to the notification which notifies the start
     * of a new build event stream. BES only reads this field when sequence_number
     * or ordered_build_event.sequence_number is 1 in this message. If this field
     * is empty, BES will not publish notification messages for this stream.
     *
     * Generated from protobuf field <code>repeated string notification_keywords = 5;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNotificationKeywords($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->notification_keywords = $arr;

        return $this;
    }

    /**
     * Required. The project this build is associated with.
     * This should match the project used for the initial call to
     * PublishLifecycleEvent (containing a BuildEnqueued message).
     *
     * Generated from protobuf field <code>string project_id = 6 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Required. The project this build is associated with.
     * This should match the project used for the initial call to
     * PublishLifecycleEvent (containing a BuildEnqueued message).
     *
     * Generated from protobuf field <code>string project_id = 6 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * Whether to require a previously received matching InvocationAttemptStarted
     * event before continuing event processing for the event in the current
     * request. BES only performs this check for events with sequence_number 1
     * i.e. the first event in the stream.
     *
     * Generated from protobuf field <code>bool check_preceding_lifecycle_events_present = 7;</code>
     * @return bool
     */
    public function getCheckPrecedingLifecycleEventsPresent()
    {
        return $this->check_preceding_lifecycle_events_present;
    }

    /**
     * Whether to require a previously received matching InvocationAttemptStarted
     * event before continuing event processing for the event in the current
     * request. BES only performs this check for events with sequence_number 1
     * i.e. the first event in the stream.
     *
     * Generated from protobuf field <code>bool check_preceding_lifecycle_events_present = 7;</code>
     * @param bool $var
     * @return $this
     */
    public function setCheckPrecedingLifecycleEventsPresent($var)
    {
        GPBUtil::checkBool($var);
        $this->check_preceding_lifecycle_events_present = $var;

        return $this;
    }

}

