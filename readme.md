
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

## [CHANGE LOG]
### 10-03-2016
- Fax/ Recipients association
- In global Fax create form, If a recipient is entered a client id is required
- Fax creation tries to find the recipients in the list (seperated , or ;) 
-- It first tries to find an existing user with the email address and it find its it uses that User
-- If User is not found an account is automatically created.
- Fax creation with unique validation ignoring Soft Delete
- Display fax recipients in show Fax
X Edit fax recipients

### 10-02-2016
- Creating a Fax only selected Clients users are loaded
- Editing a Fax the preselected User is Selected and only Clients Users loaded.

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
## Setup/System
- Improve seeder to one simple task: Create 10 Company foreach create 10 Client for each create 10 User
- Secure API calls
## Fax
- Add error handling when creating/editing a fax if the added recipient is not a user
- When adding a fax recipient check if it entires are in a valid format and entires are valid emails
- Fully support Soft Delete in fax_recipients table
## User
- When a User account is created it should send an email with login/password information.