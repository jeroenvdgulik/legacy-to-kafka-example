<?php

$consumer = new RdKafka\Consumer();
$consumer->setLogLevel(LOG_DEBUG);
$consumer->addBrokers("kafka");

$topic = $consumer->newTopic("default_01");

// RD_KAFKA_OFFSET_BEGINNING, RD_KAFKA_OFFSET_END, RD_KAFKA_OFFSET_STORED.
$topic->consumeStart(0, RD_KAFKA_OFFSET_END);

while (true) {
  $msg = $topic->consume(0, 1000);
  if ($msg->err && $msg->payload !== "") {
    echo $msg->errstr(), "\n";
    break;
  }

  if ($msg !== null && $msg->payload !== "") {
    echo $msg->payload, "\n";
  }

}
