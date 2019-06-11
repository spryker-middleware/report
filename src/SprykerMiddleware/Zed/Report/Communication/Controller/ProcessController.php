<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 * @method \SprykerMiddleware\Zed\Report\Persistence\ReportRepositoryInterface getRepository()
 */
class ProcessController extends AbstractController
{
    public const URL_PARAM_ID_PROCESS = 'id_process';

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
