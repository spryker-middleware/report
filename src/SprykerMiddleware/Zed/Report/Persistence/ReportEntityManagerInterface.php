<?php

namespace SprykerMiddleware\Zed\Report\Persistence;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;

interface ReportEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyProcessEntityTransfer $processEntityTransfer
     *
     * @return mixed
     */
    public function saveProcess(SpyProcessEntityTransfer $processEntityTransfer);

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer
     * @param \Generated\Shared\Transfer\SpyProcessEntityTransfer $spyProcessEntityTransfer
     *
     * @return mixed
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer, SpyProcessEntityTransfer $spyProcessEntityTransfer);
}
