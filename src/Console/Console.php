<?php
// app/Services/ConsoleMessage.php

namespace Devinci\Bladekit\Console;

use Symfony\Component\Console\Output\ConsoleOutput;

class Console
{
    protected $output;

    public function __construct(ConsoleOutput $output)
    {
        $this->output = $output;
    }

    public function displayMessage(string $message, string $messageType = 'default', bool $highlight = false)
    {
        switch ($messageType) {
            case 'info':
                $symbol = 'ℹ️';
                $style = 'info';
                $color = 'cyan';
                break;
            case 'warning':
                $symbol = '⚠️';
                $style = 'comment';
                $color = 'yellow';
                break;
            case 'error':
                $symbol = '❌';
                $style = 'error';
                $color = 'red';
                break;
            case 'alert':
                $symbol = '🚨';
                $style = 'error';
                $color = 'magenta';
                break;
            case 'prompt':
                $symbol = '➡️';
                $style = 'info';
                $color = 'green';
                $message .= ':';
                break;
            default:
                $symbol = '﹅';
                $style = 'default';
                $color = 'white';
                break;
        }

        $formattedMessage = sprintf('<fg=%s>%s %s</>', $color, $symbol, $message);
        if ($highlight) {
            $formattedMessage = sprintf('<options=bold>%s</>', $formattedMessage);
        }

        $this->output->writeln($formattedMessage);
    }

    public function displayHeader(string $message)
    {
        $this->output->writeln(sprintf('<bg=blue;fg=white> %s </>', $message));
    }

    public function displaySubHeader(string $message)
    {
        $this->output->writeln(sprintf('<bg=blue;fg=white> %s </>', $message));
    }

    public function displayBanner(string $message, string $character = '*')
    {
        $this->output->writeln(sprintf('<bg=blue;fg=white> %s </>', str_repeat($character, strlen($message) + 4)));
        $this->output->writeln(sprintf('<bg=blue;fg=white> %s %s %s </>', $character, $message, $character));
        $this->output->writeln(sprintf('<bg=blue;fg=white> %s </>', str_repeat($character, strlen($message) + 4)));
    }

    public function displayBorder(string $message, string $character = '-')
    {
        $this->output->writeln(sprintf('<fg=blue>%s</>', str_repeat($character, strlen($message) + 4)));
        $this->output->writeln(sprintf('<fg=blue>%s %s %s</>', $character, $message, $character));
        $this->output->writeln(sprintf('<fg=blue>%s</>', str_repeat($character, strlen($message) + 4)));
    }

    public function displayEmptyLine(int $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->output->writeln('');
        }
    }
}
