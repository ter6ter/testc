<?php
class User {
	public $id;

	public $login;

	private static $_all = [];

    /**
     * @param int $id
     * @return User
     */
	public static function get(int $id)
    {
		if (isset(User::$_all[$id])) {
			return User::$_all[$id];
		} else {
            $data = MyDB::query("SELECT * FROM user WHERE id = ?id", ['id' => $id], 'row');
			return new User($data);
		}
	}


    /**
     * @param string $login
     * @param string $password
     * @return false|User
     * @throws Exception
     */
	public static function login(string $login, string $password)
    {
        $password_hash = md5($password.PASSWORD_SALT);
        $data = MyDB::query("SELECT * FROM user WHERE login = '?login' AND password = '?password'",
            ['login' => $login, 'password' => $password_hash], 'row');
        if ($data) {
            $_SESSION['uid'] = $data['id'];
            return new User($data);
        } else {
            return false;
        }
    }

    /**
     * @param array $data
     */
	public function __construct(array $data)
    {
        $this->login = $data['login'];

        if (isset($data['id'])) {
            $this->id = $data['id'];
            User::$_all[$this->id] = $this;
        }
	}

    /**
     * @param string $text
     * @return Comment
     */
	public function add_comment(string $text) {
	    $comment = new Comment([
	        'text' => htmlspecialchars($text),
            'user_id' => $this->id,
            'date' => date('Y-m-d H:i:s')
            ]);
        $comment->save();
	    return $comment;
    }

    /**
     * @param string $start
     * @return array
     * @throws Exception
     */
    public static function get_variants(string $start) {
	    $data = MyDB::query("SELECT login FROM user WHERE login LIKE '?start%' ORDER BY login",
            ['start' => $start]);
	    $result = [];
	    foreach ($data as $row) {
	        $result[] = $row['login'];
        }
        return $result;
    }
}