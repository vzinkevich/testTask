<?php

namespace Language\Translator;

/**
 * Class ApplicationTranslator
 * @package Language\Translator
 */
class ApplicationTranslator extends BaseTranslator
{
	/**
	 * @var string
	 */
	protected $fileExtension = 'php';

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getTranslation()
	{
		return $this->getApiData(
			array(
				'system' => 'LanguageFiles',
				'action' => 'getLanguageFile'
			),
			array(
				'language' => $this->getLanguage()
			)
		);
	}

	/**
	 * @return string
	 */
	protected function getFilePath()
	{
		return '/' . $this->getTitle(). '/' . $this->getLanguage() . '.' . $this->fileExtension;
	}
}