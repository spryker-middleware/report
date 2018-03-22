<?php

namespace SprykerMiddleware\Zed\Report\Business\Model;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Generated\Shared\Transfer\SpyProcessEntityTransfer;
use SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface;
use SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface;

class ProcessResult implements ProcessResultInterface
{
    /**
     * @var \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface
     */
    protected $reportRepository;

    /**
     * @var \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface
     */
    protected $reportEntityManager;

    /**
     * @param \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface $reportRepository
     * @param \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface $reportEntityManager
     */
    public function __construct(
        ReportRepositoryInterface $reportRepository,
        ReportEntityManagerInterface $reportEntityManager
    ) {
        $this->reportRepository = $reportRepository;
        $this->reportEntityManager = $reportEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer $processResultTransfer
     *
     * @return \Generated\Shared\Transfer\ProcessResultTransfer
     */
    public function saveProcessResult(ProcessResultTransfer $processResultTransfer)
    {
        $spyProcessEntityTransfer = new SpyProcessEntityTransfer();
        $spyProcessEntityTransfer->setProcessName($processResultTransfer->getProcessName());
        $spyProcessEntityTransfer = $this->reportEntityManager->saveProcess($spyProcessEntityTransfer);

        return $this->reportEntityManager->saveProcessResult($processResultTransfer, $spyProcessEntityTransfer);
    }

    /**
     * @param int $idResult
     *
     * @return mixed
     */
    public function findProcessResultByResultId(int $idResult)
    {
        return $this->reportRepository->findProcessResultByResultId($idResult);
    }

    /**
     * @param int $idProcess
     *
     * @return mixed
     */
    public function findProcessByProcessId(int $idProcess)
    {
        return $this->reportRepository->findProcessByProcessId($idProcess);
    }
}
