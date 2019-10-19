<?php


namespace App\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * Class Client
 * @package App\Entity
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
}
