<?php

namespace Cz\UtilisateurBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CzUtilisateurBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
