<?php namespace UniformWares\Reports\ReportType;

abstract class MonthlyReport extends TableReport
{

	/**
	 * Default to the monthly report view.
	 * 
	 * @return string
	 */
	public function getView()
	{
		return '::report:monthlyreport';
	}

	/**
	 * Get the year totals for a column.
	 * 
	 * @param  string $year
	 * @param  string $column
	 * @return mixed
	 */
	public function getYearTotals($year, $column)
	{
		if ($column == 'date') {
			return 'Year Total';
		}

		if (isset($this->data[$year])) {
			$total = 0;
			foreach ($this->data[$year] as $row) {
				$total += $row->$column;
			}
			return $total;
		}

		return false;
	}

}