<?php

namespace SprykerMiddleware\Zed\Report\Persistence\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ProcessConfigurationTransfer;
use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessResultEntityTransfer;
use Generated\Shared\Transfer\StageResultsTransfer;
use SprykerMiddleware\Zed\Report\Dependency\Service\ReportToUtilEncodingInterface;

class ProcessResultMapper
{
    protected $utilEncoding;

    /**
     * @param \SprykerMiddleware\Zed\Report\Dependency\Service\ReportToUtilEncodingInterface $utilEncoding
     */
    public function __construct(ReportToUtilEncodingInterface $utilEncoding)
    {
        $this->utilEncoding = $utilEncoding;
    }

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\SpyProcessResultEntityTransfer
     */
    public function mapProcessResultTransferToEntityTransfer(ProcessResultTransfer $processResultTransfer): SpyProcessResultEntityTransfer
    {
        $processResultEntityTransfer = new SpyProcessResultEntityTransfer();
        $processResultEntityTransfer->setProcessedItemCount($processResultTransfer->getProcessedItemCount());
        $processResultEntityTransfer->setFailedItemCount($processResultTransfer->getFailedItemCount());
        $processResultEntityTransfer->setSkippedItemCount($processResultTransfer->getSkippedItemCount());
        $processResultEntityTransfer->setItemCount($processResultTransfer->getItemCount());
        $processResultEntityTransfer->setStartTime($processResultTransfer->getStartTime());
        $processResultEntityTransfer->setEndTime($processResultTransfer->getEndTime());

        $stagesResults = $this->mapStagesResultToArray($processResultTransfer->getStageResults());
        $processResultEntityTransfer->setStageResults($this->utilEncoding->encodeJson($stagesResults));

        $processResultEntityTransfer->setProcessConfiguration($this->utilEncoding->encodeJson($processResultTransfer->getProcessConfiguration()->toArray()));

        return $processResultEntityTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SpyProcessResultEntityTransfer $processResultEntityTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function mapEntityTransferToProcessResultTransfer(SpyProcessResultEntityTransfer $processResultEntityTransfer): ProcessResultTransfer
    {
        $processResultTransfer = new ProcessResultTransfer();
        $processResultTransfer->setProcessedItemCount($processResultEntityTransfer->getProcessedItemCount());
        $processResultTransfer->setFailedItemCount($processResultEntityTransfer->getFailedItemCount());
        $processResultTransfer->setSkippedItemCount($processResultEntityTransfer->getSkippedItemCount());
        $processResultTransfer->setItemCount($processResultEntityTransfer->getItemCount());
        $processResultTransfer->setStartTime($processResultEntityTransfer->getStartTime());
        $processResultTransfer->setEndTime($processResultEntityTransfer->getEndTime());

        $stages = $this->mapArrayToStagesResult($this->utilEncoding->decodeJson($processResultEntityTransfer->getStageResults(), true));
        $processResultTransfer->setStageResults($stages);

        $conf = new ProcessConfigurationTransfer();
        $conf->fromArray($this->utilEncoding->decodeJson($processResultEntityTransfer->getProcessConfiguration(), true));
        $processResultTransfer->setProcessConfiguration($conf);

        return $processResultTransfer;
    }

    /**
     * @param \ArrayObject $stagesResults
     *
     * @return array
     */
    public function mapStagesResultToArray(ArrayObject $stagesResults)
    {
        $stagesResultsArray = [];

        foreach ($stagesResults as $stage) {
            $stagesResultsArray[] = $stage->toArray();
        }
        return $stagesResultsArray;
    }

    /**
     * @param array $stagesResults
     *
     * @return \ArrayObject
     */
    public function mapArrayToStagesResult(array $stagesResults)
    {
        $res = new ArrayObject();
        foreach ($stagesResults as $stage) {
            $stagesResultsTransfer = new StageResultsTransfer();
            $stagesResultsTransfer->fromArray($stage);

            $res->append($stagesResultsTransfer);
        }

        return $res;
    }
}
