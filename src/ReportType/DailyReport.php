<?php namespace UniformWares\Reports\ReportType;

abstract class DailyReport extends DateRangeReport
{
	
	/**
	 * Get the months total for a column.
	 * 
	 * @param  string $month
	 * @param  string $column
	 * @return mixed
	 */
	public function getMonthTotals($month, $column)
	{
		if ($column == 'date') {
			return 'Month Total';
		}

		if (isset($this->data[$month])) {
			$total = 0;
			foreach ($this->data[$month] as $row) {
				if (property_exists($row, $column)) {
					$total += $row->$column;
				}
			}
			return $total;
		}

		return false;
	}

	public function getView()
	{
		return '::report:dailyreport';
	}

}