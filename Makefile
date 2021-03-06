build: ##@Intsall Dependencies
	composer install
up: ##@Run locally
	docker-compose up -d --build
down: ##@Stop containers
	docker-compose down
deploy: ##@Build and deploy to Cloud Run
	gcloud builds submit --tag gcr.io/wallet-254709/wallet-gateway-svc
	gcloud beta run deploy --image gcr.io/wallet-254709/wallet-gateway-svc --platform managed --allow-unauthenticated
