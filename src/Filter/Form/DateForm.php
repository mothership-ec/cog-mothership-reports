<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateForm extends AbstractType
{
	public function getName()
	{
		return 'date_form';
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('datechoice', 'date', ['label' => 'date']);
	}
}