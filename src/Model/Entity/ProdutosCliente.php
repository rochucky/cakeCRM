<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProdutosCliente Entity
 *
 * @property int $id
 * @property int $id_cliente
 * @property int $id_produto
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $deleted_by
 */
class ProdutosCliente extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'id_cliente' => true,
        'id_produto' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'deleted' => true,
        'deleted_by' => true
    ];
}
