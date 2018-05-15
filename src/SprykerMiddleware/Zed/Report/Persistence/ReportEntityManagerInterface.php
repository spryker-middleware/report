<?php

namespace SprykerMiddleware\Zed\Report\Persistence;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;

interface ReportEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyProcessEntityTransfer $spyProcessEntityTransfer
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function saveProcess(SpyProcessEntityTransfer $spyProcessEntityTransfer): SpyProcessEntityTransfer;

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     * @param \Generated\Shared\Transfer\SpyProcessEntityTransfer $spyProcessEntityTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer, SpyProcessEntityTransfer $spyProcessEntityTransfer): ProcessResultTransfer;
}
