<?php namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\MonthlyReport;

class MonthlySales extends MonthlyReport
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
		elseif ('date' === $column and 'Year Total' !== $value) {
			$url = $this->_controller->generateUrl('ms.commerce.report.view', array(
				'slug' => 'daily-sales',
				'month' => date('Y-m', strtotime($value)),
			));
			return '<a href="' . $url . '">' . $value . '</a>';
		}

		return $value;
	}

	public function getData($from = null, $limit = null)
	{
		$query = 'SELECT
					MONTH(FROM_UNIXTIME(os.created_at)) AS month,
					YEAR(FROM_UNIXTIME(os.created_at)) AS year,
					CONCAT(MONTHNAME(FROM_UNIXTIME(os.created_at))," ",YEAR(FROM_UNIXTIME(os.created_at))) AS date,
					SUM(os.total_gross) AS grossIncome,
					SUM(os.total_net) AS salesExcVAT,
					COUNT(os.order_id) AS ordersPlaced,
					SUM(os.total_gross) / COUNT(os.order_id) AS averageTotal,
					SUM( IF(os.total_tax IS NULL, os.total_net, 0) ) AS nonTaxedSales,
					SUM( IF(os.total_tax IS NOT NULL, os.total_tax, 0) ) AS salesVAT,
					SUM( IF(oa.country_id = "GB", osp.gross, 0) ) AS fedexUK,
			 		SUM( IF(oa.country_id != "GB", osp.gross, 0) ) AS fedexExpress,
			 		SUM( IFNULL(osp.tax, 0) ) AS fedexVAT,
					os.created_at
				  FROM order_summary os
				  LEFT JOIN order_address oa ON (os.order_id = oa.order_id)
				  LEFT JOIN order_shipping osp ON (os.order_id = osp.order_id)
				  WHERE oa.type = "delivery"
				  GROUP BY date
				  ORDER BY year DESC, month DESC';

		$params = array();

		$rows = $this->_query->run($query, $params);

		// Combine the results into a multi-dimenisional array of years & months
		$data = array();
		foreach ($rows as $row) {
			$data[$row->year][$row->month] = $row;
		}

		$this->data = $data;

		return $data;
	}

	public function getName()
	{
		return "Monthly Sales";
	}

	public function getDescription()
	{
		return "Monthly sales";
	}

}