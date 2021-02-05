<?php

namespace App\Entity;

class Contact{

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Lenght(min=2, max =100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Lenght(min=2, max =100)
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(pattern='/[0-9]{10}/')
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Asert\Lenght(min=10)
     */
    private $message;

}