<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProdutosClientes Model
 *
 * @method \App\Model\Entity\ProdutosCliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProdutosCliente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProdutosCliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosCliente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProdutosCliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosCliente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosCliente findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProdutosClientesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('produtos_clientes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CreatedByData', [
            'className' => 'Users',
            'foreignKey' => 'created_by'            
        ]);
        $this->belongsTo('ModifiedByData', [
            'className' => 'Users',
            'foreignKey' => 'modified_by'            
        ]);
        $this->belongsTo('DeletedByData', [
            'className' => 'Users',
            'foreignKey' => 'deleted_by'            
        ]);
        $this->belongsTo('Produtos', [
            'className' => 'Produtos',
            'foreignKey' => 'id_produto'           
        ]);
        $this->belongsTo('Clientes', [
            'className' => 'Clientes',
            'foreignKey' => 'id_cliente'          
        ]);
        }

    

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('id_cliente')
            ->allowEmpty('id_cliente');

        $validator
            ->integer('id_produto')
            ->allowEmpty('id_produto');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('deleted_by')
            ->allowEmpty('deleted_by');

        return $validator;
    }
}
