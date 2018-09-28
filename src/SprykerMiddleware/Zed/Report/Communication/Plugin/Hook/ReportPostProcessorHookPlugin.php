<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Communication\Plugin\Hook;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 */
class ReportPostProcessorHookPlugin extends AbstractPlugin implements PostProcessorHookPluginInterface
{
    protected const PLUGIN_NAME = 'ReportPostProcessorHookPlugin';

    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer|null $processResultTransfer
     *
     * @return void
     */
    public function process(?ProcessResultTransfer $processResultTransfer = null): void
    {
        $this->getFacade()
            ->saveProcessResult($processResultTransfer);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }
}
