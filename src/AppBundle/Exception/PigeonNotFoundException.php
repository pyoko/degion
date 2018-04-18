<?php

namespace AppBundle\Exception;

use AppBundle\Exception\NotFoundInterface;

class PigeonNotFoundException extends \Exception implements NotFoundInterface
{
}