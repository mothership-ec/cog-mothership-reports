<?php

namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DateRangeReport;

class TopDestinationsBySales extends DateRangeReport
{
	public function view($params = array())
	{
		return parent::view($params + array(
			'show_range' => true,
		));
	}

	public function getColumns()
	{
		return array(
			'position' => 'Position',
			'country' => 'Country',
			'grossIncome' => 'Gross Income',
			'salesExcVAT' => 'Ex VAT Sales Total',
			'ordersPlaced' => 'Orders Placed',
			'averageTotal' => 'Average Order Value',
			'salesVAT' => 'VAT On Sales',
			'fedexUK' => 'Fedex UK',
			'fedexExpress' => 'Fedex Express',
			'fedexVAT' => 'VAT On Fedex'
		);
	}

	public function formatColumn($column, $value)
	{
		// Format monetary columns with a £ symbol
		if (! in_array($column, array('position', 'country', 'ordersPlaced'))) {
			return '&pound;' . number_format($value, 2);
		}

		return $value;
	}

	public function getData()
	{
		$query = '
			SELECT
				oa.country_id AS country,
				SUM( IF(os.total_gross IS NOT NULL, os.total_gross, 0) ) AS grossIncome,
				SUM( IF(os.total_net IS NOT NULL, os.total_net, 0) ) AS salesExcVAT,
				COUNT(os.order_id) AS ordersPlaced,
				SUM( IF(os.total_gross IS NOT NULL, os.total_gross, 0) ) / COUNT(os.order_id) AS averageTotal,
				SUM( IF(os.total_tax IS NOT NULL, os.total_tax, 0) ) AS salesVAT,
				SUM( IF(oa.country_id = "GB", osp.gross, 0) ) AS fedexUK,
				SUM( IF(oa.country_id != "GB", osp.gross, 0) ) AS fedexExpress,
				SUM( IFNULL(osp.tax, 0) ) AS fedexVAT,
				os.created_at
			FROM
				order_summary os
			RIGHT JOIN
				order_address oa ON os.order_id = oa.order_id
			LEFT JOIN
				order_shipping osp ON (os.order_id = osp.order_id)
			WHERE
				oa.type = "delivery" AND
				os.created_at >= ? AND os.created_at <= ?
			GROUP BY
				oa.country_id
			ORDER BY
				grossIncome DESC
		';

		$form = $this->getForm()->getFilteredData();

		// Get the data in the date range, default to last 28 days.
		$date_range = $this->getDateRange($form, 28);
		$params = array(
			$date_range[0]->getTimestamp(),
			$date_range[1]->getTimestamp()
		);

		$rows = $this->_query->run($query, $params);

		$data = array();
		foreach ($rows as $key => $row) {
			$row->position = $key + 1;
			$data[] = $row;
		}

		// Save this data for use in other methods
		$this->data = $data;

		return $data;
	}

	public function getStartDate()
	{
		$first = $this->_query->run('SELECT FROM_UNIXTIME(created_at) as created_at_time FROM order_summary ORDER BY created_at ASC LIMIT 1');

		return date('Y-m-01', strtotime($first[0]->created_at_time));
	}

	public function getName()
	{
		return "Top Destinations By Sales";
	}

	public function getDescription()
	{
		return "Top destination by sales value";
	}
}