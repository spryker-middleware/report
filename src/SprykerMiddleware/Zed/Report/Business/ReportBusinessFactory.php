<?php

namespace SprykerMiddleware\Zed\Report\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerMiddleware\Zed\Report\Business\Model\ProcessResult;
use SprykerMiddleware\Zed\Report\Persistence\Mapper\ProcessResultMapper;

/**
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface getRepository()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface getEntityManager()
 */
class ReportBusinessFactory extends AbstractBusinessFactory
{
    public function createProcessResult()
    {
        return new ProcessResult(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \SprykerMiddleware\Zed\Report\Persistence\Mapper\ProcessResultMapper
     */
    public function createProcessResultMapper()
    {
        return new ProcessResultMapper();
    }
}
