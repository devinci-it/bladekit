@props(['size' => '', 'class' => ''])

@php
    $classes = 'inline-code ' . $class;

    // Handle size variations
    switch ($size) {
        case 'small':
            $classes .= ' inline-code-small';
            break;
        case 'large':
            $classes .= ' inline-code-large';
            break;
        default:
            // Default size
            $classes .= ' inline-code-medium';
    }
@endphp

@push('styles')
    <style>
        :root {
            --inline-code-bg: #f4f4f4; /* Light gray background */
            --inline-code-padding: 0.2em 0.4em; /* Adjust padding as needed */
            --inline-code-border-radius: 3px; /* Rounded corners */
            --inline-code-font: Hubot Sans, monospace; /* Use monospace font */
            --inline-code-font-size: 90%; /* Default font size */
            --inline-code-max-width: 100%; /* Max width to allow wrapping */
        }

        .inline-code {
            background-color: var(--inline-code-bg);
            padding: var(--inline-code-padding);
            border-radius: var(--inline-code-border-radius);
            font-family: var(--inline-code-font);
            font-size: var(--inline-code-font-size);
            max-width: var(--inline-code-max-width);
            word-break: break-word; /* Allow long words to wrap */
        }

        /* Define styling for small inline code */
        .inline-code-small {
            font-size: 80%; /* Adjust font size for small inline code */
        }

        /* Define styling for large inline code */
        .inline-code-large {
            font-size: 110%; /* Adjust font size for large inline code */
        }
    </style>
@endpush


@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.inline-code').forEach(function(code) {
                code.addEventListener('click', function() {
                    // Copy the text content of the inline code to the clipboard
                    const text = this.textContent;
                    if (!navigator.clipboard) {
                        navigator.clipboard = {
                            writeText: function(text) {
                                return new Promise(function(resolve, reject) {
                                    var textarea = document.createElement('textarea');
                                    textarea.value = text;
                                    document.body.appendChild(textarea);
                                    textarea.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(textarea);
                                    resolve();
                                });
                            }
                        };
                    }

                });
            });
        });
    </script>
@endpush

<span {{ $attributes->merge(['class' => $classes]) }}>
   &nbsp; {{ $slot }}
</span>
