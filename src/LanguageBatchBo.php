<?php

namespace Language;

use Language\Translator\ApplicationTranslator;
use Language\Translator\AppletTranslator;

class LanguageBatchBo
{
	public static function generateLanguageFiles()
	{
		// The applications where we need to translate.
		$applications = Config::get('system.translated_applications');

		echo "\nGenerating Application language files\n";

		$translator = new TranslationFileGenerator();
		foreach ($applications as $application => $languages) {
			echo "[APPLICATION: " . $application . "]\n";
			$appObject = new ApplicationTranslator($application);
			$translator->generateLanguageFiles($appObject, $languages);
		}

		echo "\nApplication language files generated.\n";
	}

	public static function generateAppletLanguageXmlFiles()
	{
		// List of the applets [directory => applet_id].
		$applets = array(
			'memberapplet' => 'JSM2_MemberApplet',
		);

		echo "\nGenerating Applet language files\n";

		$translator = new TranslationFileGenerator();
		foreach ($applets as $appletDirectory => $appletLanguageId) {
			echo "[APPLET: " . $appletLanguageId . "]\n";
			$appObject = new AppletTranslator($appletLanguageId);
			$translator->generateLanguageFiles($appObject, $appObject->getLanguages());
		}

		echo "\nApplet language files generated.\n";
	}
}
