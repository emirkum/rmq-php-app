<?php
declare(strict_types=1);

namespace RMQPHP\App\Validators;


class Validate
{
    /**
     * Validate constructor.
     */
    public function __construct() {
        // code
    }

    /*
     * @param   mix     $input
     * @return  bool
     */
    public static function requestInput($input) : bool {
        return is_object($input) && isset($input->body) && isset($input->route);
    }
}