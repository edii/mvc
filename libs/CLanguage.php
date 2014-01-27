<?php
/**
 * CLanguage class file.
 *
 * @author Sergei Novickiy <edii87shadow@gmail.com>
 * @copyright Copyright &copy; 2013 
 */


class CLanguage extends \CApplicationComponent
{
       private static $db; 
    
       private $_languages = false;
       private $_language = false;
       private $_defaultlang;
        
	/**
	 * Constructor.
	 */
	public function __construct($name = false,$basePath = false,$baseUrl = false) {
		self::$db = \init::app() -> getDBConnector();
                $this -> setLanguages();
                $this -> setDefaultLang();
                
                $route = \init::app()->getUrlManager()->parseUrl( \init::app()->getRequest() );
                if($_lang_code = explode('/', $route) and is_array($_lang_code) and count($_lang_code) > 0) {
                    $this ->setLanguage( $_lang_code[0] );
                }
	}
        
        public function init() {
            parent::init();
        } // init load Box

        /**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
	public function run()
	{
	}
        
        
        public function issetLanguage($code) {
            if(!empty($code) and in_array($code, array_keys( $this->_languages )))
                    return true;
            else 
                return false;
        }
        
        public function getLanguages() {
            return $this->_languages;
        }
        
        public function getLanguage() {
            return $this -> _language;
        }
        
        protected function setLanguage( $code = false ) {
            if(empty( $code ) 
                    and $_settings = \init::app() -> getSettings() 
                    and is_array($_settings)
                    and isset($_settings['lang'])) {
                if($_settings['lang'])
                    $this->_language = $this -> setLang($_settings['lang']);
            } else if(!empty($code)) {
                $this -> _language = $this -> setLang( $code );
            } else {
                $this -> _language = $this -> setLang( false );
            }
            
            return $this -> _language;
        }
        
        protected function setDefaultLang() {
            
            if(empty( $this ->_defaultlang )) {
                $_query = self::$db -> query( "SELECT `LanguageID` as `lang_id`, 
                                                                  `LanguageCode` as `lang_code`, 
                                                                  `LanguageName` as `lang_name`, 
                                                                  `LanguageIsDefault` as `lang_def`, 
                                                                  `LanguageIcon` as `lang_icon`,
                                                                  `LanguageIconActive` as `lang_icon_active`,
                                                                  `LanguagePosition` as `lang_pos`,
                                                                  `LanguageLocale` as `lang_locale`
                                                          FROM `language` 
                                                          WHERE `LanguageID` <> 0 
                                                                AND `hidden` = 0
                                                                AND LanguageIsDefault = 1 ORDER BY LanguageID ASC LIMIT 1") -> fetchAll();
                if(is_array($_query ) and count($_query) > 0) {
                    foreach($_query as $_lang) :
                        $this ->_defaultlang[ $_lang->lang_code ] = (array)$_lang;
                    endforeach;
                }
                
            }
            
            return $this ->_defaultlang;
        }
        
        protected function setLanguages() {
            if(empty( $this -> _languages )) {
                $this -> _languages = self::$db -> query( "SELECT `LanguageID` as `lang_id`, 
                                                                  `LanguageCode` as `lang_code`, 
                                                                  `LanguageName` as `lang_name`, 
                                                                  `LanguageIsDefault` as `lang_def`, 
                                                                  `LanguageIcon` as `lang_icon`,
                                                                  `LanguageIconActive` as `lang_icon_active`,
                                                                  `LanguagePosition` as `lang_pos`,
                                                                  `LanguageLocale` as `lang_locale`
                                                          FROM `language` 
                                                          WHERE `LanguageID` <> 0 AND `hidden` = 0") -> fetchAll();
            }
            return $this -> _languages;
        }
        
        protected function setLang( $code ) {
            $_res = false;
            if(!empty($code)) {
                $_all_langs = $this ->getLanguages();
                
                if(!is_array($_all_langs) and count($_all_langs) <= 0) return $this -> _defaultlang;
                
                foreach($_all_langs as $_lang) {
                    $_all_langs[$lang -> lang_code] = (array)$_lang; 
                }
                
                if($this ->issetLanguage($code)) {
                    $_res = $_all_langs[ $code ];
                } else {
                    $_res = $this -> _defaultlang;
                }
            } else {
                $_res = $this -> _defaultlang;
            }
            
            return $_res;
        }
}
