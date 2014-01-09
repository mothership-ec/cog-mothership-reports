<?php namespace UniformWares\Reports\Report;

use UniformWares\Reports\ReportType\DateRangeReport;

class TopProductSales extends DateRangeReport
{

	public function getColumns()
	{
		return array(
			'position' => 'Position',
			'model' => 'Model',
			'finish' => 'Finish',
			'sales' => 'Product Sales',
			'units' => 'Units'
		);
	}

	public function formatColumn($column, $value)
	{
		// Format monetary columns with a £ symbol
		if ($column == 'sales') {
			return '&pound;' . number_format($value, 2);
		}

		return $value;
	}

	public function getData($from = null, $limit = null)
	{
		$query = "
			SELECT
				oi.product_name AS model,
				REPLACE(REPLACE(oi.options, ', Standard', ''), CONCAT(oi.product_name, ', '), '') AS finish,
				SUM(oi.gross) AS sales,
				COUNT(oi.unit_id) AS units,
				oi.unit_id,
				oi.created_at
			FROM
				order_item oi
			WHERE
				oi.created_at >= ? AND oi.created_at <= ?
			GROUP BY
				oi.unit_id
			ORDER BY
				units DESC,sales DESC
		";

		$form = $this->getForm()->getFilteredData();

		// Get the data in the date range.
		$date_range = $this->getDateRange($form);
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

	public function getName()
	{
		return "Top Product Sales";
	}

	public function getDescription()
	{
		return 'Top product sales';
	}

}