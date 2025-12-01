<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class GravatarExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function action($value)
    {
        // https://docs.gravatar.com/api/avatars/hash/
        return hash( 'sha256', strtolower( trim( $value ) ) );
    }
}
