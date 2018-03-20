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
}
