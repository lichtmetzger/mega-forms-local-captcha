plugin_name = mega-forms-local-captcha

help:
	@echo "Usage make <upload-to-dev|download-from-dev|pot>"

download-from-dev:
	rsync \
		-avz \
		--exclude .git \
		-e ssh gpmaster@gpmaster.qbus.dev:dev/public/wp-content/plugins/$(plugin_name)/ ./

upload-to-dev:
	rsync \
		-avz \
		--delete \
		--delete-excluded \
		--exclude .git \
		--exclude .github \
		--exclude .idea \
		--exclude='/node_modules/*' \
		--exclude='*.zip' \
		-e ssh ./ gpmaster@gpmaster.qbus.dev:dev/public/wp-content/plugins/$(plugin_name)/

pot:
	./vendor/bin/wp i18n make-pot \
		--domain=$(plugin_name) . languages/$(plugin_name).pot

release:
	rm -f $(plugin_name).zip; \
	zip \
		-r9 $(plugin_name).zip . \
		-x \
			*.git* \
			node_modules/\* \
			scss/\* \
			package*.json \
			composer.* \
			Makefile \
			Readme.md \
			.idea/\* \
			.nvmrc \
			.editorconfig \
			eslint.config.js \
			.stylelintrc.* \
			phpcs.xml \
			.pre-commit-config.yaml
