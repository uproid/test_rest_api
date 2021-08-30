Library Test API v0.0.2
6:12 PM 2021-07-12

Developer: Farhad Ziaee
Email: fardzia@gmail.com

Demo : https://testapi.uproid.com

The tools of used:

  Back-end:

    PHP 7.0
    MySQL
    Json
    Architecture: Multi-Level
    
  Front-end:
  
    Html
    Css (bootstrap v5.0)
    JQuery v3.6.0

Security: Sql injection
	

Database:
	
  Tables:
  
    Books (id*, isbn, title, category_id, description,author_id)
    Categories(id*, title, description)
    Authors(*id, author_name, description)

	Database name: library
	Database username: root
	Database Password: 
	Database IP: 127.0.0.1:3306
-------------------------------------------------
<b>API Document:</b>

    API Link: https://testapi.uproid.com/api/
    API Key:  APIKEY_HASH

<b>EndPoints: </b> 
** Endpoints key is: action

        NEW_BOOK			:		Making a record in books table
        DELETE_BOOK			:		Delete a record from books table
        GET_ALL_BOOKS		:		Send all records to client from books table
        GET_BOOK			:		Send only one record to client by ID from books table
        EDIT_BOOK			:		Edit a Recotd in books table by new informations
        NEW_CATEGORY		:		Make a record in categories table
        DELETE_CATEGORY		:		Delete a record from categories table
        GET_ALL_CATEGORIES	:		Send all records from categories table
        EDIT_CATEGORY		:		Edit a Recotd in categories table by new informations            
        NEW_AUTHOR			:		Make a record in author table
        DELETE_AUTHOR		:		Delete a record from author table
        GET_ALL_AUTHORS		:		Send all records from author table
        EDIT_AUTHOR			:		Edit a Recotd in author table by new informations  
        GET_CATEGORY		:		Send only one record to client by ID from categories table
        GET_AUTHOR          :		Send only one record to client by ID from author table

<b>Error Code Lists:</b>

        200	OK			The request was successfully completed.
        201	Created			A new resource was successfully created.
        400	Bad Request		The request was invalid.
        401	Unauthorized		The request did not include an authentication token or the authentication token was expired.
        403	Forbidden		The client did not have permission to access the requested resource.
        404	Not Found		The requested resource was not found.
        405	Method Not Allowed	The HTTP method in the request was not supported by the resource. For example, the DELETE method cannot be used with the Agent API.
        500	Internal Server Error	The request was not completed due to an internal error on the server side.
        503	Service Unavailable	The server was unavailable.

<b>The standard receive results from Server:</b>
    <b>Getting a book by number id=30 from API:</b>

    Link: https://testapi.uproid.com/api/index.php?apikey=APIKEY_HASH&action=GET_BOOK&id=30
    {
        "version": "0.0.1",
        "method": "GET",
        "code": 200,
        "message": "The result is Okey...",
        "timestamp": 1626262783,
        "data": {
            "id": 30,
            "title": "Naar Nederland",
            "isbn": "9789058759108",
            "description": "voorbereiding op het .........",
            "author": {
                "author_name": "Astrid Koppers",
                "description": "Illustrated by\tAstrid Koppers\r\n.......",
                "id": "9"
            },
            "category": {
                "title": "Taal",
                "description": "Taal te leren",
                "id": "12"
            }
        }
    }  

<b>**Note:</b> You can send your request to the server via POST or GET method. To use POST method, send this array as follows:

    array(
        "apikey"=>"APIKEY_HASH",
        "action"=>"GET_BOOK",
        "id"=>30
    )

    

	
