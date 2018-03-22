<?php

namespace SprykerMiddleware\Zed\Report\Business;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportBusinessFactory getFactory()
 */
class ReportFacade extends AbstractFacade implements ReportFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return void
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer)
    {
        $this->getFactory()
            ->createProcessResult()
            ->saveProcessResult($processResultTransfer);
    }

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer|mixed
     */
    public function findProcessResultByResultId(int $idResult)
    {
        return $this->getFactory()
            ->createProcessResult()
            ->findProcessResultByResultId($idResult);
    }

    /**
     * @param int $idProcess
     *
     * @return mixed
     */
    public function findProcessByProcessId(int $idProcess)
    {
        return $this->getFactory()
            ->createProcessResult()
            ->findProcessByProcessId($idProcess);
    }
}
