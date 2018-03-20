<?php

namespace SprykerMiddleware\Zed\Report\Persistence\Mapper;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessResultEntityTransfer;

class ProcessResultMapper
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\SpyProcessResultEntityTransfer
     */
    public function mapProcessResultTransferToEntityTransfer(ProcessResultTransfer $processResultTransfer): SpyProcessResultEntityTransfer
    {
        $processResultEntityTransfer = new SpyProcessResultEntityTransfer();
        $processResultEntityTransfer->setItemsProcessedCount($processResultTransfer->getProcessedCount());
        $processResultEntityTransfer->setItemsFailedCount($processResultTransfer->getFailedCount());
        $processResultEntityTransfer->setItemsSkippedCount($processResultTransfer->getSkippedCount());
        $processResultEntityTransfer->setItemsCount($processResultTransfer->getItemCount());
        $processResultEntityTransfer->setStartTime($processResultTransfer->getStartTime());
        $processResultEntityTransfer->setEndTime($processResultTransfer->getEndTime());

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
        $processResultTransfer->setProcessedCount($processResultEntityTransfer->getItemsProcessedCount());
        $processResultTransfer->setFailedCount($processResultEntityTransfer->getItemsFailedCount());
        $processResultTransfer->setSkippedCount($processResultEntityTransfer->getItemsSkippedCount());
        $processResultTransfer->setItemCount($processResultEntityTransfer->getItemsCount());
        $processResultTransfer->setStartTime($processResultEntityTransfer->getStartTime());
        $processResultTransfer->setEndTime($processResultEntityTransfer->getEndTime());

        return $processResultTransfer;
    }
}
