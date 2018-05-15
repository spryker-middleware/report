<?php

namespace SprykerMiddleware\Zed\Report\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 */
class ProcessController extends AbstractController
{
    const URL_PARAM_ID_PROCESS = 'id_process';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $idProcess = $this->castId($request->query->get(static::URL_PARAM_ID_PROCESS));
        $table = $this->getFactory()->createProcessResultsTable($idProcess);
        $processResult = $this->getFacade()->findProcessByProcessId($idProcess);

        return $this->viewResponse([
            'processResultsTable' => $table->render(),
            'process' => $processResult,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction(Request $request): JsonResponse
    {
        $idProcess = $this->castId($request->query->get(static::URL_PARAM_ID_PROCESS));
        $table = $this->getFactory()
            ->createProcessResultsTable($idProcess);

        return $this->jsonResponse($table->fetchData());
    }
}
