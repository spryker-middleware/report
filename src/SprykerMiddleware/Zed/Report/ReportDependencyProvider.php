<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerMiddleware\Zed\Report;

use Orm\Zed\Report\Persistence\SpyProcessQuery;
use Orm\Zed\Report\Persistence\SpyProcessResultQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerMiddleware\Zed\Report\Dependency\Service\ReportToUtilEncodingBridge;

class ReportDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_PROCESS_QUERY = 'PROPEL_PROCESS_QUERY';

    public const PROPEL_PROCESS_RESULT_QUERY = 'PROPEL_PROCESS_RESULT_QUERY';

    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addPropelProcessQuery($container);
        $container = $this->addPropelProcessResultQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelProcessQuery(Container $container): Container
    {
        $container[static::PROPEL_PROCESS_QUERY] = function (Container $container): SpyProcessQuery {
            return SpyProcessQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelProcessResultQuery(Container $container): Container
    {
        $container[static::PROPEL_PROCESS_RESULT_QUERY] = function (Container $container): SpyProcessResultQuery {
            return SpyProcessResultQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addServiceUtilEncoding(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = function (Container $container): ReportToUtilEncodingBridge {
            return new ReportToUtilEncodingBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addServiceUtilEncoding($container);
        $container = $this->addPropelProcessQuery($container);
        $container = $this->addPropelProcessResultQuery($container);

        return $container;
    }
}
