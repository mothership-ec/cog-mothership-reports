<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateRange extends AbstractType
{
	public function getName()
	{
		return 'date_range';
	}

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