<?php

namespace SprykerMiddleware\Zed\Report\Business\Model;

use Generated\Shared\Transfer\ProcessResultTransfer;

interface ProcessResultInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer);
}
