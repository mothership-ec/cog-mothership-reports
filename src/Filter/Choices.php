<?php

namespace Message\Mothership\Report\Filter;

class Choices implements FilterInterface
{
	private $_multichoice;

	public function __construct($filterName, $label = null, $choices = null, $multichoice = null)
	{
		$this->_filterName  = $filterName;
		$this->_label       = $label;
		$this->_choices     = $choices;
		$this->_multichoice = $multichoice;
	}

	public function getForm()
	{
		return new Form\Choices($this->_label, $this->_choices, $this->_multichoice, $this->_filterName);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName()
	{
		return $this->_filterName;
	}

	/**
	 * Gets the type to filter
	 *
	 * @return String the type
	 */
	public function getChoices()
	{
		return $this->_choices;
	}

	/*
	 * Sets the type to filter
	 *
	 * @return String the type
	*/
	public function setChoices($choice)
	{
		return $this->_choices = $choice;
	}

}