<?php

$producer = new RdKafka\Producer();
$producer->setLogLevel(LOG_DEBUG);
$producer->addBrokers("kafka");
$topic = $producer->newTopic("default_01");

$start = \microtime(true);

$events = [
	'CustomerRegistered',
	'CustomerEmailVerifactionSent',
	'CustomerVerifiedEmail',
	'CustomerChangedAvatar',
	'CustomerSubscribedToTrial'
];

$i=0;

foreach ($events as $event) {
	echo $event . PHP_EOL;
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $event);
    ++$i;
}

$duration = \microtime(true) - $start;

echo "Produced {$i} messages in {$duration} seconds" . PHP_EOL;
