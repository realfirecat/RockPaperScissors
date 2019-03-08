<?php
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
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $description;
}