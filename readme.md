
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
## Clients
- Deleting a client it will set to null the client_id field on faxes previously owned by client