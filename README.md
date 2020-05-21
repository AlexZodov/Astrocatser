# Astrocatser
Test Astrocaster API

# Initial instructions

* `docker-compose up -d`
* `docker exec workspace bash "/var/www/Astrocaster/init.sh"` - on each restart of container 'workspace'
* Write to local hosts file:
 - `127.0.0.1 astrocaster.test` 
 - `127.0.0.1 phpmyadmin.test` 
 - `127.0.0.1 rabbitmq`

# Access to resources
* PMA - http://phpmyadmin.test:8080
* Rabbit - http://rabbitmq:15672

# Usage
 
 ##Retrieving astrologists list:
  
  GET `/api/astrologist`
 
 ##Retrieving single astrologist data:
 
 GET `/api/astrologist/2`
  
 ##Creating order:
 
 POST `/api/order`, Payload: `{"name":"vasya pupkin123123",
                               	"email":"vasyapupkin1990@gmail.com",
                               	"astrologist_id":1,
                               	"service_id":1}`, 
                               	Content-type: `application/json`
                               	
 
 
 
 Querying filtering params(example):
 
 GET `/astrologist?order={"column":"first_name","dir":"desc"}&search={"first_name":"Aryanna"}&page=1&size=6`
  
 order param - define the column and direction, in form: `{"column":"name","dir":"desc"}`
  
 or
 
 `{"column":"name","dir":"DESC"}`
 
 search param - define column-value pair for each desired search, in form: 
 
 `{"first_name":"Aryanna","last_name":"Lilly"}`
 
 
 page & size params - define the desired page and page size for pagination logic, by default(if not provided in query) assumed page=1, size=10
 
#Postman collection
Postman collection can be found in `Astrocaster.postman_collection.json`
 