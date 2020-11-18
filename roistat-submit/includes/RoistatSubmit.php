<?php

class RoistatSubmit {
    protected $loader;
    protected $pluginName;
    protected $version;

    public function __construct() {
        if (defined('ROISTAS_SUBMIT_VERSION')) {
            $this->version = ROISTAS_SUBMIT_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->pluginName = 'roistat-submit';

        $this->loadDependencies();
        $this->defineAdminHooks();
    }

    private function loadDependencies() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/RoistatSubmitLoader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/RoistatSubmitAdmin.php';

        $this->loader = new RoistatSubmitLoader();
    }

    private function defineAdminHooks() {
        $pluginAdmin = new RoistatSubmitAdmin($this->getPluginName(), $this->getVersion());

        $this->loader->addAction('wpcf7_mail_sent', $pluginAdmin, 'onRoistatSubmit');
    }

    public function run() {
        $this->loader->run();
    }

    public function getPluginName() {
        return $this->pluginName;
    }

    public function getLoader() {
        return $this->loader;
    }

    public function getVersion() {
        return $this->version;
    }
}