<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Business;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportBusinessFactory getFactory()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface getRepository()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface getEntityManager()
 */
class ReportFacade extends AbstractFacade implements ReportFacadeInterface
{
    /**
     * @api
     *
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
     * @api
     *
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
     * @api
     *
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
     * @api
     *
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
