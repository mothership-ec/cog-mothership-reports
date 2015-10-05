<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateRange extends AbstractType
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
	 * @var string
	 */
	private $_type = 'datetime';

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
	public function __construct($from = null, $to = null)
	{
		$this->_from = $from;
		$this->_to   = $to;
	}

	/**
	 * Gets the filter name.
	 *
	 * @return string Name of the filter
	 */
	public function getName()
	{
		return 'date_range';
	}

	/**
	 * Set which type of form to use to create the date range form, available options:
	 * - 'date'
	 * - 'datetime'
	 *
	 * @param $type
	 */
	public function setType($type)
	{
		if (!is_string($type)) {
			$varType = (gettype($type) === 'object') ? get_class($type) : gettype($type);
			throw new \InvalidArgumentException('Type must be a string, ' . $varType . ' given');
		}

		if (!in_array($type, $this->_validFormTypes)) {
			throw new \InvalidArgumentException('`' . $type . '` is not a valid form type for this filter, allowed options: ' . implode(', ', $this->_validFormTypes));
		}

		$this->_type = $type;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('startdate', $this->_type, [
			'label' => 'From',
			'data'  => $this->_from ?: null,
		]);
		$builder->add('enddate', $this->_type, [
			'label' => 'To',
			'data'  => $this->_to ?: null,
		]);
	}
}