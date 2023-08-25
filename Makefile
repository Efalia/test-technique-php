install:
	composer install

test:
	vendor/bin/psalm --no-cache
	vendor/bin/phpunit

PHPUNIT_REPORT_PATH = /tmp/phpunit_coverage_report
coverage:
	XDEBUG_MODE=coverage vendor/bin/phpunit \
		--coverage-clover cov.xml \
		--coverage-filter src \
		--coverage-html $(PHPUNIT_REPORT_PATH)
	xdg-open $(PHPUNIT_REPORT_PATH)/index.html