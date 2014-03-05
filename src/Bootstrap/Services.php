<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Mothership\Report\Report as Report;
use Message\Cog\Bootstrap\ServicesInterface;

use Message\Mothership\Report\Collection;

class Services implements ServicesInterface
{
	public function registerServices($services)
	{
		$services['report.reports'] = function($c) {
			return [
				'search-terms'                 => new Report\SearchTerms($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'search-terms-detail'          => new Report\SearchTermsDetail($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'monthly-sales'                => new Report\MonthlySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'daily-sales'                  => new Report\DailySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'top-product-sales'            => new Report\TopProductSales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'top-destinations-by-products' => new Report\TopDestinationsByProducts($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'top-destinations-by-sales'    => new Report\TopDestinationsBySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
				'stock-snapshot'               => new Report\StockSnapshot($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query']),
			];
		};
	}
}