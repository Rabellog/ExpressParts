<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Exception;

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
        $car->modified_by = $this->Auth->user('name');
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            $car->users_id = $this->Auth->user('id');
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('O {0} foi salvo.', 'carro'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('O {0} não pôde ser salvo. Por favor, tente novamente.', 'carro'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
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
                $this->Flash->success(__('O Carro foi editado com sucesso!.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Carro não pode ser editado. Por favor, tente novamente.'));
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

    public function pesquisarCarros()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $carName = $this->request->getQuery('carName');
            $cars = $this->Cars->find()
                ->select([
                    'Cars.id',
                    'Cars.name'
                ])
                ->where([
                    'Cars.active' => 1,
                    'Cars.name LIKE' => "%$carName%"
                ])
                ->orderAsc('Cars.name')
                ->toArray();
        } catch (Exception $e) {

            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }

        $response['data'] = $cars;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    public function carsList()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $cars = $this->paginate($this->Cars);

        $this->set(compact('cars'));
    }

    public function pesquisarCarrosRelacionados()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $partId = $this->request->getQuery('partId');
            $cars = $this->Cars->find()
            ->matching('Parts', function ($q) use ($partId) {
                return $q->where(['Parts.id' => $partId]);
            })
            ->all();
        } catch (Exception $e) {

            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }

        $response['data'] = $cars;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));

    }
}
