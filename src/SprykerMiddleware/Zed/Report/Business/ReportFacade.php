<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerMiddleware\Zed\Report\Business;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportBusinessFactory getFactory()
 */
class ReportFacade extends AbstractFacade implements ReportFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer): ProcessResultTransfer
    {
        return $this->getFactory()
            ->createProcessResult()
            ->saveProcessResult($processResultTransfer);
    }

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function findProcessResultByResultId(int $idResult): ProcessResultTransfer
    {
        return $this->getFactory()
            ->createProcessResult()
            ->findProcessResultByResultId($idResult);
    }

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function findProcessByIdResult(int $idResult): SpyProcessEntityTransfer
    {
        return $this->getFactory()
            ->createProcessResult()
            ->findProcessByIdResult($idResult);
    }

    /**
     * @param int $idProcess
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function findProcessByProcessId(int $idProcess): SpyProcessEntityTransfer
    {
        return $this->getFactory()
            ->createProcessResult()
            ->findProcessByProcessId($idProcess);
    }
}
