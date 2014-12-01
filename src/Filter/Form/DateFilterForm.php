<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateFilterForm extends AbstractType
{
	public function getName()
	{
		return 'filter_date_form';
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('startdate', 'date');
		$builder->add('enddate', 'date');
	}
}