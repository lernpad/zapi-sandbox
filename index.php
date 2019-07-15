<?php

require __DIR__.'/vendor/autoload.php';

use Lernpad\ZApi\ClientProtocol;
use Lernpad\ZApi\Model\StatusMsg;
use Lernpad\ZApi\Model\UserMsg;
use Lernpad\ZApi\Model\EventMsg;
use Lernpad\ZApi\Model\VersionMsg;
use Lernpad\ZApi\Exception\TimeoutException;

define(API_HOST, "localhost");
define(API_PORT, "8888");

$authUser = new UserMsg();
$authUser->setLogin(999);
$authUser->setPassword('MasterPassword');

// Client Api service
$cp = new ClientProtocol();
$cp->connect(API_HOST, API_PORT, $authUser);

$appId = 1;
try {
    $result = $cp->versionGet($appId);
    $code = $result['status']->getCode();
    $ver = $result['version'];
    echo "service status(".$code.",".StatusMsg::getName($code).")<br/>\n";
    /* @var $ver VersionMsg */
    echo "version " . $ver->getMajor() . '.' . $ver->getMinor() . '.' . $ver->getPatch() . " URL: " . $ver->getLink() . "<br/>\n";
} catch(Exception $e) {
    echo get_class($e);
}
