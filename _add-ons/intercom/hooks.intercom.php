<?php
require "vendor/autoload.php";
use Intercom\IntercomClient;

class Hooks_intercom extends Hooks {

  public function raven__on_success($data) {
    $accessToken = $this->fetchConfig('access_token');
    $intercom = new IntercomClient($accessToken, null);

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
