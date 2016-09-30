
# FAXIT
- Administrative Dashboard to CRUD Companies, Clients, Fax DID, and Users
- Interact with third party vendor API to send and recieve Fax2Email

## TODO
- Update readme with technologies and techniques utilized to accomplish certain tasks 


## RELEASES
### 2.0
- Single table inheritance design will deprecate tables Company, Provider, Clients.
- Single table entities will define by a type field and will have many users and many self relationship
- Types table
- Users will belong to entities


# NOTES
## Company
- After a company entity is created the model creates the company admin user account if a contact email has been set
- Deleting a company cascades and deletes the company clients and associates users

## Clients
- After a client entity is created the model creates the clients admin user account if a contact email has been set
- Deleting a client it will set to null the client_id field on faxes previously owned by client

