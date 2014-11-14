<?php

namespace Message\Mothership\Report\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;

class DateRange extends AbstractType
{
	public function getView()
	{
		return "Message:Mothership:Report::forms:date-range-form";
	}

	public function getName()
	{
		return 'report-date-range-form';
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('date_from', 'datetime');
		$builder->add('date_to', 'datetime');
	}
}


