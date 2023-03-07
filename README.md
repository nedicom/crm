## CRM

```
cd /var/www/p518662/data/www/crm.nedicom.ru
/opt/alt/php81/usr/bin/php
mysqldump -up518662_crm -p p518662_crm > dump.sql

php artisan nutgram:hook:set https://crm.nedicom.ru/bots/staff
php artisan nutgram:hook:info
```
