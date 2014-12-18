<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateRange extends AbstractType
{
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
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('startdate', 'datetime', [
			'label' => 'From',
			'data'  => $this->_from ?: null,
		]);
		$builder->add('enddate', 'datetime', [
			'label' => 'To',
			'data'  => $this->_to ?: null,
		]);
	}
}