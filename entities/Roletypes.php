<?php
namespace htl3r\rps\entities;

/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 08.03.2019
 * Time: 21:35
 */

/**
 * @Entity @Table(name="Roletypes")
 **/
class Roletypes {
    /** @Id @Column(type="integer") @GeneratedValue
     * @OneToMany(targetEntity="Statistik", mappedBy="id")
     */
    protected $id;
    /** @Column(type="string") **/
    protected $description;

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}