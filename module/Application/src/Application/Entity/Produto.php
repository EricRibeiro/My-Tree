<?php
/**
 * Created by PhpStorm.
 * User: ericribeiro
 * Date: 3/5/18
 * Time: 2:01 PM
 */

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Produto
{
    /** @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")*/
    private $id;

    /**
     * @ORM\Column(type="string")*/
    private $nome;

    /**
     * @ORM\Column(type="string")*/
    private $email;

    /**
     * @ORM\Column(type="string")*/
    private $senha;

    /**
     * @ORM\Column(type="string")*/
    private $celular;

}