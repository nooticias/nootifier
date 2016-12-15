<?php

namespace Cekurte\Nootifier\Git;

use PHPGit\Git as Base;

class Git extends Base
{
    /** @var string  */
    private $bin = 'git';

    /** @var string  */
    private $directory = '.';

    public function __construct()
    {
        parent::__construct();

        $this->status = new \Cekurte\Nootifier\Git\StatusCommand($this);
    }
}
