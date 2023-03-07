## CRM

```
cd /var/www/p518662/data/www/crm.nedicom.ru
/opt/alt/php81/usr/bin/php
mysqldump -up518662_crm -p p518662_crm > dump.sql

/opt/alt/php81/usr/bin/php artisan nutgram:hook:set https://crm.nedicom.ru/bots/staff
/opt/alt/php81/usr/bin/php artisan nutgram:hook:info
```
