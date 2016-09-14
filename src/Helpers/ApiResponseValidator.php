<?php

namespace Language\Helpers;

/**
 * Class ApiResponseValidator
 * @package Language\Helpers
 */
final class ApiResponseValidator
{
	/**
	 * @param $result
	 * @throws \Exception
	 */
	public static function validate($result)
	{
		self::validateApiCall($result);
		self::validateResponse($result);
		self::validateContent($result);
	}

	/**
	 * @param $result
	 * @throws \Exception
	 */
	private static function validateApiCall($result)
	{
		// Error during the api call.
		if ($result === false || !isset($result['status'])) {
			throw new \Exception('Error during the api call');
		}
	}

	/**
	 * @param $result
	 * @throws \Exception
	 */
	private static function validateResponse($result)
	{
		// Wrong response.
		if ($result['status'] != 'OK') {
			throw new \Exception('Wrong response: '
				. (!empty($result['error_type']) ? 'Type(' . $result['error_type'] . ') ' : '')
				. (!empty($result['error_code']) ? 'Code(' . $result['error_code'] . ') ' : '')
				. ((string)$result['data']));
		}
	}

	/**
	 * @param $result
	 * @throws \Exception
	 */
	private static function validateContent($result)
	{
		// Wrong content.
		if ($result['data'] === false) {
			throw new \Exception('Wrong content!');
		}
	}
}
