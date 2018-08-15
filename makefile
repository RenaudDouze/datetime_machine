
build: ## Build the lib
	composer install

test: ## Launch all tests
test: test_u5 test_u6

test_u6: ## Launch tests with phpunit 6
	docker run -v $(PWD):/app --rm phpunit/phpunit:6.5.3 tests/ --stderr

test_u5: ## Launch tests with phpunit 5
	docker run -v $(PWD):/app --rm phpunit/phpunit:5.7.12 tests/ --stderr

install: ## Install and start the project
install: build

# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help
