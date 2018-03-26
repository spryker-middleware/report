<?php

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
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
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
