<?php

namespace SprykerMiddleware\Zed\Report\Persistence;

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
    public function findProcessResultByResultId(int $idResult)
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
     * @return mixed
     */
    public function findProcessByProcessId(int $idProcess)
    {
        $query = $this->getFactory()->createProcessQuery()->filterByIdProcess($idProcess);
        return $this->buildQueryFromCriteria($query)->findOne();
    }
}
