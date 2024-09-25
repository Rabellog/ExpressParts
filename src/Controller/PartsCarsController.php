<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PartsCars Controller
 *
 * @property \App\Model\Table\PartsCarsTable $PartsCars
 * @method \App\Model\Entity\PartsCar[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartsCarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parts', 'Cars'],
        ];
        $partsCars = $this->paginate($this->PartsCars);

        $this->set(compact('partsCars'));
    }

    /**
     * View method
     *
     * @param string|null $id Parts Car id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partsCar = $this->PartsCars->get($id, [
            'contain' => ['Parts', 'Cars'],
        ]);

        $this->set(compact('partsCar'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partsCar = $this->PartsCars->newEmptyEntity();
        if ($this->request->is('post')) {
            $partsCar = $this->PartsCars->patchEntity($partsCar, $this->request->getData());
            if ($this->PartsCars->save($partsCar)) {
                $this->Flash->success(__('The parts car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parts car could not be saved. Please, try again.'));
        }
        $parts = $this->PartsCars->Parts->find('list', ['limit' => 200])->all();
        $cars = $this->PartsCars->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('partsCar', 'parts', 'cars'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Parts Car id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partsCar = $this->PartsCars->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partsCar = $this->PartsCars->patchEntity($partsCar, $this->request->getData());
            if ($this->PartsCars->save($partsCar)) {
                $this->Flash->success(__('The parts car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parts car could not be saved. Please, try again.'));
        }
        $parts = $this->PartsCars->Parts->find('list', ['limit' => 200])->all();
        $cars = $this->PartsCars->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('partsCar', 'parts', 'cars'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Parts Car id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partsCar = $this->PartsCars->get($id);
        if ($this->PartsCars->delete($partsCar)) {
            $this->Flash->success(__('The parts car has been deleted.'));
        } else {
            $this->Flash->error(__('The parts car could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
