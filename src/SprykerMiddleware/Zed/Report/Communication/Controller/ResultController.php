<?php

namespace SprykerMiddleware\Zed\Report\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 */
class ResultController extends AbstractController
{
    const URL_PARAM_ID_RESULT = 'id_result';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $idResult = $this->castId($request->query->get(static::URL_PARAM_ID_RESULT));

        $processResult = $this->getFacade()->findProcessResultByResultId($idResult);

        $attributes = [];
        $attributes['Start Time'] = $processResult->getStartTime();
        $attributes['End Time'] = $processResult->getEndTime();
        $attributes['Item Count'] = $processResult->getItemCount();
        $attributes['Processed Item Count'] = $processResult->getProcessedItemCount();
        $attributes['Skipped Item Count'] = $processResult->getSkippedItemCount();
        $attributes['Failed Item Count'] = $processResult->getFailedItemCount();

        $stageResultsTransfer = $processResult->getStageResults();

        $stageResults = [];

        /** @var \Orm\Zed\Report\Persistence\SpyProcessResult $item */
        foreach ($stageResultsTransfer as $stageResult) {
            $stageResults[] = [
                'stage_name' => $stageResult->getStageName(),
                'input_item_count' => $stageResult->getInputItemCount(),
                'output_item_count' => $stageResult->getOutputItemCount(),
                'total_execution_time' => gmdate("H:i:s", round($stageResult->getTotalExecutionTime() * 0.0001)) . ' (H:i:s)',
                'average_time_per_item' => gmdate("H:i:s", round(($stageResult->getTotalExecutionTime() / $stageResult->getInputItemCount() * 0.0001))) . ' (H:i:s)',
            ];
        }

        return $this->viewResponse([
            'processResultAttributes' => $attributes,
            'processConfiguration' => $processResult->getProcessConfiguration()->toArray(),
            'stageResults' => $stageResults,
        ]);
    }
}
