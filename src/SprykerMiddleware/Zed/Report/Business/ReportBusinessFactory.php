<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerMiddleware\Zed\Report\Business\Model\ProcessResult;
use SprykerMiddleware\Zed\Report\Business\Model\ProcessResultInterface;

/**
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface getRepository()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportEntityManagerInterface getEntityManager()
 */
class ReportBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Report\Business\Model\ProcessResultInterface
     */
    public function createProcessResult(): ProcessResultInterface
    {
        return new ProcessResult(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }
}
