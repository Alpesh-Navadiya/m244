php bin/magento s:up
php bin/magento setup:di:compile
php bin/magento s:s:d -f
chmod -R 777 var/ pub/media/ pub/static/ generated/
