<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerMiddleware\Zed\Report\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \SprykerMiddleware\Zed\Report\Business\ReportFacadeInterface getFacade()
 * @method \SprykerMiddleware\Zed\Report\Communication\ReportCommunicationFactory getFactory()
 */
class ReportController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction(): array
    {
        $table = $this->getFactory()->createProcessesTable();

        return $this->viewResponse([
            'processesTable' => $table->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()
            ->createProcessesTable();

        return $this->jsonResponse($table->fetchData());
    }
}
