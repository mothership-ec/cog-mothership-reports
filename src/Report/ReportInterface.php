<?php

namespace Message\Mothership\Report\Report;

interface ReportInterface
{
	public function getName();

	public function getDisplayName();

	public function getReportGroup();

	public function generateUrl($routeName, $params = array(), $absolute = UrlGeneratorInterface::ABSOLUTE_PATH);
}