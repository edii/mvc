<?php  if ( ! defined('PATH_LIBS')) exit('No direct script access allowed');

//include_once(PATH_LIBS.DS.'database'.DS.'DB_active_rec.php');
//include_once(PATH_LIBS.DS.'database'.DS.'DB_driver.php');

function DB($params = '', $active_record_override = NULL) {
        if (is_string($params)) {

		/* parse the URL from the DSN string
		 *  Database settings can be passed as discreet
		 *  parameters or as a data source name in the first
		 *  parameter. DSNs must have this prototype:
		 *  $dsn = 'driver://username:password@hostname/database';
		 */

		if (($dns = @parse_url($params)) === FALSE) {
                        \init::log('connected', \CLogger::LEVEL_ERROR,'exception.DB');
                            throw new \CDbException('Invalid DB Connection String');
			
		}

		$params = array(
                    'dbdriver'	=> $dns['scheme'],
                    'hostname'	=> (isset($dns['host'])) ? rawurldecode($dns['host']) : '',
                    'username'	=> (isset($dns['user'])) ? rawurldecode($dns['user']) : '',
                    'password'	=> (isset($dns['pass'])) ? rawurldecode($dns['pass']) : '',
                    'database'	=> (isset($dns['path'])) ? rawurldecode(substr($dns['path'], 1)) : ''
                );

		// were additional config items set?
		if (isset($dns['query'])) {
			parse_str($dns['query'], $extra);

			foreach ($extra as $key => $val) {
				// booleans please
				if (strtoupper($val) == "TRUE") {
					$val = TRUE;
				} elseif (strtoupper($val) == "FALSE") {
					$val = FALSE;
				}

				$params[$key] = $val;
			}
		}
	}

	// No DB specified yet?  Beat them senseless...
	if ( ! isset($params['dbdriver']) OR $params['dbdriver'] == '') {
                \init::log('init', \CLogger::LEVEL_ERROR,'exception.DB');
                            throw new \CDbException('You have not selected a database type to connect to.');
		
	}

	// Load the DB classes.  Note: Since the active record class is optional
	// we need to dynamically create a class that extends proper parent class
	// based on whether we're using the active record class or not.
	// Kudos to Paul for discovering this clever use of eval()

        
	if ($active_record_override !== NULL) {
		$active_record = $active_record_override;
	}

        

	if ( ! isset($active_record) OR $active_record == TRUE) {
		
		if ( ! class_exists('CI_DB')) {
			//eval('class CI_DB extends CI_DB_active_record { }');
		}
	} else {
		if ( ! class_exists('CI_DB')) {
			// eval('class CI_DB extends CI_DB_driver { }');
		}
	}

	require_once(PATH_LIBS.DS.'database'.DS.'drivers'.DS.$params['dbdriver'].DS.$params['dbdriver'].'_driver.php');

        
        //echo "path = ".PATH_LIBS.DS.'database'.DS.'drivers'.DS.$params['dbdriver'].DS.$params['dbdriver'].'_driver.php';
        //die('stop');
	// Instantiate the DB adapter
	$driver = 'CI_DB_'.$params['dbdriver'].'_driver';
	$DB = new $driver($params);

        // var_dump( $DB );
        // die('DB');
        
	if ($DB->autoinit == TRUE) {
		$DB->initialize();
	}

	if (isset($params['stricton']) and $params['stricton'] == TRUE) {
		$DB->query('SET SESSION sql_mode="STRICT_ALL_TABLES"');
	}
        

        
        //echo "<pre>";
        //var_dump( $params );
        //echo "</pre>";
        
        //$DB = 'main';
        
	return $DB;
}

// class CI_Activ_DB extends CI_DB_active_record { }

class CI_DB extends CI_DB_driver { }