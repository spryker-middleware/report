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
    public function indexAction(Request $request): array
    {
        $idResult = $this->castId($request->query->get(static::URL_PARAM_ID_RESULT));
        $processResult = $this->getFacade()->findProcessResultByResultId($idResult);

        return $this->viewResponse([
            'processResult' => $processResult,
        ]);
    }
}
