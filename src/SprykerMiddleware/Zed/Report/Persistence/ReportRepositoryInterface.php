<?php

namespace SprykerMiddleware\Zed\Report\Persistence;

interface ReportRepositoryInterface
{
    /**
     * @param int $idResult
     *
     * @return mixed
     */
    public function findProcessResultByResultId(int $idResult);

    /**
     * @param int $idProcess
     *
     * @return mixed
     */
    public function findProcessByProcessId(int $idProcess);
}
