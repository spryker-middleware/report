<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Persistence\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ProcessConfigurationTransfer;
use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessResultEntityTransfer;
use Generated\Shared\Transfer\StageResultsTransfer;
use SprykerMiddleware\Zed\Report\Dependency\Service\ReportToUtilEncodingInterface;

class ProcessResultMapper
{
    /**
     * @var \SprykerMiddleware\Zed\Report\Dependency\Service\ReportToUtilEncodingInterface
     */
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

        $startTime = ($processResultTransfer->getStartTime() !== null)
            ? date('Y-m-d H:i:s', $processResultTransfer->getStartTime())
            : null;
        $processResultEntityTransfer->setStartTime($startTime);

        $endTime = ($processResultTransfer->getEndTime() !== null)
            ? date('Y-m-d H:i:s', $processResultTransfer->getEndTime())
            : null;
        $processResultEntityTransfer->setEndTime($endTime);

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

        if ($processResultEntityTransfer->getStartTime() !== null) {
            $processResultTransfer->setStartTime(strtotime($processResultEntityTransfer->getStartTime()));
        }

        if ($processResultEntityTransfer->getEndTime() !== null) {
            $processResultTransfer->setEndTime(strtotime($processResultEntityTransfer->getEndTime()));
        }

        $processResultTransfer = $this->mapArrayToStagesResult($processResultTransfer, $this->utilEncoding->decodeJson($processResultEntityTransfer->getStageResults(), true));

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
    public function mapStagesResultToArray(ArrayObject $stagesResults): array
    {
        $stagesResultsArray = [];

        foreach ($stagesResults as $stage) {
            $stagesResultsArray[] = $stage->toArray();
        }

        return $stagesResultsArray;
    }

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     * @param array $stagesResults
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function mapArrayToStagesResult(ProcessResultTransfer $processResultTransfer, array $stagesResults): ProcessResultTransfer
    {
        foreach ($stagesResults as $stage) {
            $stagesResultsTransfer = new StageResultsTransfer();
            $stagesResultsTransfer->fromArray($stage);

            $processResultTransfer->addStageResult($stagesResultsTransfer);
        }

        return $processResultTransfer;
    }
}
