help:
	@echo "Usage make <upload-to-dev|download-from-dev|pot>"

download-from-dev:
	rsync -avz --exclude .git -e ssh gpmaster@gpmaster.qbus.dev:dev/public/wp-content/plugins/mega-forms-local-captcha/ ./

upload-to-dev:
	rsync -avz --delete --delete-excluded --exclude .git --exclude .vscode --exclude='/node_modules/*' -e ssh ./ gpmaster@gpmaster.qbus.dev:dev/public/wp-content/plugins/mega-forms-local-captcha/

pot:
	./vendor/bin/wp i18n make-pot --domain=mega-forms-local-captcha . languages/mega-forms-local-captcha.pot

release:
	zip -r9 mega-forms-local-captcha.zip . -x *.git* node_modules/\* *.vscode* scss/\* package*.json composer.* Makefile Readme.md .nvmrc .npmrc phpcs.xml