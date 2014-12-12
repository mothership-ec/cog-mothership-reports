<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Choices extends AbstractType
{
	public function __construct($label, $choices, $multichoice, $filterName)
    {
    	$this->label = $label;
        $this->choices = $choices;
        $this->multichoice = $multichoice;
        $this->filterName = $filterName;
    }

	public function getName()
	{
		return $this->filterName;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('choices', 'choice', [
			'label'    => $this->label,
			'choices'  => $this->choices,
			'multiple' => $this->multichoice
		]);
	}
}