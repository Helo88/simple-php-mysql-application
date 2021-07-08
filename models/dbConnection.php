<?php
// $dsn = 'mysql:dbname=booking;host=127.0.0.1';
// $user = 'root';
// $password = '';

	class Database {
		protected static $db = null;

		public static function connect($user, $password) {
			if(!empty(Database::$db)) return;
			try {
                $dsn = 'mysql:dbname=booking;host=127.0.0.1';
		   		Database::$db = new PDO($dsn, $user, $password);
               

			} catch(PDOException $e){
		   		echo $e->getMessage();
			}
		}

		public function get($field) {
			if(isset($this->{$field}))
				return $this->{$field};
			return null;
		}
	}
?>