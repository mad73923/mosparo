<?php

namespace Mosparo\Command;

use Mosparo\Helper\RulesetHelper;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'mosparo:rulesets:refresh')]
class RefreshRulesetsCommand extends Command
{
    protected RulesetHelper $rulesetHelper;

    public function __construct(RulesetHelper $rulesetHelper)
    {
        parent::__construct();

        $this->rulesetHelper = $rulesetHelper;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Refreshes all rulesets.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->rulesetHelper->downloadAll();

        return Command::SUCCESS;
    }
}