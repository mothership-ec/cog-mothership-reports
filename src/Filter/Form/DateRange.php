<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateRange extends AbstractType
{
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
			'label' => 'From'
		]);
		$builder->add('enddate', 'datetime', [
			'label' => 'To'
		]);
	}
}