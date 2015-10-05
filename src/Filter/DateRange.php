<?php

namespace Message\Mothership\Report\Filter;

class DateRange implements FilterInterface
{
	/**
	 * @var \DateTime | null
	 */
	private $_from;

	/**
	 * @var \DateTime | null
	 */
	private $_to;

	/**
	 * @var string | null
	 */
	private $_type;

	/**
	 * @var array
	 */
	private $_validFormTypes = [
		'date',
		'datetime'
	];

	/**
	 * Constructor.
	 *
	 * @param  \DateTime     $to
	 * @param  \DateTime     $from
	 */
	public function __construct($to = null, $from = null)
	{
		$this->_to   = $to;
		$this->_from = $from;
	}

	/**
	 * Set which type of form fields the DateRange form should use. Available options:
	 * - 'date'
	 * - 'datetime'
	 *
	 * @param string $type
	 * @throws \InvalidArgumentException   Throws exception if $type is not a string
	 * @throws \LogicException             Throws exception if $type is not listed as valid
	 */
	public function setFormType($type)
	{
		if (!is_string($type)) {
			$varType = (gettype($type) === 'object') ? get_class($type) : gettype($type);
			throw new \InvalidArgumentException('Tyoe must be a string, ' . $varType . ' given');
		}

		if (!in_array($type, $this->_validFormTypes)) {
			throw new \LogicException('`' . $type . '` is not a valid form type for this filter, allowed options: ' . implode(', ', $this->_validFormTypes));
		}

		$this->_type = $type;
	}

	/**
	 * Gets the form for the filter.
	 *
	 * @return Form\DateRange the form
	 */
	public function getForm()
	{
		$form = new Form\DateRange($this->getStartDate(), $this->getEndDate());

		if (null !== $this->_type) {
			$form->setType($this->_type);
		}

		return $form;
	}

	/**
	 * Gets the names of the filter.
	 *
	 * @return String the name
	 */
	public function getName()
	{
		return 'date_range';
	}

	/**
	 * Gets the date to filter from
	 *
	 * @return \DateTime the start date
	 */
	public function getStartDate()
	{
		return $this->_from;
	}

	/**
	 * Gets the date to filter to
	 *
	 * @return \DateTime the end date
	 */
	public function getEndDate()
	{
		return $this->_to;
	}

	/**
	 * Sets the date to filter from
	 *
	 * @param \DateTime $from
	 *
	 * @return \DateTime the start date
	 */
	public function setStartDate($from)
	{
		return $this->_from = $from;
	}

	/**
	 * Sets the date to filter to
	 *
	 * @param \DateTime $to
	 *
	 * @return \DateTime the end date
	 */
	public function setEndDate($to)
	{
		return $this->_to = $to;
	}
}