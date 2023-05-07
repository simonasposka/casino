start:
	docker compose up -d
stop:
	docker compose down
seed:
	docker exec -it casino-laravel.test-1 php artisan migrate:fresh
	docker exec -it casino-laravel.test-1 php artisan db:seed
	docker exec -it casino-laravel.test-1 php artisan pending:events
