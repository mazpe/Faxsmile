
# FAXIT
- Administrative Dashboard to CRUD Companies, Clients, Fax DID, and Users
- Interact with third party vendor API to send and recieve Fax2Email

## [SERVICE]
Fax can be added only requiring a provider
Fax can be associated with a Client with
Fax can be associated with a Client's User
Fax can be sent by many User
Fax can be received by many User
User can only through one Fax

## [CHANGE LOG]
### 10-07-2016
- Authorization
#### Company Permissions
- Only 'Super Admin' can 'store' a Company
- Only 'Super Admin' can 'create' a Company
- Only 'Company Admin' that belongs to the Entity can 'update' a Company
- Only 'Company Admin' that belongs to the Entity can 'edit' a Company
- Only 'Company Admin' that belongs to the Entity can 'view' a Company 
- Only 'Super Admin' can 'delete' a Company
- Only 'Super Admin' can 'index' Companies
#### Provider Permissions
- Only 'Super Admin' can 'store' a Provider
- Only 'Super Admin' can 'create' a Provider
- Only 'Provider Admin' that belongs to the Entity can 'update' a Provider
- Only 'Provider Admin' that belongs to the Entity can 'edit' a Provider
- Only 'Provider Admin' that belongs to the Entity can 'view' a Provider 
- Only 'Super Admin' can 'delete' a Provider
- Only 'Super Admin' can 'index' Providers

#### Super Admin
- 'Super Admin' can do anything

### 10-04-2016
- Users CRUD updated to match new relationship and Reciepients list
- Display users fax number as recipient and sender
- More dynamic flexibility to forms creator
- Create user only displays Faxes that have been assiged to the client
- When creating a user selecting a fax_id sets him as a sender for that fax.
- Faxes creating with sender list
- Fax create, display and edit senders/recipients
- Fax delete

### 10-03-2016
- Fax/ Recipients association
- In global Fax create form, If a recipient is entered a client id is required
- Fax creation tries to find the recipients in the list (seperated , or ;) 
- It first tries to find an existing user with the email address and it find its it uses that User
- If User is not found an account is automatically created.
- Fax creation with unique validation ignoring Soft Delete
- Display fax recipients in show Fax
- Edit fax recipients

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
- Creating should touch mutators and use setPasswordAttribute mutator instead of having to specify it