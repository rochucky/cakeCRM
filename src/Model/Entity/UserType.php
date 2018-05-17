<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserType Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $deleted_by
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\User $created_by_data
 * @property \App\Model\Entity\User $modified_by_data
 */
class UserType extends Entity
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
        'name' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'deleted' => true,
        'deleted_by' => true,
        'users' => true,
        'created_by_data' => true,
        'modified_by_data' => true
    ];
}
