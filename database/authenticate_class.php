<?php
/** 
 * Pages that authenticates 
 * @version 1.0
 */
require_once('connection_class.php');

// Class derives from db connections
class Authenticate extends Connection
{
	private $data = array();
	// constructor
	public function __construct()
	{
		$this->erro = '';
	}
	// Set values for object
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}
	// return requested object and its contents
	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		// Exception handling
		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE
		);
		return null;
	}

	public function IsEmpty(array $data_array)
	{
		/**
		 * Function tests whether a given array is empty or contains some empty string, used to help verify form inputs
		 * returns true if some element in array is empty/null
		 * @version 1.0
		 * @param $data_array Array containing all required data
		 */
		return in_array("", $data_array);
	}

	
	

	
	public function Insert()
	{
		/**
		 * function Insert data in database based on Type parameter
		 * @version 1.0
		 * @param $this->type Parameter must contain one of the already defined type on switch: CreateUser
		 * @param $this->param Array containing all data required for INSERT
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get insert type
			switch ($this->type) {
				case 'CreateUser':
					$insert = "INSERT INTO lib_user(username, pw, first_name, last_name, birthyear, email) VALUES(?, ?, ?, ?, ?, ?);";
					break;
				
				case 'PostComment':
					$insert = "INSERT INTO lib_comment(lib_user_ID, book_ID, contents) VALUES (?, ?, ?)";
					break;

				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($insert);
			// execute and bind parameters
			$stmt->execute($this->param);
			// Disconnect
			$stmt = null;
			return TRUE;
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}

	public function Fetch()
	{
		/**
		 * function Fetchs data from database based on Type parameter
		 * @version 1.0
		 * @param $this->type Parameter must contain one of the already defined type on switch: GetUsers, CheckNick, GetWebhook
		 * @param $this->param Array containing all data required for SELECT
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get update type
			switch ($this->type) {
				case 'GetGenres':
					$query = "SELECT * FROM lib_genre";
					break;
				
				case 'GetBooks':
					$query = "SELECT * FROM lib_book";
					break;
				
				case 'GetBookById':
					$query = "SELECT lb.ID, lb.title, la.first_name, la.last_name FROM lib_book as lb
					INNER JOIN lib_author as la ON la.ID = lb.author_ID 
					WHERE lb.ID = ? LIMIT 1";
					break;

				case 'GetCommentByBook': 
					$query = "SELECT lc.ID, lc.contents, lu.first_name FROM lib_comment as lc
					INNER JOIN lib_user as lu ON lu.ID = lc.lib_user_ID
					WHERE book_ID = ?";
					break;
				case 'LoginUser':
					$query = "SELECT * FROM lib_user WHERE email = ? and pw = ? LIMIT 1";
					break;

				case 'GetGenreBooks':
					$query = "SELECT lb.ID, lb.title FROM lib_book as lb
					INNER JOIN lib_has_genre as lg ON lb.ID = lg.book_ID
					INNER JOIN lib_genre as l ON l.ID = lg.genre_ID
					WHERE l.ID = ?
					";
					break;
					
				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($query);
			// execute and bind parameters
			$stmt->execute($this->param);
			// fetch results
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Disconnect
			$stmt = null;
			// validate db fetch returned data
			if (!empty($result) && count($result)) {
				// success
				return $result;
			} else {
				// failure
				return FALSE;
			}
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}
}
?>