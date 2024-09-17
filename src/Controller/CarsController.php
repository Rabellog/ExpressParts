<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $cars = $this->paginate($this->Cars);

        $this->set(compact('cars'));
    }

    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('car'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $car = $this->Cars->newEmptyEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            $car->users_id = $this->Auth->user('id');
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            $car->modified_by = $this->Auth->user('id');
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
