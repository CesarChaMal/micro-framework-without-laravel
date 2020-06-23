#COPY .ENV.EXAMPLE TO .ENV
#.env DATABASE

`URL_SOAP=http://localhost:9000`  
`DB_CONNECTION=mysql`  
`DB_HOST=127.0.0.1`   
`DB_PORT=3306 `  
`DB_DATABASE= `  
`DB_USERNAME= `  
`DB_PASSWORD= `  

#.env EMAIL

`EMAIL_HOST=`  
`EMAIL_PORT=`  
`EMAIL_USERNAME=`   
`EMAIL_PASSWORD= `  
`EMAIL_FROM= `  
`EMAIL_NAME= `   

#MIGRATION
`
php migrations/db.php
`

#SERVER SOAP
`
php -S 0.0.0.0:9000 -t public/
`

#SERVER API && FRONT END
`php -S 0.0.0.0:8580 -t public/`

#URLS SOAP
- **SERVER** : http://localhost:9000/soap/
- **WSDL** : http://localhost:9000/soap/wsdl

#URLS API
- **1. CREATE CLIENT** : localhost:8580/api/client
- **2. RELOAD WALLET** : localhost:8580/api/client/reload-wallet
- **3. GENERATE PAYMENT** : localhost:8580/api/client/payment/generate
- **4. CONFIRMED PAYMENT** : localhost:8580/api/client/payment/confirmed
- **5. Get Total For Client** : localhost:8580/api/client/total

- #POSTMAN COLLECTION
https://www.getpostman.com/collections/a51b446201f470e654a9

#URLS FRONT END
- **PAY** : localhost:8580/api/frontend



