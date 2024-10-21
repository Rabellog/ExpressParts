<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Expression\QueryExpression;
use Exception;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['pesquisarPecasCatalogo']);
    }
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
                    $this->Flash->error(__('A Peça não pode ser salva. Por favor, tente novamente.'));
                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                } else {
                    $part->image = $fileName;
                }
            }

            if ($this->Parts->save($part)) {
                $this->Flash->success(__('A Peça foi salva.'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('A Peça não pode ser salva. Por favor, tente novamente.'));
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
    public function edit($partId = null)
    {
        $part = $this->Parts->get($partId, [
            'contain' => ['Cars']
        ]);

        if (!$partId) {
            $this->Flash->error(__('Peça não encontrada.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $image = $this->request->getData('image');
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            $part->users_id = $this->Auth->user('id');
            $part->modified_by = $this->Auth->user('name'); 

            if (!empty($image->getClientFilename())) {
                $targetPath = WWW_ROOT . 'img/parts/';
                $fileName = time() . '_' . $image->getClientFilename();
                $filePath = $targetPath . $fileName;
            
                $caminhoTemporario = $image->getStream()->getMetadata('uri');
            
                // Mover o arquivo para o caminho final
                if (!move_uploaded_file($caminhoTemporario, $filePath)) {
                    $this->Flash->error(__('A Peça não pode ser editada. Por favor, tente novamente.'));
                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                } else {
                    // Se o upload foi bem-sucedido, atualize o campo 'image'
                    $part->image = $fileName;
                }
            } else {
                // Quando não há uma nova imagem enviada
                // Verifique se a peça já tem uma imagem anterior
                if (!empty($part->image)) {
                    // Mantém a imagem existente
                    $part->image = $part->image; 
                } else {
                    // Se não houver uma imagem anterior, pode definir um valor padrão ou tratar o caso
                    $this->Flash->error(__('A Peça precisa ter uma imagem. Por favor, envie uma.'));
                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                }
            }
            

            if ($this->Parts->save($part)) {
                $this->Flash->success(__('A Peça foi editada.'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('A Peça não pode ser editada. Por favor, tente novamente.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
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

    public function buscarPecas()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $paginaAtual = $this->request->getQuery('pagina');
            $quantidadeItens = $this->request->getQuery('exibir');
            $partName = $this->request->getQuery('searchPart');

            $offset = ($paginaAtual - 1) * $quantidadeItens;

            $pecas = $this->Parts->find()
                ->where([
                    'Parts.active' => 1,
                    'Parts.name LIKE' => "$partName%",
                    'Parts.discount IS' => null
                ])
                ->limit($quantidadeItens)
                ->offset($offset)
                ->orderAsc('Parts.name')
                ->all();
        } catch (Exception $e) {
            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }
        $response['data'] = $pecas;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    public function buscarQuantidadeTotalPaginas()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $quantidadeItens = $this->request->getQuery('exibir');
            $partName = $this->request->getQuery('searchPart');

            $totalItens = $this->Parts->find()
                ->select(['total' => 'COUNT(*)'])
                ->where([
                    'Parts.active' => 1,
                    'Parts.name LIKE' => "$partName%",
                    'Parts.discount IS' => null
                ])
                ->first();

            $totalItensCount = $totalItens ? $totalItens->total : 0;

            $pages = ceil($totalItensCount / $quantidadeItens);

            $pages = range(1, $pages);
        } catch (Exception $e) {
            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }
        $response['data'] = $pages;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    public function buscarPecasDiscount()
    {
        $partsDiscount = $this->Parts->find()
            ->where([
                'Parts.discount IS NOT' => null,
                'Parts.discount IS NOT' => 0,
                'Parts.stock IS NOT' => 0
            ])
            ->orderAsc('Parts.name');

        foreach ($partsDiscount as $part) {
            $part->priceWithDiscount = $part->price - ($part->price * $part->discount / 100);
        }
        return $partsDiscount;
    }

    public function pesquisarPecasPorId()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $partId = $this->request->getQuery('partId');
            $parts = $this->Parts->find()
                ->select([
                    'Parts.id',
                    'Parts.image',
                    'Parts.name',
                    'Parts.price',
                    'Parts.stock',
                    'Parts.discount'
                ])
                ->where([
                    'Parts.active' => 1,
                    'Parts.id' => $partId
                ])
                ->toArray();
        } catch (Exception $e) {

            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }

        $response['data'] = $parts;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    public function pesquisarPecasDesconto()
    {
        $response = [
            'data' => [],
            'hasError' => false,
            'message' => ''
        ];

        try {
            $partName = $this->request->getQuery('partName');
            $parts = $this->Parts->find()
                ->select([
                    'Parts.id',
                    'Parts.name'
                ])
                ->where([
                    'Parts.active' => 1,
                    'Parts.name LIKE' => "%$partName%"
                ])
                ->orderAsc('Parts.name')
                ->toArray();
        } catch (Exception $e) {

            $response['hasError'] = true;
            $response['message'] = 'Erro inesperado!';
            return  $this->response->withType("application/json")->withStringBody(json_encode($response));
        }

        $response['data'] = $parts;
        return  $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    public function addDesconto($partId)
    {
        $response = [
            'hasError' => false,
            'message' => ''
        ];

        if ($this->request->is('post')) {
            $part = $this->Parts->get($partId);

            $discount = $this->request->getData('discount');
            if ($discount) {
                $part->discount = $discount;
            } else {
                $part->discount = null;
            }

            if ($this->Parts->save($part)) {
                $this->Flash->success(__('A Oferta foi aplicada.'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('A Oferta não pode ser aplicada. Por favor, tente novamente.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        return $this->response->withType("application/json")->withStringBody(json_encode($response));
    }
}
