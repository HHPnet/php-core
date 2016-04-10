install: build_composer build_test composer_install

build_composer:
	docker build -t hhpnet/core_composer -f Dockerfile.composer .

build_test:
	docker build -t hhpnet/core_phpspec -f Dockerfile.phpspec .

composer_install:
	docker run --rm -v $(PWD):/app hhpnet/core_composer install

composer_update:
	docker run --rm -v $(PWD):/app hhpnet/core_composer update

test:
	docker run --rm -v $(PWD):/app hhpnet/core_phpspec run --format=pretty -vvv --ansi