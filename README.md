# Tester App
Upskill testing skills in enterprise app with free deploy
### Example APP
- http://testerapp.epizy.com
- for credentials contact jaktestowac.pl

### API: 
- https://orangehrm.github.io/orangehrm-api-doc/#api-Employee-UpdateEmployeeDetails

# Table of Contents
1. [Web installation](#webinstallation)
2. [Setup APP](#setup-app)
3. [Local instalation](#local-instalation)
4. [Development](#fourth-examplehttpwwwfourthexamplecom)
5. [Fork development](#fork-development)
6. [Release](#Release)
7. [TODO](#todo)

# Web installation:
1. Create account: infinityfree.net (email confirmation required)
2. Create new `Account`
3. Choose domain (any name what is not reserved)
4. Confirm Captcha and click `Create Account`
5. Click `Finish`
6. Reveal and copy `PASSWORD` to textfile on your computer (we will use it)
5. Open `Control Panel`
6. In section `DATABASES` open `MySQL Databases`
7. Add name `testapp` and click `Create Database`
8. Go back to `Control Panel` (menu on upper left)
9. Click Online `File Manager`
10. Go to htdocs
11. Upload via uplad icon:  
- urls: https://github.com/pbaranski/testerappbeta/blob/main/jt/ta-0.zip?raw=true  
- urls: https://github.com/pbaranski/testerappbeta/blob/main/jt/ta-1.zip?raw=true  
- urls: https://github.com/pbaranski/testerappbeta/blob/main/jt/ta-2.zip?raw=true  
- urls: https://github.com/pbaranski/testerappbeta/blob/main/jt/uz.php
12. Go to unzziper page http://[app url]/uz.php
13. Click unzip `ta-0` and wait till green header appear with file name 
14. Click unzip `ta-1` and wait till green header appear with file name 
15. Click unzip `ta-2` and wait till green header appear with file name 
16. Close window with uzipper page
16. Close `Online File Manager` page (Warning - indexing new files can take while so bepatient if this view will not work)
17. Go back to `Control Panel` (menu on upper left)
18. Click in `PREFERENCES` `Account Setting`
19. Prepare data for installation - open text file on your computer end add there values for:   
    - MySQL user name	?  
    - MySQL host name	?  
    - Additionally:   
    - Your database name is MySQL user name + `_testapp`
20. Go to main app (https://app.infinityfree.net/accounts | your app) 
copy URL to your application (Label)
21. Go to your site URL 
22. Go to SETUP APP procedure and use provided data

## Certificate   
Some steps can take long time to set (couple of hours)
1. Go to Free SSL Certificates
2. New SSL Certificate
3. Add doman to firld and Continue
4. Choose proveder (Recomended)
5. Cilck `Setup CNAME Record Automatically`
6. Wait until change `Not Ready` state to `Ready`
7. Click `Request Ceritificate`
8. Then `Install SSL Certificate Automatically`
9. Now your site is available under https

# Setup APP
1. Welcome:   
	- Next
2. License Acceptance  
	- Check: I accept the terms in the Licence Agreement  
	- Next  
3. Database Configuration  
	- Existing Empty Database  
	- Database Host Name: 127.0.0.1  
	- Database Name: testerapp  
	- OrangeHRM Database Username: testerapp  
	- OrangeHRM Database User Password: (password from step 4. Create DB i.e. PepNntOp3vNgjaDj)  
	- Next  
4. System Check  
	- Next  
5. Instance Creation
	- Organization Name TesterApp
	- Country Poland
	- Language English
	- Tomezone Europe/Amsterdam
	- Next
6. Admin User Creation
	- Jan Kowalski
	- emali (any)
	- Admin Username: superuser
	- Password: Safe password like: aA1!2345
	- Next
7. Confirmation
	- Install
8. Installation
	- Wait and then Next
9. Installation Complete
	Launch OrangeHRM
	- Login with  provided username and password

# Local instalation:
for app name orangehrm-5.1/
1. Install xampp 
    - default it will be installed in C:\xampp\
    - Run xampp
    - Start Apache 
    - Start MySQL

2. Enable DB features
    - open xampp/php/php.ini 
    - uncomment:
        - ;extension=php_intl.dll
        - ;extension=php_gd.dll

3. Download app:
    - https://github.com/orangehrm/orangehrm/releases/tag/v5.1
    - unpack folder what is inside zip (orangehrm-5.1) to:
      - C:\xampp\htdocs

4. Create DB:
    - In xampp click Admin for MySQL
    - In phpmyadmin go to User accounts tab
    - In New section click  Add user account
      - Username: testerapp, 
      - Password (click Generate and safetly save it) i.e. AWKpmgSb*sMDeMJ)
    - In section Database for user account check
    - Create database with same name and grant all privileges.
    - Grant all privileges on wildcard name (username\_%).
    - Scroll down and click Go
    - Verify user in User accounts tab

Setup app under http://localhost/orangehrm-5.1/

# Development
1. Xdebug:
    - Go to https://xdebug.org/wizard
    - Start Xampp Apache
    - Go to localhost click PHP info, copy all site content (ctl+a, ctrl+c)
    - Paste it to xdebug site 
    - Cick Analyse my phpinfo()
    - Download file i.e: php_xdebug-3.1.5-8.1-vs16-x86_64.dll
    - Move the downloaded file to C:\xampp\php\ext, and rename it to php_xdebug.dll
    - Update C:\xampp\php\php.ini to have the line: zend_extension = xdebug

    - Restart the Apache Webserver

2. Open APP in browser 
    - and install the Xdebug Helper browser extension.
      - https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc
    - HELP:
      - https://tommcfarlin.com/xdebug-in-visual-studio-code/
      - https://www.youtube.com/watch?v=uEDkph4OCDg
    - ALTERNATIVE PHP INFO: if above not work - 
      - go to folder of debugged app, 
      - open index.php, 
      - replace content with <?php echo phpinfo(); ?>
      - open site and copy content

3. VSC
    - plugin: 
      - PHP Debug
    - settings
      - Ctrl+Shift+P) PREFERENCE Open user Settings (JSON)
      - add:
        - "php.debug.executablePath": "C:\\xampp\\php\\php.exe",
        - "php.validate.executablePath": "C:\\xampp\\php\\php.exe"
    - run debug
      - Go to debug
      - Click Run and Debug
      - click link create a launch json file 
      - choose PHP
      - New configuration in Debug available Listen for Xdebug
    - Add brakpoint in C:\xampp\htdocs\orangehrm-5.1\src\plugins\orangehrmCorePlugin\Controller\Rest\V2\AbstractRestController.php
      - $request = new Request($httpRequest);
      - In Chrome in app login and navigate to Admin tab
      - !!!Should work


# Fork development
1. If freash form forked repo 
    - check gitignore form our fork repo in
    - C:\xampp\htdocs\orangehrm-5.1\src\client\.gitignore
    - C:\xampp\htdocs\orangehrm-5.1\.gitignore
    - C:\xampp\htdocs\orangehrm-5.1\installer\client
2. Check you can debug (step Development completed)
    - install yarn
    - https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable
3. Do changes in C:\xampp\htdocs\orangehrm-5.1\src\client
    - i.e. C:\xampp\htdocs\orangehrm-5.1\src\client\src\core\util\services\api.service.ts
    - Open C:\xampp\htdocs\orangehrm-5.1\src\client in terminal
    - yarn install
    - then
    - yarn build
4. Main file mods:
    - C:\xampp\htdocs\orangehrm-5.1\src\client\src\core\util\services\api.service.ts
    - C:\xampp\htdocs\orangehrm-5.1\src\vendor\symfony\http-kernel\HttpKernel.php
    - c:/xampp/htdocs/orangehrm-5.1/src/plugins/orangehrmCorePlugin/Controller/Rest/V2/AbstractRestController.php
    - routes.yaml (adding POST where PUT and DELETE)
    - unprotected variables: protected $method; protected $headers = []; protected HttpRequest $httpRequest;
    - logo, favico and copy (see commit regarding this change)

# Release
1. Download repo from GH
2. Unzip
3. Go to folder and then to src
4. Remove files: 
src\client\.gitignore
.gitignore
installer\client.gitignore
whole jt directory
5. Zip folders Client Vendor as ta-1.zip
6. Zip folder Plugins as ta-2.zip
7. Cut and paste zips in folder jt in repo where are placed zip files
8. Delete folders what had been zipped
9. Zip whole project as ta-0.zip
10. Synchronize it with folder jt in repo
11. Push to repo

# TODO
- TODO: Mailing client verification  
- TODO: Updated REST API docs
- TODO: Preparing production repo
- TODO: Remove social icons login window
- TODO: Licence
