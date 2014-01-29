<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

// namespace framework\gettext;


/**
 * GettextMessageSource represents a message source that is based on GNU Gettext.
 *
 * Each GettextMessageSource instance represents the message tranlations
 * for a single domain. And each message category represents a message context
 * in Gettext. Translated messages are stored as either a MO or PO file,
 * depending on the [[useMoFile]] property value.
 *
 * All translations are saved under the [[basePath]] directory.
 *
 * Translations in one language are kept as MO or PO files under an individual
 * subdirectory whose name is the language ID. The file name is specified via
 * [[catalog]] property, which defaults to 'messages'.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CGettextMessageSource extends \CMessageSource
{
	const MO_FILE_EXT = '.mo';
	const PO_FILE_EXT = '.po';

	/**
	 * @var string
	 */
	public $basePath = '/data/locale';
	/**
	 * @var string
	 */
	public $catalog = 'base';
	/**
	 * @var boolean
	 */
	public $useMoFile = false; // true or false
	/**
	 * @var boolean
	 */
	public $useBigEndian = false;

	/**
	 * Loads the message translation for the specified language and category.
	 * Child classes should override this method to return the message translations of
	 * the specified language and category.
	 * @param string $category the message category
	 * @param string $language the target language
	 * @return array the loaded messages. The keys are original messages, and the values
	 * are translated messages.
	 */
	protected function loadMessages($category, $language)
	{
		$messageFile = PATH.$this->basePath . '/' . $language . '/' . $this->catalog;
		if ($this->useMoFile) {
			$messageFile .= static::MO_FILE_EXT;
		} else {
			$messageFile .= static::PO_FILE_EXT;
		}

               
                
		if (is_file($messageFile)) {
			if ($this->useMoFile) {
				$gettextFile = new CGettextMoFile(array('useBigEndian' => $this->useBigEndian));
			} else {
				$gettextFile = new CGettextPoFile();
			}
                        
                        
                        
			$messages = $gettextFile->load($messageFile, $category);
                        
                        // var_dump( $messages ); die('po'); 
                        
			if (!is_array($messages)) {
				$messages = array();
			}
			return $messages;
		} else {
			\init::trace("The message file for category '$category' does not exist: $messageFile", __METHOD__);
			return array();
		}
	}
}
