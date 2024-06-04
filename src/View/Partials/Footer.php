<?php

    namespace Devinci\Bladekit\View\Partials;

    use Illuminate\View\Component;
    use Illuminate\Support\Facades\Config;

    class Footer extends Component
    {
        public $socialLinks;
        public $footerLinks;
        public $logo;

        public function __construct($socialLinks = [], $footerLinks = [], $logo = null)
        {
            $this->socialLinks = $socialLinks;
            $this->footerLinks = $footerLinks;
            $this->logo = $logo;
        }

        public function render()
        {
            return view('bladekit::partials.footer', [
                'socialLinks' => Config::get('bladekit.footer_social_links'),
                'footerLinks' => Config::get('bladekit.footer_links'),
                'logo' => Config::get('bladekit.footer_logo'),
            ]);
        }

    }
