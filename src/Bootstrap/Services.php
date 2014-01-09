<?php

namespace UniformWares\Reports\Bootstrap;

use UniformWares\Reports\Report as Report;
use Message\Cog\Bootstrap\ServicesInterface;

use UniformWares\Reports\Collection;

class Services implements ServicesInterface
{
	public function registerServices($services)
	{
		$services['report.reports'] = $services->share(function($c) {
			return new Collection\Collection(array(
				new Collection\Item('search-terms', new Report\SearchTerms($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('search-terms-detail', new Report\SearchTermsDetail($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('monthly-sales', new Report\MonthlySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('daily-sales', new Report\DailySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('top-product-sales', new Report\TopProductSales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('top-destinations-by-products', new Report\TopDestinationsByProducts($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('top-destinations-by-sales', new Report\TopDestinationsBySales($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
				new Collection\Item('stock-snapshot', new Report\StockSnapshot($c['filesystem'], $c['filesystem.stream_wrapper'], $c['db.query'])),
			));
		});
	}
}