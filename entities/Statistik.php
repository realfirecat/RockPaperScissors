<?php
/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 04.03.2019
 * Time: 12:40
 */

/**
 * @Entity @Table(name="Statistik")
 **/
class Statistik {
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /**
     * @ManyToOne(targetEntity="Roletypes")
     * @JoinColumn(name="playerRoled", referencedColumnName="id")
     */
    protected $playerRoled;
    /**
     * @ManyToOne(targetEntity="Roletypes")
     * @JoinColumn(name="cpuRoled", referencedColumnName="id")
     */
    protected $cpuRoled;
    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $roledAt;

    public function getId()
    {
        return $this->id;
    }

    public function getPlayerRoled()
    {
        return $this->playerRoled;
    }

    public function setPlayerRoled($playerRoled)
    {
        $this->playerRoled = $playerRoled;
    }

    public function getCpuRoled()
    {
        return $this->cpuRoled;
    }

    public function setCpuRoled($cpuRoled)
    {
        $this->cpuRoled = $cpuRoled;
    }


}