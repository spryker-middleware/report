<?php

namespace SprykerMiddleware\Zed\Report\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerMiddleware\Zed\Report\Business\Model\ProcessResult;

/**
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface getRepository()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface getEntityManager()
 */
class ReportBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Report\Business\Model\ProcessResult
     */
    public function createProcessResult(): ProcessResult
    {
        return new ProcessResult(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }
}
