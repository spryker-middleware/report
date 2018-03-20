<?php

namespace SprykerMiddleware\Zed\Report\Persistence;

use Orm\Zed\Report\Persistence\SpyProcessQuery;
use Orm\Zed\Report\Persistence\SpyProcessResultQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerMiddleware\Zed\Report\Persistence\Mapper\ProcessResultMapper;

class ReportPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Report\Persistence\SpyProcessQuery
     */
    public function createProcessQuery(): SpyProcessQuery
    {
        return SpyProcessQuery::create();
    }

    /**
     * @return \Orm\Zed\Report\Persistence\SpyProcessResultQuery
     */
    public function createProcessResultQuery(): SpyProcessResultQuery
    {
        return SpyProcessResultQuery::create();
    }

    public function createProcessResultMapper()
    {
        return new ProcessResultMapper();
    }
}
