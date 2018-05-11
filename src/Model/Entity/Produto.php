<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property string $nome
 * @property float $preco
 * @property string $descricao
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 */
class Produto extends Entity
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
        'nome' => true,
        'preco' => true,
        'descricao' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true
    ];
}
