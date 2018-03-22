<?php

namespace SprykerMiddleware\Zed\Report\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 */
class ReportController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        $table = $this->getFactory()->createProcessesTable();

        return $this->viewResponse([
            'processesTable' => $table->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $table = $this->getFactory()
            ->createProcessesTable();

        return $this->jsonResponse($table->fetchData());
    }
}
