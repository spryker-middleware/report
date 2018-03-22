<?php

namespace SprykerMiddleware\Zed\Report\Business;

use Generated\Shared\Transfer\ProcessResultTransfer;

interface ReportFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return void
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer);

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function findProcessResultByResultId(int $idResult);

    /**
     * @param int $idProcess
     *
     * @return mixed
     */
    public function findProcessByProcessId(int $idProcess);
}
