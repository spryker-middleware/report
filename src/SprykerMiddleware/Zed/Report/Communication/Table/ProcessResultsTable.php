<?php

namespace SprykerMiddleware\Zed\Report\Communication\Table;

use Orm\Zed\Report\Persistence\Map\SpyProcessResultTableMap;
use Orm\Zed\Report\Persistence\SpyProcessResult;
use Orm\Zed\Report\Persistence\SpyProcessResultQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class ProcessResultsTable extends AbstractTable
{
    const COL_ID_PROCESS_RESULT = SpyProcessResultTableMap::COL_ID_PROCESS_RESULT;
    const COL_ITEM_COUNT = SpyProcessResultTableMap::COL_ITEM_COUNT;
    const COL_PROCESSED_ITEM_COUNT = SpyProcessResultTableMap::COL_PROCESSED_ITEM_COUNT;
    const COL_SKIPPED_ITEM_COUNT = SpyProcessResultTableMap::COL_SKIPPED_ITEM_COUNT;
    const COL_FAILED_ITEM_COUNT = SpyProcessResultTableMap::COL_FAILED_ITEM_COUNT;
    const COL_START_TIME = SpyProcessResultTableMap::COL_START_TIME;

    const TABLE_COL_DURATION = 'Duration';
    const TABLE_COL_STATUS = 'Status';
    const TABLE_COL_ACTIONS = 'Actions';

    const URL_PARAM_ID_RESULT = 'id_result';

    /**
     * @var \Orm\Zed\Report\Persistence\SpyProcessQuery
     */
    protected $processResultQuery;

    protected $idProcess;

    public function __construct(SpyProcessResultQuery $processResultQuery, int $idProcess)
    {
        $this->processResultQuery = $processResultQuery;
        $this->idProcess = $idProcess;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            static::COL_ID_PROCESS_RESULT => 'ID',
            static::COL_START_TIME => 'Start Time',
            static::TABLE_COL_DURATION => 'Duration',
            static::COL_ITEM_COUNT => 'Item Count',
            static::TABLE_COL_STATUS => 'Status',
            static::TABLE_COL_ACTIONS => static::TABLE_COL_ACTIONS,
        ]);
        $config->setSearchable([
            static::COL_ID_PROCESS_RESULT,
            static::COL_START_TIME,
            static::COL_ITEM_COUNT,
        ]);
        $config->setSortable([
            static::COL_ID_PROCESS_RESULT,
            static::COL_START_TIME,
            static::COL_ITEM_COUNT,
        ]);
        $config->setDefaultSortField(static::COL_ID_PROCESS_RESULT, TableConfiguration::SORT_DESC);
        $config->addRawColumn(static::TABLE_COL_DURATION);
        $config->addRawColumn(static::TABLE_COL_STATUS);
        $config->addRawColumn(static::TABLE_COL_ACTIONS);

        $config->setUrl(sprintf('table?id_process=%d', $this->idProcess));

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this->prepareQuery();

        $queryResults = $this->runQuery($query, $config, true);
        $results = [];

        /** @var \Orm\Zed\Report\Persistence\SpyProcessResult $item */
        foreach ($queryResults as $item) {
            $results[] = [
                static::COL_ID_PROCESS_RESULT => $item->getIdProcessResult(),
                static::COL_START_TIME => $item->getStartTime('Y-m-d h:i:s'),
                static::TABLE_COL_DURATION => gmdate("H:i:s", $this->getDuration($item)) . ' (H:i:s)',
                static::COL_ITEM_COUNT => $item->getItemCount(),
                static::TABLE_COL_STATUS => $this->getStatus($item),
                static::TABLE_COL_ACTIONS => $this->getActionButtons($item),
            ];
        }
        unset($queryResults);
        return $results;
    }

    protected function prepareQuery()
    {
        $query = $this->processResultQuery->filterByFkProcessId($this->idProcess);

        return $query;
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function getActionButtons(SpyProcessResult $item)
    {
        $buttons = [];
        $buttons[] = $this->createViewButton($item);

        return implode(' ', $buttons);
    }

    /**
     * @param \Orm\Zed\Report\Persistence\SpyProcessResult $item
     *
     * @return \DateTime|string
     */
    protected function getDuration(SpyProcessResult $item)
    {
        if ($item->getEndTime('U') === null) {
            return $item->getCreatedAt('U') - $item->getStartTime('U');
        }
        return $item->getEndTime('U') - $item->getStartTime('U');
    }

    /**
     * @param \Orm\Zed\Report\Persistence\SpyProcessResult $item
     *
     * @return string
     */
    protected function getStatus(SpyProcessResult $item)
    {
        if ($item->getFailedItemCount() > 0) {
            return '<span class="label label-danger">Failed</span>';
        }

        if ($item->getSkippedItemCount() > 0) {
            return '<span class="label label-warning">Were skipped items</span>';
        }

        return '<span class="label label-info">Success</span>';
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function createViewButton(SpyProcessResult $item)
    {
        $viewDiscountUrl = Url::generate(
            '/report/result/index',
            [
                static::URL_PARAM_ID_RESULT => $item->getIdProcessResult(),
            ]
        );

        return $this->generateViewButton($viewDiscountUrl, 'Details');
    }
}
