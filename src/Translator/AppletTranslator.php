<?php

namespace Language\Translator;

/**
 * Class AppletTranslator
 * @package Language\Translator
 */
class AppletTranslator extends BaseTranslator
{
	/**
	 * @var string
	 */
	protected $fileExtension = 'xml';

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getLanguages()
	{
		return $this->getApiData(
			array(
				'system' => 'LanguageFiles',
				'action' => 'getAppletLanguages'
			),
			array(
				'applet' => $this->getTitle()
			)
		);
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getTranslation()
	{
		return $this->getApiData(
			array(
				'system' => 'LanguageFiles',
				'action' => 'getAppletLanguageFile'
			),
			array(
				'applet' => $this->getTitle(),
				'language' => $this->getLanguage()
			)
		);
	}

	/**
	 * @return string
	 */
	protected function getFilePath()
	{
		return '/flash/lang_' . $this->getLanguage() . '.' . $this->fileExtension;
	}

}
