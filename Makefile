start:
	docker-compose up -d
produce:
	docker-compose exec php php /var/www/src/Example/Producer.php
consume:
	docker-compose exec php php /var/www/src/Example/Consumer.php -d
produceevents:
	docker-compose exec php php /var/www/src/Example/ProducerEvents.php