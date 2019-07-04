<?php

require __DIR__.'/vendor/autoload.php';

use Lernpad\ZApi\ClientProtocol;
use Lernpad\ZApi\Model\StatusMsg;
use Lernpad\ZApi\Model\UserMsg;
use Lernpad\ZApi\Model\EventMsg;
use Lernpad\ZApi\Model\VersionMsg;


$authUser = new UserMsg();
$authUser->setLogin(999);
$authUser->setPassword('MasterPassword');

// Client Api service
$cp = new ClientProtocol();
$cp->connect('98.158.104.229', 20004, $authUser);

$appId = 1;
$result = $cp->versionGet($appId);
$code = $result['status']->getCode();
$ver = $result['version'];
echo "service status(".$code.",".StatusMsg::getName($code).")<br/>\n";
/* @var $ver VersionMsg */
echo "version " . $ver->getMajor() . '.' . $ver->getMinor() . '.' . $ver->getPatch() . " URL: " . $ver->getLink() . "<br/>\n";
