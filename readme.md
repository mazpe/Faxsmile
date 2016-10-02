
# FAXIT
- Administrative Dashboard to CRUD Companies, Clients, Fax DID, and Users
- Interact with third party vendor API to send and recieve Fax2Email

## [SERVICE]
Fax can be added only requiring a provider
Fax can be associated with a Client with
Fax can be associated with a Client's User
Fax can be sent only by associated User
Fax can be received by many User
User has a dedicated Fax


fax_recipients
fax_senders

## [CHANGE LOG]
### 10-01-2016
- Added API calls

### 09-29-2016
- Entity single table inheritance design deprecated tables Company, Provider, Clients.
- Type field in entity table defines the type 
- Models extended from App\Entity were created for each Type (App\Company, App\Client, etc)
- Using SingleTableInheritanceTrait to handle all STI related business
- Moved create admin user account for client on Client creation to model as Listener
- Created Listener for Company and Provider to create their admin account.
- 'Has Many Through' relationship between Client and Fax
- Optimized ELoquent query with 'Eager Loading' to avoid N + 1 issue
 
# [NOTES]
## Company
- After a company entity is created the model creates the company admin user account if a contact email has been set
- Deleting a company cascades and deletes the company clients and associates users

## Clients
- After a client entity is created the model creates the clients admin user account if a contact email has been set
- Deleting a client it will set to null the client_id field on faxes previously owned by client

# [TODO]
- Improve seeder to one simple task: Create 10 Company foreach create 10 Client for each create 10 User
- Secure API calls