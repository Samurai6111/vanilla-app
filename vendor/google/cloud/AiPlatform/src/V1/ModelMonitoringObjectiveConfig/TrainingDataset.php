<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/aiplatform/v1/model_monitoring.proto

namespace Google\Cloud\AIPlatform\V1\ModelMonitoringObjectiveConfig;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Training Dataset information.
 *
 * Generated from protobuf message <code>google.cloud.aiplatform.v1.ModelMonitoringObjectiveConfig.TrainingDataset</code>
 */
class TrainingDataset extends \Google\Protobuf\Internal\Message
{
    /**
     * Data format of the dataset, only applicable if the input is from
     * Google Cloud Storage.
     * The possible formats are:
     * "tf-record"
     * The source file is a TFRecord file.
     * "csv"
     * The source file is a CSV file.
     * "jsonl"
     * The source file is a JSONL file.
     *
     * Generated from protobuf field <code>string data_format = 2;</code>
     */
    private $data_format = '';
    /**
     * The target field name the model is to predict.
     * This field will be excluded when doing Predict and (or) Explain for the
     * training data.
     *
     * Generated from protobuf field <code>string target_field = 6;</code>
     */
    private $target_field = '';
    /**
     * Strategy to sample data from Training Dataset.
     * If not set, we process the whole dataset.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.SamplingStrategy logging_sampling_strategy = 7;</code>
     */
    private $logging_sampling_strategy = null;
    protected $data_source;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $dataset
     *           The resource name of the Dataset used to train this Model.
     *     @type \Google\Cloud\AIPlatform\V1\GcsSource $gcs_source
     *           The Google Cloud Storage uri of the unmanaged Dataset used to train
     *           this Model.
     *     @type \Google\Cloud\AIPlatform\V1\BigQuerySource $bigquery_source
     *           The BigQuery table of the unmanaged Dataset used to train this
     *           Model.
     *     @type string $data_format
     *           Data format of the dataset, only applicable if the input is from
     *           Google Cloud Storage.
     *           The possible formats are:
     *           "tf-record"
     *           The source file is a TFRecord file.
     *           "csv"
     *           The source file is a CSV file.
     *           "jsonl"
     *           The source file is a JSONL file.
     *     @type string $target_field
     *           The target field name the model is to predict.
     *           This field will be excluded when doing Predict and (or) Explain for the
     *           training data.
     *     @type \Google\Cloud\AIPlatform\V1\SamplingStrategy $logging_sampling_strategy
     *           Strategy to sample data from Training Dataset.
     *           If not set, we process the whole dataset.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Aiplatform\V1\ModelMonitoring::initOnce();
        parent::__construct($data);
    }

    /**
     * The resource name of the Dataset used to train this Model.
     *
     * Generated from protobuf field <code>string dataset = 3 [(.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getDataset()
    {
        return $this->readOneof(3);
    }

    public function hasDataset()
    {
        return $this->hasOneof(3);
    }

    /**
     * The resource name of the Dataset used to train this Model.
     *
     * Generated from protobuf field <code>string dataset = 3 [(.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setDataset($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * The Google Cloud Storage uri of the unmanaged Dataset used to train
     * this Model.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.GcsSource gcs_source = 4;</code>
     * @return \Google\Cloud\AIPlatform\V1\GcsSource|null
     */
    public function getGcsSource()
    {
        return $this->readOneof(4);
    }

    public function hasGcsSource()
    {
        return $this->hasOneof(4);
    }

    /**
     * The Google Cloud Storage uri of the unmanaged Dataset used to train
     * this Model.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.GcsSource gcs_source = 4;</code>
     * @param \Google\Cloud\AIPlatform\V1\GcsSource $var
     * @return $this
     */
    public function setGcsSource($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AIPlatform\V1\GcsSource::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * The BigQuery table of the unmanaged Dataset used to train this
     * Model.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.BigQuerySource bigquery_source = 5;</code>
     * @return \Google\Cloud\AIPlatform\V1\BigQuerySource|null
     */
    public function getBigquerySource()
    {
        return $this->readOneof(5);
    }

    public function hasBigquerySource()
    {
        return $this->hasOneof(5);
    }

    /**
     * The BigQuery table of the unmanaged Dataset used to train this
     * Model.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.BigQuerySource bigquery_source = 5;</code>
     * @param \Google\Cloud\AIPlatform\V1\BigQuerySource $var
     * @return $this
     */
    public function setBigquerySource($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AIPlatform\V1\BigQuerySource::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * Data format of the dataset, only applicable if the input is from
     * Google Cloud Storage.
     * The possible formats are:
     * "tf-record"
     * The source file is a TFRecord file.
     * "csv"
     * The source file is a CSV file.
     * "jsonl"
     * The source file is a JSONL file.
     *
     * Generated from protobuf field <code>string data_format = 2;</code>
     * @return string
     */
    public function getDataFormat()
    {
        return $this->data_format;
    }

    /**
     * Data format of the dataset, only applicable if the input is from
     * Google Cloud Storage.
     * The possible formats are:
     * "tf-record"
     * The source file is a TFRecord file.
     * "csv"
     * The source file is a CSV file.
     * "jsonl"
     * The source file is a JSONL file.
     *
     * Generated from protobuf field <code>string data_format = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setDataFormat($var)
    {
        GPBUtil::checkString($var, True);
        $this->data_format = $var;

        return $this;
    }

    /**
     * The target field name the model is to predict.
     * This field will be excluded when doing Predict and (or) Explain for the
     * training data.
     *
     * Generated from protobuf field <code>string target_field = 6;</code>
     * @return string
     */
    public function getTargetField()
    {
        return $this->target_field;
    }

    /**
     * The target field name the model is to predict.
     * This field will be excluded when doing Predict and (or) Explain for the
     * training data.
     *
     * Generated from protobuf field <code>string target_field = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setTargetField($var)
    {
        GPBUtil::checkString($var, True);
        $this->target_field = $var;

        return $this;
    }

    /**
     * Strategy to sample data from Training Dataset.
     * If not set, we process the whole dataset.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.SamplingStrategy logging_sampling_strategy = 7;</code>
     * @return \Google\Cloud\AIPlatform\V1\SamplingStrategy|null
     */
    public function getLoggingSamplingStrategy()
    {
        return $this->logging_sampling_strategy;
    }

    public function hasLoggingSamplingStrategy()
    {
        return isset($this->logging_sampling_strategy);
    }

    public function clearLoggingSamplingStrategy()
    {
        unset($this->logging_sampling_strategy);
    }

    /**
     * Strategy to sample data from Training Dataset.
     * If not set, we process the whole dataset.
     *
     * Generated from protobuf field <code>.google.cloud.aiplatform.v1.SamplingStrategy logging_sampling_strategy = 7;</code>
     * @param \Google\Cloud\AIPlatform\V1\SamplingStrategy $var
     * @return $this
     */
    public function setLoggingSamplingStrategy($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AIPlatform\V1\SamplingStrategy::class);
        $this->logging_sampling_strategy = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataSource()
    {
        return $this->whichOneof("data_source");
    }

}


