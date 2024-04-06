# RBAC-PHP

RBAC-PHP is an implementation of Role-Based Access Control (RBAC) system in PHP. 

## Installation

To use RBAC-PHP, follow these steps:

1. Install dependencies using Composer:


## Usage

Example usage of RBAC-PHP:

```php
// Creating an instance of RBAC
$rbac = new RBAC();

// Creating roles and permissions
$rbac->createRole('admin');
$rbac->createPermission('editPost');

// Assigning permission to role
$rbac->assignPermissionToRole('editPost', 'admin');

// Adding a user to role
$rbac->addUserToRole('John', 'admin');

// Checking permission for user
if ($rbac->userHasPermission('John', 'editPost')) {
 echo 'User has permission to edit posts';
} else {
 echo 'User does not have permission to edit posts';
}
```

## License

RBAC-PHP is licensed under the MIT License.