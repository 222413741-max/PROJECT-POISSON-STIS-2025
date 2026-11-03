<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $language = 'en';
    public $dropdownVisible = false;

    public function mount()
    {
        $this->language = $_COOKIE['lang'] ?? 'en';
        App::setLocale($this->language);
    }

    public function setLanguage($language)
    {
        $prevLanguage = $_COOKIE['lang'] ?? 'en';

        $this->language = $language;
        App::setLocale($language);
        setcookie('lang', $language, time() + (60 * 60 * 24 * 30), '/');
        $this->dropdownVisible = false;

        if ($prevLanguage == $language) {
            return;
        }
        return redirect()->to(url()->previous());
    }

    public function toggleDropdown()
    {
        $this->dropdownVisible = !$this->dropdownVisible;
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
