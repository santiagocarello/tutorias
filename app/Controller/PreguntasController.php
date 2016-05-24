<?php
App::uses('AppController', 'Controller');

class PreguntasController extends AppController {
	public $paginate = [
		'limit' => 25,
		'order' => [
			'Pregunta.orden' => 'asc'
		]
	];

	public function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->paginate());
	}

	public function add() {
		$this->set('tipos', $this->Pregunta->tipos());

		if ($this->request->is('post')) {
			$this->Pregunta->create();

			if ($this->Pregunta->save($this->request->data)) {
				$this->Flash->success('La pregunta ha sido creada correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido crear la pregunta. Por favor, intente nuevamente.');
		}
	}

	public function edit($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Pregunta inválida'));
		}

		$this->set('tipos', $this->Pregunta->tipos());

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Flash->success('La pregunta ha sido actualizada correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido actualizar la pregunta. Por favor, intente nuevamente.');
		}

		$this->request->data = $this->Pregunta->read();
	}

	public function activate($id = null, $value = 0) {
		$this->request->allowMethod('post', 'put');
		$this->autoRender = false;

		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Pregunta inválida'));
		}

		$estado = $this->Pregunta->field('activo');
		if ($estado != $value) {
			$this->Pregunta->saveField('activo', $value);
		}
	}
}
