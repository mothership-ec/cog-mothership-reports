<?php namespace Message\Mothership\Report\ReportType;

use Message\Cog\Filesystem\File;

abstract class DownloadableReport extends Report {

	/**
	 * The file to be written / read.
	 *
	 * @var \Message\Cog\Filesystem\File
	 */
	protected $file;

	/**
	 * CSV delimiter character.
	 *
	 * @var string
	 */
	protected $delimiter = ',';

	/**
	 * CSV enclosure character.
	 *
	 * @var string
	 */
	protected $enclosure = '"';

	/**
	 * Is the download file built in stages?
	 *
	 * @var bool
	 */
	protected $batch = false;

	/**
	 * Max time spent building a report batch, in milliseconds.
	 *
	 * @var integer
	 */
	protected $batchTime;

	/**
	 * Max number of items to build into a batch.
	 *
	 * @var integer
	 */
	protected $batchLimit;

	/**
	 * Total number of items to build into the report. Leave as null for unlimited.
	 *
	 * @var integer;
	 */
	protected $limit;

	public function download()
	{
		// header('Content-type: text/csv');
		// header('Content-Disposition: attachment; filename=message-reports-first-purchase.csv');

		$file = $this->getFile();

		d($file->read());
		return;

		$response = new \Message\Cog\HTTP\Response;
		$response->setContent($file->read());
		$response->headers->set('Content-Type', 'text/csv');
		$response->headers->set('Content-Disposition', 'attachment; filename=' . $file->getFilename());

		return $response;

		// d($controller->get('response_builder'));
		// return $controller->get('response_builder');
			// 'csv' => $this->getFile()->read()
		// ));
	}

	public function process()
	{
		if ($this->batch) {
			// Queue the batch process method
		} else {
			$this->appendData();
		}
	}

	public function processBatch()
	{
		$file = $this->getFile();

		// $file->fwrite();

		// Queue the next batch process method
	}

	public function appendData($from = null, $count = null)
	{
		$file = $this->getFile();

		$data = $this->getData($from, $count);

		foreach ($data as $row) {
			if (false == $file->fputcsv((array) $row, $this->delimiter, $this->enclosure)) {
				throw new \Exception("Could not write report to file '" . $file->getRealPath() . "'");
			}
		}
	}

	public function getFile()
	{
		if ($this->file === null) {
			// $path = $this->_stream->getLocalPath($this->getFilePath(), 'cog');

			$file = $this->_stream->stream_open($this->getFilePath(), 'rw', 0, null);

			de($file);

			if (! $this->_filesystem->exists($path)) {
				$this->_filesystem->touch($path);
				$this->_filesystem->chmod($path, 0777);
			}

			$this->file = new File($path);
		}

		return $this->file;
	}

	public function getFilePath()
	{
		return 'cog://public/files/Report_' . $this->getName() . '_'.date('Y_m_d_H').'.csv';
	}

}