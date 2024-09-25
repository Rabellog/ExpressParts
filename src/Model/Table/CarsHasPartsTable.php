<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CarsHasParts Model
 *
 * @property \App\Model\Table\PartsTable&\Cake\ORM\Association\BelongsTo $Parts
 * @property \App\Model\Table\CarsTable&\Cake\ORM\Association\BelongsTo $Cars
 *
 * @method \App\Model\Entity\CarsHasPart newEmptyEntity()
 * @method \App\Model\Entity\CarsHasPart newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CarsHasPart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CarsHasPart get($primaryKey, $options = [])
 * @method \App\Model\Entity\CarsHasPart findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CarsHasPart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CarsHasPart[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CarsHasPart|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarsHasPart saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CarsHasPart[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarsHasPart[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarsHasPart[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CarsHasPart[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CarsHasPartsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cars_has_parts');
        $this->setDisplayField(['parts_id', 'cars_id']);
        $this->setPrimaryKey(['parts_id', 'cars_id']);

        $this->belongsTo('Parts', [
            'foreignKey' => 'parts_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cars', [
            'foreignKey' => 'cars_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('parts_id', 'Parts'), ['errorField' => 'parts_id']);
        $rules->add($rules->existsIn('cars_id', 'Cars'), ['errorField' => 'cars_id']);

        return $rules;
    }
}
