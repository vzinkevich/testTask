<?php

namespace Language;

use Language\Translator\BaseTranslator;

class TranslationFileGenerator
{
	public function generateLanguageFiles(BaseTranslator $translationObject, $languages)
	{
		foreach ($languages as $language) {
			$translationObject->setLanguage($language);
			echo "\t[LANGUAGE: " . $language . "]";
			if ($translationObject->generate()) {
				echo "Translation file generated.\n";
			} else {
				throw new \Exception("Unable to generate `{$language}` translation for {$translationObject->getTitle()} object!");
			}
		}
	}
}