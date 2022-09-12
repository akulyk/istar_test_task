### Test task for Web developer:

Create a phone book with next operations:
- Contact list view, with search by name, surname or phone number
- Add contact
- Edit contact (change of existing data, and also add new numbers and delete old ones)
- View of selected contact
- Delete contact

Each contact should has:
- Name (required)
- Surname
- Email, shuould be validate
- Birthdate with Datepicker (user should be at least 18 years old)
- Phone number, amount of number could be from 1 till N (at least 1 number is required),
  phone number should be validated,
  allowed formats are: +380123456789, 0123456789.

As result link to Github with complete task should be provided.
Should be done within 1 - 1.5 days


### Additional information:
 - all operations are done without prior authorization;
 - all inscriptions and values in English;
 - minimal layout (bootstrap);  
 - phone uniqueness check is not performed;
 - the list is not sorted by phone number;  
 - phone number is converted to the form 3801112223344; 
 - the task does not specify whether these users are from one country or may be from different countries,
so we assume that all phone numbers are from one country (Ukraine);

Translated with www.DeepL.com/Translator (free version)

#### System requirments
php 7.4

mysql 5.6 and higher. 

When using 5.7 and higher pehaps you can get error: 
`Mysql Not in Group By...`
   
#### How to use
1. Execute command `git clone https://github.com/akulyk/istar_test_task.git`.
2. Provide own database settings (`/config/db.php`) (in separate file e.g. `db-local.php` did not move,
   default root:root, db=istar)
3. Execute command `composer install`.
4. Execute command `php yii migrate`.
5. Execute command `php yii fixture/load "*"` (optional).
6. Set server root folder to `/web`
