<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Cars'],
        ];
        $parts = $this->paginate($this->Parts);

        $this->set(compact('parts'));
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['Users', 'Cars'],
        ]);

        $this->set(compact('part'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $part = $this->Parts->newEmptyEntity();
        if ($this->request->is('post')) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            $part->users_id = $this->Auth->user('id');
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The {0} has been saved.', 'Part'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Part'));
        }
        $users = $this->Parts->Users->find('list', ['limit' => 200]);
        $cars = $this->Parts->Cars->find('list', ['limit' => 200]);
        $this->set(compact('part', 'users', 'cars'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            $part->modified_by = $this->Auth->user('id');
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The {0} has been saved.', 'Part'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Part'));
        }
        $users = $this->Parts->Users->find('list', ['limit' => 200]);
        $cars = $this->Parts->Cars->find('list', ['limit' => 200]);
        $this->set(compact('part', 'users', 'cars'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Part'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Part'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
