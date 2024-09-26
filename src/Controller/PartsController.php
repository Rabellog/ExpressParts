<?php
declare(strict_types=1);

namespace App\Controller;

use Exception;

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
        $part->modified_by = $this->Auth->user('name');
        if ($this->request->is('post')) {
            $image = $this->request->getData('image');
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            $part->users_id = $this->Auth->user('id');

            if (!empty($image->getClientFilename())) {
                $targetPath = WWW_ROOT . 'img/parts/';
                
                $fileName = time() . '_' . $image->getClientFilename();
                $filePath = $targetPath . $fileName;
                
                $caminhoTemporario = $image->getStream()->getMetadata('uri');

                if (!move_uploaded_file($caminhoTemporario, $filePath)) {
                    $this->Flash->error(__('A {0} não pôde ser salva. Por favor, tente novamente.', 'peça'));
                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                    
                } else {
                    $part->image = $fileName;
                }
            }

            if ($this->Parts->save($part)) {
                $this->Flash->success(__('A {0} foi salva.', 'peça'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('A {0} não pôde ser salva. Por favor, tente novamente.', 'peça'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
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

    public function buscarParts() {
        return $this->Parts->find()
        ->where([
            'Parts.discount IS' => null
        ]);
    }

    public function buscarPartsDiscount() {
        $partsDiscount = $this->Parts->find()
        ->where([
            'Parts.discount IS NOT' => null
        ]);

        foreach($partsDiscount as $part) {
            $part->priceWithDiscount = $part->price - ($part->price * $part->discount / 100);
        }
        return $partsDiscount;
    }
}