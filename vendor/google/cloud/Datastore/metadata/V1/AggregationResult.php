<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/datastore/v1/aggregation_result.proto

namespace GPBMetadata\Google\Datastore\V1;

class AggregationResult
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Datastore\V1\Entity::initOnce();
        \GPBMetadata\Google\Datastore\V1\Query::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
,google/datastore/v1/aggregation_result.protogoogle.datastore.v1google/datastore/v1/query.protogoogle/protobuf/timestamp.proto"�
AggregationResult]
aggregate_properties (2?.google.datastore.v1.AggregationResult.AggregatePropertiesEntryV
AggregatePropertiesEntry
key (	)
value (2.google.datastore.v1.Value:8"�
AggregationResultBatchC
aggregation_results (2&.google.datastore.v1.AggregationResultK
more_results (25.google.datastore.v1.QueryResultBatch.MoreResultsType-
	read_time (2.google.protobuf.TimestampB�
com.google.datastore.v1BAggregationResultProtoPZ<google.golang.org/genproto/googleapis/datastore/v1;datastore�Google.Cloud.Datastore.V1�Google\\Cloud\\Datastore\\V1�Google::Cloud::Datastore::V1bproto3'
        , true);

        static::$is_initialized = true;
    }
}

