<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('KaidoSetting.site_name', 'Spatie');
        $this->migrator->add('KaidoSetting.site_active', true);
        $this->migrator->add('KaidoSetting.registration_enabled', true);
        $this->migrator->add('KaidoSetting.login_enabled', true);
        $this->migrator->add('KaidoSetting.password_reset_enabled', true);
        $this->migrator->add('KaidoSetting.sso_enabled', true);

    }

    public function down(): void
    {
        $this->migrator->delete('KaidoSetting.site_name');
        $this->migrator->delete('KaidoSetting.site_active');
        $this->migrator->delete('KaidoSetting.registration_enabled');
        $this->migrator->delete('KaidoSetting.login_enabled');
        $this->migrator->delete('KaidoSetting.password_reset_enabled');
        $this->migrator->delete('KaidoSetting.sso_enabled');
    }
};
