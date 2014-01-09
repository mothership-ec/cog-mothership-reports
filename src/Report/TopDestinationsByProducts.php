<?php namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DateRangeReport;

class TopDestinationsByProducts extends DateRangeReport
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
			'productName' => 'Model',
			'options' => 'Finish',
			'grossIncome' => 'Product Sales',
			'ordersPlaced' => 'Orders'
		);
	}

	public function formatColumn($column, $value)
	{
		// Format monetary columns with a £ symbol
		if ($column == 'grossIncome') {
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
				COUNT(oi.item_id) AS ordersPlaced,
				oi.product_name as productName,
				oi.options as options,
				os.created_at
			FROM
				order_summary os
			RIGHT JOIN
				order_address oa ON os.order_id = oa.order_id
			LEFT JOIN
				order_item oi ON (os.order_id = oi.order_id)
			WHERE
				os.created_at >= ? AND os.created_at <= ?
			GROUP BY
				oa.country_id, oi.unit_id
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
		return "Top Destinations By Products";
	}

	public function getDescription()
	{
		return "Top destination by products";
	}

}