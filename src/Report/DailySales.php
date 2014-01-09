<?php

namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DailyReport;

class DailySales extends DailyReport
{
	public function getColumns()
	{
		return array(
			'date' => 'Date',
			'grossIncome' => 'Gross Income',
			'salesExcVAT' => 'Ex VAT Income',
			'ordersPlaced' => 'Orders Placed',
			'averageTotal' => 'Average Order Value',
			'nonTaxedSales' => 'Non Taxed Sales',
			'salesVAT' => 'VAT On Sales',
			'fedexUK' => 'Fedex UK',
			'fedexExpress' => 'Fedex Express',
			'fedexVAT' => 'VAT on Fedex'
		);
	}

	public function formatColumn($column, $value)
	{
		// Format monetary columns with a £ symbol
		if (! in_array($column, array('date', 'ordersPlaced'))) {
			return '&pound;' . number_format($value, 2);
		}

		return $value;
	}

	public function getData($from = null, $limit = null)
	{
		$query = '
			SELECT
				DAY(FROM_UNIXTIME(os.created_at)) AS day,
				MONTH(FROM_UNIXTIME(os.created_at)) AS month,
				YEAR(FROM_UNIXTIME(os.created_at)) AS year,
				CONCAT(DAYOFMONTH(FROM_UNIXTIME(os.created_at)), " ", MONTHNAME(FROM_UNIXTIME(os.created_at))," ",YEAR(FROM_UNIXTIME(os.created_at))) AS date,
				SUM(os.total_gross) AS grossIncome,
				SUM(os.total_net) AS salesExcVAT,
				COUNT(os.order_id) AS ordersPlaced,
				SUM(os.total_gross) / COUNT(os.order_id) AS averageTotal,
				SUM( IF(os.total_tax IS NULL, os.total_net, 0) ) AS nonTaxedSales,
				SUM( IF(os.total_tax IS NOT NULL, os.total_tax, 0) ) AS salesVAT,
				SUM( IF(oa.country_id = "GB", osp.gross, 0) ) AS fedexUK,
				SUM( IF(oa.country_id != "GB", osp.gross, 0) ) AS fedexExpress,
				SUM( IFNULL(osp.tax, 0) ) AS fedexVAT
			FROM
				order_summary os
			LEFT JOIN
				order_address oa ON os.order_id = oa.order_id
			LEFT JOIN
				order_shipping osp ON os.order_id = osp.order_id
			WHERE
				oa.type = "delivery" AND
				os.created_at >= ? AND os.created_at <= ?
			GROUP BY
				date
			ORDER BY
				year DESC, month DESC, day DESC
		';

		$form = $this->getForm()->getFilteredData();

		if ($month = $this->_controller->get('request')->query->get('month') and
			! isset($form['month'])
		) {
			$form['month'] = $month;
		}

		// Get the data in the date range, default to last 30 days.
		$date_range = $this->getDateRange($form, 30);
		$params = array(
			$date_range[0]->getTimestamp(),
			$date_range[1]->getTimestamp()
		);
		$rows = $this->_query->run($query, $params);
		$data = $this->getDataInPeriod($rows, $date_range[0], $date_range[1]);

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
		return "Daily Sales";
	}

	public function getDescription()
	{
		return "Daily sales over a selected period";
	}
}