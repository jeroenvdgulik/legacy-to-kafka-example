<?php

$producer = new RdKafka\Producer();
$producer->setLogLevel(LOG_DEBUG);
$producer->addBrokers("kafka");
$topic = $producer->newTopic("default_01");

$start = \microtime(true);

for ($i = 0; $i < 10000; $i++) {
	$message = "Message {$i}";
	echo $message . PHP_EOL;

	// partition to write to
	$topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
}

$duration = \microtime(true) - $start;

echo "Produced {$i} messages in {$duration} seconds" . PHP_EOL;
