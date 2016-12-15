<?php

namespace Cekurte\Nootifier\Command;

use Cekurte\Nootifier\Git\Git;
use Cekurte\Nootifier\Git\StatusCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NootifierCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('nootifier')
            ->setDescription('Add, commit and push files from a local to remote repository.')
            ->addOption(
                'directory',
                'd',
                InputOption::VALUE_REQUIRED,
                'Directory that contains your git repository.',
                ROOT_PATH
            )
            ->addOption(
                'limit',
                'l',
                InputOption::VALUE_REQUIRED,
                'Amount of files that will be considered.',
                100
            )
        ;
    }

    protected function getChanges(array $status)
    {
        $posts = [];

        if (isset($status['changes'])) {
            shuffle($status['changes']);
        }

        return $status['changes'];
    }

    protected function getIgnoredStatuses()
    {
        return [
            StatusCommand::UNMODIFIED,
            StatusCommand::IGNORED,
        ];
    }

    protected function getFiles($changes, $limit)
    {
        $files = [];

        foreach ($changes as $change) {
            if (!in_array($change['index'], $this->getIgnoredStatuses()) || !in_array($change['work_tree'], $this->getIgnoredStatuses())) {
                $files[] = $change['file'];

                if (count($files) >= $limit) {
                    break;
                }
            }
        }

        return $files;
    }

    /*
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repo  = $input->getOption('directory');
        $limit = (int) $input->getOption('limit');

        $git = new Git();
        $git->setRepository($repo);

        $changes = $this->getChanges($git->status());

        $files = $this->getFiles($changes, $limit);

        if (count($files) >= $limit) {
            foreach ($files as $file) {
                echo $file . PHP_EOL;

                $git->add($file);
            }

            $git->commit(sprintf('Added %d files.', $limit));
            $git->push('origin', 'develop');
        }
    }
}
