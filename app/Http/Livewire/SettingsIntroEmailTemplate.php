<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class SettingsIntroEmailTemplate extends Component
{
    public $email_template_intro;
    public $setting_intro;

    public function getSettings()
    {
        $this->setting_intro = Setting::query()->where('id', 1)->first();
    }

    public function populateInput()
    {
        if($this->setting_intro->intro_email_template) {
            $this->email_template_intro = $this->setting_intro->intro_email_template;
        }
    }

    public function IntroEmailTemplate()
    {
        $this->setting_intro->intro_email_template = $this->email_template_intro;
        $this->setting_intro->save();
    }

    public function render()
    {
        $this->getSettings();
        $this->populateInput();
        return view('livewire.settings-intro-email-template');
    }
}
