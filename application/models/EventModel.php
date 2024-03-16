<?php

class EventStruct
{
	public $id;

	/**
	 * @var String
	 */
	public $title;

	/**
	 * @var String
	 */
	public $description;

	/**
	 * @var \DateTime
	 */
	public $start_at;

	/**
	 * @var \DateTime
	 */
	public $end_at = "";

	public function __construct()
	{
		$this->id = 0;
		$this->title = "";
		$this->description = "";
		$this->start_at = new DateTime();
		$this->end_at = new DateTime();
	}
}

class EventModel extends CI_Model
{
	public function index()
	{
		$query = $this->db->get('events');

		return $query->result();
	}

	public function save($event)
	{
		if (is_array($event)) {
			$t = $event;
			$event = new EventStruct();
			$event->title = $t['title'];
			$event->description = $t['description'];
			$event->start_at = $t['start_at'];
			$event->end_at = $t['end_at'];
		}
		$this->db->insert('events', $event);
	}

	public function delete($id = 0)
	{
		$query = $this->db->get_where('events', ['id' => $id]);
		if ($query->num_rows() > 0) {
			$this->db->delete('events', ['id' => $id]);
		}
	}

	public function update($event)
	{
		if (isset($event['id'])) {
			$id = $event['id'];
			$query = $this->db->get_where('events', ['id' => $id]);
			if ($query->num_rows() > 0) {
				$this->db->where('id', $id);
				$this->db->update('events', [
					'title' => $event['title'],
					'description' => $event['description'],
					'start_at' => $event['start_at'],
					'end_at' => $event['end_at'],
				]);
			}
		}
	}
}

