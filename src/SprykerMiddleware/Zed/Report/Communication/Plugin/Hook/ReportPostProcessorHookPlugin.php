<?php

namespace SprykerMiddleware\Zed\Report\Communication\Plugin\Hook;

use Generated\Shared\Transfer\ProcessResultTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 */
class ReportPostProcessorHookPlugin extends AbstractPlugin implements PostProcessorHookPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProcessResultTransfer|null $processResultTransfer
     *
     * @return void
     */
    public function process(ProcessResultTransfer $processResultTransfer = null): void
    {
        $this->getFacade()
            ->saveProcessResult($processResultTransfer);
    }
}
