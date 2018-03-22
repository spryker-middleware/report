<?php

namespace SprykerMiddleware\Zed\Report\Communication\Table;

use Orm\Zed\Report\Persistence\Map\SpyProcessTableMap;
use Orm\Zed\Report\Persistence\SpyProcessQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use SprykerMiddleware\Zed\Report\Communication\Controller\ProcessController;

class ProcessesTable extends AbstractTable
{
    const COL_ID_PROCESS = SpyProcessTableMap::COL_ID_PROCESS;
    const COL_PROCESS_NAME = SpyProcessTableMap::COL_PROCESS_NAME;
    const TABLE_COL_ACTIONS = 'Actions';

    /**
     * @var \Orm\Zed\Report\Persistence\SpyProcessQuery
     */
    protected $processQuery;

    /**
     * @param \Orm\Zed\Report\Persistence\SpyProcessQuery $processQuery
     */
    public function __construct(SpyProcessQuery $processQuery)
    {
        $this->processQuery = $processQuery;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            static::COL_ID_PROCESS => 'ID',
            static::COL_PROCESS_NAME => 'Process',
            static::TABLE_COL_ACTIONS => static::TABLE_COL_ACTIONS,
        ]);
        $config->setSearchable([
            static::COL_ID_PROCESS,
            static::COL_PROCESS_NAME,
        ]);
        $config->setSortable([
            static::COL_ID_PROCESS,
            static::COL_PROCESS_NAME,
        ]);
        $config->addRawColumn(static::TABLE_COL_ACTIONS);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $queryResults = $this->runQuery($this->processQuery, $config);
        $results = [];

        foreach ($queryResults as $item) {
            $results[] = [
                static::COL_ID_PROCESS => $item[SpyProcessTableMap::COL_ID_PROCESS],
                static::COL_PROCESS_NAME => $item[SpyProcessTableMap::COL_PROCESS_NAME],
                static::TABLE_COL_ACTIONS => $this->getActionButtons($item),
            ];
        }
        unset($queryResults);
        return $results;
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function getActionButtons(array $item)
    {
        $buttons = [];
        $buttons[] = $this->createViewButton($item);

        return implode(' ', $buttons);
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function createViewButton(array $item)
    {
        $viewDiscountUrl = Url::generate(
            '/report/process/index',
            [
                ProcessController::URL_PARAM_ID_PROCESS => $item[SpyProcessTableMap::COL_ID_PROCESS],
            ]
        );

        return $this->generateViewButton($viewDiscountUrl, 'View');
    }
}
