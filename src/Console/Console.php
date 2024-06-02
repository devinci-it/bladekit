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
                $icon= '🚀';
                $style = 'default';
                $color = 'white';
                break;
        }

        $formattedMessage = sprintf('<fg=%s> %s %s</>' , $color,$icon, $message);
        if ($highlight) {
            $formattedMessage = sprintf('<options=bold>%s</>', $formattedMessage);
        }

        $this->displayMessageWithBorder($formattedMessage);


    }
    public function displayMessageWithBorder(string $body, string $header = null, string $subHeader = null)
    {
        $border = str_repeat('-', 120); // Adjust the number as needed

        // Display the border
        $this->output->writeln($border);

        // Display the header if it's provided
        if ($header !== null) {
            $this->output->writeln('* ' . $header);
            $this->output->writeln($border);
        }

        // Display the body
        $this->output->writeln('* ' . $body);

        // Display the sub-header if it's provided
        if ($subHeader !== null) {
            $this->output->writeln($border);
            $this->output->writeln('* ' . $subHeader);
        }

        // Display the border
        $this->output->writeln($border);
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
        $paddedMessage = str_pad($message, 200, "     ", STR_PAD_BOTH);

        $this->output->writeln(sprintf('<fg=blue>%s</>', str_repeat($character, 120-strlen($message)  )));
        $this->output->writeln(sprintf('<fg=bright-blue>%s %s %s</>', $character, $paddedMessage, $character));
        $this->output->writeln(sprintf('<fg=blue>%s</>', str_repeat($character, 120-strlen($message))));
    }



    public function displayEmptyLine(int $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->output->writeln('');
        }
    }
}
