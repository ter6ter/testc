<?php
class Comment {
    /**
     * @var int
     */
    public $id;

    /**
     * @var User
     */
	public $user;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $date;

    /**
     * @param array $data
     */
	public function __construct(array $data)
    {
        foreach (['id', 'text', 'date'] as $field) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            }
        }
	    $this->user = User::get($data['user_id']);
	}

	public function save() {
	    $values = [
	        'text' => $this->text,
            'user_id' => $this->user->id,
            'date'  => $this->date];
	    if (isset($this->id)) {
            MyDB::update('comment', $values, $this->id);
        } else {
            MyDB::insert('comment', $values);
        }
    }

	public static function load(int $start = 0, int $limit = 3, string $sort = 'date', string $direction = 'DESC')
    {
        $result = [];
        $rows = MyDB::query("SELECT * FROM comment ORDER BY ?order ?direction LIMIT ?start, ?limit",
            ['order' => $sort, 'direction' => $direction, 'start' => $start, 'limit' => $limit]);
        foreach ($rows as $row) {
            $result[] = new Comment($row);
        }
        return $result;
    }

    public static function count() {
	    return MyDB::query("SELECT count(*) FROM comment", [], 'elem');
    }
}