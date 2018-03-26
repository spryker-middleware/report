<?php

namespace SprykerMiddleware\Zed\Report\Business\Model;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;

interface ProcessResultInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer): ProcessResultTransfer;

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function findProcessResultByResultId(int $idResult): ProcessResultTransfer;

    /**
     * @param int $idProcess
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function findProcessByProcessId(int $idProcess): SpyProcessEntityTransfer;
}
