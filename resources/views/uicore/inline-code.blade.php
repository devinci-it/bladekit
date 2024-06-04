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
            --code-font-family: 'Hubot Sans', sans-serif;
            --code-font-size: 1rem; /* Adjust as needed */
            --code-line-height: 1.6; /* Adjust as needed */
            --code-letter-spacing: normal; /* Adjust as needed */
            --code-font-weight: normal; /* Adjust as needed */
            --code-font-stretch: normal; /* Adjust as needed */
            --code-background-color: #f8f8f8; /* Light gray background */
            --code-color: #333; /* Dark gray text color */
        }

        code {
            font-family: var(--code-font-family);
            font-size: var(--code-font-size);
            line-height: var(--code-line-height);
            letter-spacing: var(--code-letter-spacing);
            font-weight: var(--code-font-weight);
            font-stretch: var(--code-font-stretch);
            /*background-color: var(--code-background-color);*/
            /*color: var(--code-color);*/
            padding: 0 0.5em; /* Adjust padding as needed */
            border-radius: 3px; /* Rounded corners */
            display: inline-block; /* Ensure proper spacing */
            white-space: pre-wrap; /* Preserve whitespace and allow wrapping */
            word-wrap: break-word; /* Break long words */
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

        .inline-code code {
            content: ' ';
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
