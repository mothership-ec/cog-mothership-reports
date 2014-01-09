<?php namespace Message\Mothership\Report\ReportType;

use DateTime;
use DatePeriod;
use DateInterval;

abstract class DateRangeReport extends TableReport
{

	public function view($params = array())
	{
		$form = $this->getForm();

		$params['form'] = $form;

		if (! isset($params['data'])) {
			$params['data'] = $this->getData();
		}

		if (isset($params['show_range']) and true === $params['show_range']) {
			$start = null;
			$end   = null;

			foreach ($params['data'] as $row) {
				if (null === $start or $row->created_at < $start) {
					$start = $row->created_at;
				}

				if (null === $end or $row->created_at > $end) {
					$end = $row->created_at;
				}
			}

			$params['range_start'] = new DateTime('@'.$start);
			$params['range_end']   = new DateTime('@'.$end);

			$params['range_start'] = $params['range_start']->format('j F Y');
			$params['range_end'] = $params['range_end']->format('j F Y');
		}

		return parent::view($params);
	}

	public function getForm()
	{
		// Create the date filter form
		$form = $this->_controller->get('form');

		// Set the form data if it has been submitted
		$formData = $this->_controller->get('request')->get('form');

		// Since we can't get the filtered data yet, fix up the date values to
		// be instances of DateTime.
		foreach(array('date_from', 'date_to') as $field) {
			if (!empty($formData[$field])) {
				$format = $this->_controller->get('helper.date')->detectFormat($formData[$field]);
				$formData[$field] = \DateTime::createFromFormat($format, $formData[$field]);
			}
			else {
				// Ensure empty date values are actually set to null to prevent
				// a transform error expecting a DateTime object.
				$formData[$field] = null;
			}
		}

		$form->setDefaultValues($formData);

		$form->add('month', 'choice', 'View a single month', array(
			'choices' => $this->getMonths(),
			'empty_value' => '-- Select month --'
		))->val()->optional();

		$form->add('date_from', 'date', 'Start date')
			->val()->optional();
		$form->add('date_to', 'date', 'End date')
			->val()->optional();

		return $form;
	}

	public function getStartDate()
	{
		return '1970-01-01';
	}

	public function getMonths()
	{
		$start = $this->getStartDate();
		$now = date('Y-m-d');

		$months = array();

		for ($i = 1; strtotime($start . '+' . $i . 'months') < strtotime($now); $i++) {
			$time = strtotime($start . '+' . $i . 'months');
			$months[date('Y', $time)][date('Y-m', $time)] = date('Y - F', $time);
		}

		krsort($months);

		return $months;
	}

	public function getDateRange($form, $defaultPeriod = 7)
	{
		// Initialise range to last 7 days
		$date_from = new DateTime;
		$date_to = new DateTime;

		$date_from->sub(new DateInterval('P' . $defaultPeriod . 'D')); // a 7 day interval

		if (!empty($form['date_from']) and !empty($form['date_to'])) {
			$date_from = $form['date_from'];
			$date_to = $form['date_to'];

		} elseif (!empty($form['month'])) {
			$date_from = new DateTime($form['month'] . '-01 00:00:00');
			// Set $date_to as the last day of the month in $date_from
			$date_to = DateTime::createFromFormat('Y-m-d H:i:s', $date_from->format('Y-m-t 23:59:59'));
		}

		//Set default times
		$date_from->setTime(0, 0, 0);
		$date_to->setTime(23, 59, 59);

		return array(
			$date_from,
			$date_to
		);
	}

	public function getDataInPeriod($rows, $date_from, $date_to)
	{
		// Combine the results into a multi-dimenisional array of months & days.
		// Looping the period ensures that empty dates are zeroed.
		$data = array();
		$interval = new DateInterval('P1D'); // a 1 day interval
		$period = new DatePeriod($date_from, $interval, $date_to);

		foreach ($period as $date) {
			$m = $date->format('m');
			$d = $date->format('d');

			if (!isset($data[$m]) or !isset($data[$m][$d])) {
				// Initialise dates to have just a 'date' value.
				$data[$m][$d] = (object) array(
					'date' => $date->format('j F Y')
				);
			}

			foreach ($rows as $row) {
				if ($row->month == $m and $row->day == $d) {
					$data[$m][$d] = $row;
				}
			}
		}

		return $data;
	}

	public function getView()
	{
		return '::report:daterangereport';
	}

}