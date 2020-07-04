<?php

use ANovikov\SlackApi;

require_once __DIR__ . '/vendor/autoload.php';

const APP_TOKEN = 'xoxp-351119455507-350674564305-790768034849-8929c4960622272346b2f963667cd4f6';
const BOT_TOKEN = 'xoxb-351119455507-813400809446-IV1yvfAGZ65Dpc7hgEllhRT3';

$slackApi = new SlackApi(APP_TOKEN, BOT_TOKEN);
$slackApi->send();
