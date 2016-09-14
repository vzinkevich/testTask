<?php

namespace Language\Translator;

use Language\ApiCall;
use Language\Config;
use Language\Helpers\ApiResponseValidator;

/**
 * Class BaseTranslator
 * @package Language\Translator
 */
abstract class BaseTranslator
{
	/**
	 * @var string
	 */
	private $target = 'system_api';
	/**
	 * @var string
	 */
	private $mode = 'language_api';
	/**
	 * @var
	 */
	protected $fileExtension;
	/**
	 * @var null
	 */
	protected $title = null;
	/**
	 * @var null
	 */
	protected $language = null;

	/**
	 * @return mixed
	 */
	abstract protected function getFilePath();

	/**
	 * @return mixed
	 */
	abstract protected function getTranslation();

	/**
	 * BaseTranslator constructor.
	 * @param $title
	 */
	public function __construct($title)
	{
		$this->title = $title;
	}

	/**
	 * @param $language
	 */
	public function setLanguage($language)
	{
		$this->language = $language;
	}

	/**
	 * @return null
	 */
	public function getLanguage()
	{
		return $this->language;
	}

	/**
	 * @return null
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param $getParameters
	 * @param $postParameters
	 * @return mixed
	 * @throws \Exception
	 */
	public function getApiData($getParameters, $postParameters)
	{
		$response = ApiCall::call($this->target, $this->mode, $getParameters, $postParameters);

		try {
			ApiResponseValidator::validate($response);
		}
		catch (\Exception $e) {
			throw new \Exception(
				"Getting language file for the object type `{$this->objectType}`` with title `{$this->title}`
				on language `{$this->language}` failed with error: " . $e->getMessage());
		}

		return $response['data'];
	}

	/**
	 * @return string
	 */
	private function getCachePath()
	{
		return Config::get('system.paths.root') . '/cache';
	}

	/**
	 * @return string
	 */
	private function getPath()
	{
		$destination = $this->getCachePath()  . $this->getFilePath();
		var_dump($destination);
		if (!is_dir(dirname($destination))) {
			mkdir(dirname($destination), 0755, true);
		}
		return $destination;
	}

	/**
	 * @return bool
	 */
	public function generate()
	{
		$result = file_put_contents($this->getPath(), $this->getTranslation());
		return (bool)$result;
	}

}
