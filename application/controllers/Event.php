<?php
class Event  extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('EventModel');
	}
	public function index() {

		$data['events'] = $this->EventModel->index();
		$this->load->view('event_list', $data);
	}

	// @route('event/add')
	public function add() {
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Titulo del evento', 'required');
		$this->form_validation->set_rules('description', 'Descripcion del evento', 'required');
		$this->form_validation->set_rules('start_at', 'Fecha de inicio del evento', 'required');
		$this->form_validation->set_rules('end_at', 'Fecha de fin del evento', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('event_add');
		} else {
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_at' => $this->input->post('start_at'),
				'end_at' => $this->input->post('end_at'),
			);

			$this->EventModel->save($data);
			$data = [];
			$data['events'] = $this->EventModel->index();
			echo json_encode($data);
			// $this->load->view('event_list', $data);
			// redirect('event');
		}
	}
	// @route('event/update')
	public function update() {
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'Id del evento', 'required');
		$this->form_validation->set_rules('title', 'Titulo del evento', 'required');
		$this->form_validation->set_rules('description', 'Descripcion del evento', 'required');
		$this->form_validation->set_rules('start_at', 'Fecha de inicio del evento', 'required');
		$this->form_validation->set_rules('end_at', 'Fecha de fin del evento', 'required');

		if ($this->form_validation->run() === FALSE) {
			/*$this->load->view('event_update');*/
		} else {
			$data = array(
				'id' => $this->input->post('id'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'start_at' => $this->input->post('start_at'),
				'end_at' => $this->input->post('end_at'),
			);

			$this->EventModel->update($data);
			$data = [];
			$data['events'] = $this->EventModel->index();
			echo json_encode($data);
			// $this->load->view('event_list', $data);
			// redirect('event');
		}
	}

	// @route('event/delete')
	public function delete() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'Id  del evento', 'required');

		if ($this->form_validation->run() === FALSE) {
			// do nothing
		} else {
			$id = $this->input->post('id') ;
			if($id > 0) $this->EventModel->delete($id);
			$data = [];
			$data['events'] = $this->EventModel->index();
			echo json_encode($data);
			// $this->load->view('event_list', $data);
			// redirect('event');
		}
	}

}
