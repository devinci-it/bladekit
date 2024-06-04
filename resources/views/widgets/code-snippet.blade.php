@props(['code' => [], 'theme', 'commentChar'=>$commentChar, 'isNumbered'=>$isNumbered])

        @php
        $isNumbered ?? $lineNumbers = implode("\n", range(1, count($code))) ;
        $lineNumbers = '';
        $commentChar = $commentChar ?? '#';
        $debug_result =[]



//            $lineNumbers = implode("\n", range(1, count($code)));
        @endphp

<div class="code-snippet {{ $theme }}">
    @isset($header)
        <div class="header">
            {{ $header }}
        </div>
    @endisset



        <div class="code-content" @if($lineNumbers != '') data-line-numbers="{{ htmlspecialchars($lineNumbers) }}" @endif>

        @foreach ($code as  $line)
            @php
                // Determine if the line starts with a shebang or the specified comment character
                $isShebang = str_starts_with(ltrim($line), '#!');
                $isComment = str_starts_with(ltrim($line), $commentChar);

                // Determine if the line should have a lighter color
                $lighterLine = $isShebang || $isComment;

            @endphp

                <pre class="code-content line-numbers language-php" @if($isNumbered) data-line-numbers="{{ htmlspecialchars($lineNumbers) }}" @endif>
             <code  class="inline-code code-line {{ $lighterLine ? ' light-text comment' : '' }}" >  {{ htmlspecialchars($line) }}</code>
            </pre>
        @endforeach


    </div>


        @isset($footer)
            <div class="footer">
{{$footer}}
            </div>
        @endisset
    <button onclick="copyToClipboard(`{{ implode(PHP_EOL, $code) }}`)" class="caption-text round">
        <svg fill="var(--text-color)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path>
            <path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path>
        </svg>
        <span class="copy-text light caption-text">COPY</span>
    </button>


</div>


@push('styles')
    <style>
        /* Customizable colors */

        :root {
            --main-bg-color-light: #f8f9fa; /* Light theme background color */
            --main-bg-color-dark: #2d2d2d; /* Dark theme background color */
            --accent-color: #007bff; /* Accent color */
            --button-bg-color: rgba(200, 221, 245, 0.57); /* Button background color */
            --border-color: #6c757d; /* Border color */
            --text-color: #20242e;/* Text color */
        }

        /* Common styles for light and dark themes */
        .code-snippet {
            position: relative;
            padding: 1em;
            border-radius: 10px;
            overflow: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .code-snippet button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0.5em;
            color: var(--text-color);
            background: var(--button-bg-color);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, box-shadow 0.3s, width 0.3s, padding 0.3s;
            display: flex;
            align-items: center;
        }

        .code-snippet button .copy-text {
            overflow: hidden;
            white-space: nowrap;
            color: var(--text-color);
            max-width: 0;
            padding-left: 2px;
            font-weight: 500;
            transition: max-width 0.3s;
        }

        .code-snippet button:hover .copy-text {
            max-width: 100px; /* Adjust as necessary */
        }

        .code-snippet button:hover {
            /*background: linear-gradient(145deg, #0056b3, #003d80);*/
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding-right: 1em;
        }

        .code-snippet pre {
            margin: 0;
            display: flex;
            line-height: 1.5;
            position: relative;
            padding-left: 1em;
        }

        .code-snippet pre code {
            display: block;
        }

        .code-snippet pre::before {
            content: attr(data-line-number);
            position: absolute;
            left: 0;
            top: 0;
            padding-right: 10px;
            font-weight: 500;
            text-align: right;
            user-select: none;
            white-space: pre;
            color: rgb(208, 215, 222);
        }

        /* Light theme specific styles */
        .code-snippet.light {
            background-color: var(--main-bg-color-light) !important;
            color: var(--text-color);
        }

        /* Dark theme specific styles */
        .code-snippet.dark {
            background-color: var(--main-bg-color-dark) !important;
        }
        .dark code.code-line{
            color: #f8f8f2; /* Adjust text color for dark theme */

        }

        .code-snippet .header, .code-snippet .footer {
            color: rgb(141, 150, 160);
            font-family: var(--code-font-family);
            letter-spacing: 1px;
            line-height: .5;
            letter-spacing: normal;
            padding-top: 23px;
            border-top: solid 1px var(--border-color);
        }
        .light-text{
            color: var(--border-color)!important;
        }

        .comment{
            color: rgba(200, 221, 245, 0.54);
        }


    </style>
@endpush

