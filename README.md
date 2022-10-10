Remote:
1. Create account: infinityfree.net (email confirmation required)
2. Create new Account
3. Choose domain 
4. Confirm Captcha and click Create Account
5. Click Finish
6. Reveal and copy PASSWORD
5. Open Control Panel
6. Open MySQL Databases
7. Add name testapp and click Create Database
8. Go back to Control Panel (menu on upper left)
9. Click Online File Manager
10. Go to htdocs
11. Upload 


Local:
1. Install xampp
  default it will be installed in C:\xampp\
  Run xampp
  Start Apache 
  Start MySQL

2. Enable DB features
open xampp/php/php.ini 
uncomment:
;extension=php_intl.dll
;extension=php_gd.dll

3. Download app:
https://github.com/orangehrm/orangehrm/releases/tag/v5.1
unpack folder what is inside zip (orangehrm-5.1) to:
C:\xampp\htdocs

4. Create DB:
In xampp click Admin for MySQL
In phpmyadmin go to User accounts tab
In New section click  Add user account
- Username: testerapp, 
- Password (click Generate and safetly save it) i.e. AWKpmgSb*sMDeMJ)
In section Database for user account check
 Create database with same name and grant all privileges.
 Grant all privileges on wildcard name (username\_%).
Scroll down and click Go
Verify user in User accounts tab

5. Setup APP
Go to: http://localhost/orangehrm-5.1/
Welcome: 
- Next
License Acceptance 
- Check: I accept the terms in the Licence Agreement
- Next
Database Configuration
- Existing Empty Database
-Database Host Name: 127.0.0.1
-Database Name: testerapp
-OrangeHRM Database Username: testerapp
-OrangeHRM Database User Password: (password from step 4. Create DB i.e. PepNntOp3vNgjaDj)
-Next
System Check
-Next
Instance Creation
- Organization Name TesterApp
- Country Poland
- Language English
- Tomezone Europe/Amsterdam
-Next
Admin User Creation
- Jan Kowalski
- emali (any)
- Admin Username: superuser
- Password: Safe password like: aA1!2345
-Next
Confirmation
-Install
Installation
-Wait and then Next
Installation Complete
Launch OrangeHRM
- Login with 




DEVELOPMENT
1. Xdebug:
Go to https://xdebug.org/wizard
Start Xampp Apache
Go to localhost click PHP info, copy all site content (ctl+a, ctrl+c)
Paste it to xdebug site 
Cick Analyse my phpinfo()
Download file i.e: php_xdebug-3.1.5-8.1-vs16-x86_64.dll
Move the downloaded file to C:\xampp\php\ext, and rename it to php_xdebug.dll
Update C:\xampp\php\php.ini to have the line: zend_extension = xdebug

Restart the Apache Webserver

Open APP
and install the Xdebug Helper browser extension.
https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc

HELP:
https://tommcfarlin.com/xdebug-in-visual-studio-code/
https://www.youtube.com/watch?v=uEDkph4OCDg

ALTERNATIVE PHP INFO: if above not work - 
go to folder of debugged app, 
open index.php, 
replace content with <?php echo phpinfo(); ?>
open site and copy content

2. VSC
- plugin: 
PHP Debug
- settings
Ctrl+Shift+P) PREFERENCE Open user Settings (JSON)
add:
    "php.debug.executablePath": "C:\\xampp\\php\\php.exe",
    "php.validate.executablePath": "C:\\xampp\\php\\php.exe"
-run debug
Go to debug
Click Run and Debug
click link create a launch json file 
choose PHP
New configuration in Debug available Listen for Xdebug
Add brakpoint in C:\xampp\htdocs\orangehrm-5.1\src\plugins\orangehrmCorePlugin\Controller\Rest\V2\AbstractRestController.php
 $request = new Request($httpRequest);
In Chrome in app login and navigate to Admin tab
!!!Should work


APP DEVELOPMENT:
If freash - chcek gitignore form our fork repo in
C:\xampp\htdocs\orangehrm-5.1\src\client\.gitignore
C:\xampp\htdocs\orangehrm-5.1\.gitignore
C:\xampp\htdocs\orangehrm-5.1\installer\client

Check you can debug (DEVELOPMENT completed)
install yarn
https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable

Do changes in C:\xampp\htdocs\orangehrm-5.1\src\client
i.e. C:\xampp\htdocs\orangehrm-5.1\src\client\src\core\util\services\api.service.ts
Open C:\xampp\htdocs\orangehrm-5.1\src\client in terminal
yarn install
then
yarn build