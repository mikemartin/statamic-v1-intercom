<?php
require "vendor/autoload.php";
use Intercom\IntercomClient;

class Hooks_intercom extends Hooks {

  public function raven__on_success($data) {
    $appId = $this->fetchConfig('app_id');
    $apiKey = $this->fetchConfig('api_key');
    $intercom = new IntercomClient($appId, $apiKey);

    // Get formset list from config
    $allowedFormsets = $this->fetchConfig('formsets');

    // Get form submission data
    $submission = $data['submission'];
    $config = $data['config'];
    $formset = $config["formset"];

    if (in_array($formset, $allowedFormsets)) {
      // Create intercom lead
      $intercom->leads->create($submission);
    }
  }
}
