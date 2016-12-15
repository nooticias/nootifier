<?php

namespace Cekurte\Nootifier\Git;

use PHPGit\Command\StatusCommand as Command;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusCommand extends Command
{
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'ignored'         => false,
            'untracked-files' => 'all'
        ));
    }
}
