<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Persistence;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportPersistenceFactory getFactory()
 */
class ReportRepository extends AbstractRepository implements ReportRepositoryInterface
{
    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer|null
     */
    public function findProcessResultByResultId(int $idResult): ?ProcessResultTransfer
    {
        $query = $this->getFactory()
            ->createProcessResultQuery()
            ->filterByIdProcessResult($idResult);

        $entityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        if ($entityTransfer !== null) {
            return $this->getFactory()
                ->createProcessResultMapper()
                ->mapEntityTransferToProcessResultTransfer($entityTransfer);
        }

        return null;
    }

    /**
     * @param int $idResult
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function findProcessByIdResult(int $idResult): SpyProcessEntityTransfer
    {
        $resultQuery = $this->getFactory()
            ->createProcessResultQuery()
            ->filterByIdProcessResult($idResult);
        $processResult = $this->buildQueryFromCriteria($resultQuery)->findOne();
        $processId = $processResult->getFkProcessId();

        return $this->findProcessByProcessId($processId);
    }

    /**
     * @param int $idProcess
     *
     * @return \Generated\Shared\Transfer\SpyProcessEntityTransfer
     */
    public function findProcessByProcessId(int $idProcess): SpyProcessEntityTransfer
    {
        $query = $this->getFactory()->createProcessQuery()->filterByIdProcess($idProcess);

        return $this->buildQueryFromCriteria($query)->findOne();
    }
}
