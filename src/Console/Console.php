<?php
// app/Services/ConsoleMessage.php

namespace Devinci\Bladekit\Console;

use Symfony\Component\Console\Output\ConsoleOutput;

class Console
{
    protected $output;

    public function __construct($output=null)
    {
        $this->output = $output ? $output : new ConsoleOutput();
    }

    public function displayMessage(string $message, string $messageType = 'default', bool $highlight = false)
    {
        switch ($messageType) {
            case 'info':
                $icon = 'ℹ️';
                $style = 'info';
                $color = 'cyan';
                break;
            case 'warning':
                $icon = '⚠️';
                $style = 'comment';
                $color = 'yellow';
                break;
            case 'error':
                $icon = '❌';
                $style = 'error';
                $color = 'red';
                break;
            case 'alert':
                $icon = '🚨';
                $style = 'error';
                $color = 'magenta';
                break;
            case 'prompt':
                $icon = '➡️';
                $style = 'info';
                $color = 'green';
                $message .= ':';
                break;
            case 'success':
                $icon= '✅';
                $style = 'success';
                $color = 'bright-green';
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
        $border = str_repeat('-', 0); // Adjust the number as needed

        // Format the body to be bold and padded to a minimum width of 120 characters
        $body = sprintf('<options=bold;fg=bright-white>%s</>', str_pad($body, 120, " ", STR_PAD_RIGHT
        ));

        // Display the border
        $this->output->writeln($border);

        // Display the header if it's provided
        if ($header !== null) {
            $this->output->writeln(' ' . $header);
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
        $this->output->writeln(sprintf('<bg=blue;fg=bright-yellow> %s </>', $message));
    }

    public function displaySubHeader(string $message)
    {
        $this->displayMessageWithBorder(sprintf('<bg=blue;fg=bright-white> %s </>', $message));
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
