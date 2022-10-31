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
1. Create account: `infinityfree.net` (email confirmation required)
2. Create new `Account`
3. Choose domain (any name what is not reserved), save to text file on your computer as url
4. Confirm Captcha and click `Create Account`
5. Click `Finish`
6. Reveal and copy `PASSWORD` to textfile on your computer (we will use it)
7. Open `Control Panel` (Approve notice if will show up)
8. In section `DATABASES` open `MySQL Databases`
9. 	Add name `testapp` and click `Create Database`
10. Go back to `Control Panel` (menu on upper left)
11. Click Online `File Manager`
12. Go to htdocs
13. Upload via `Fetch file` (bottom menu, 3th from left, cloud with down arrow): 
	- https://github.com/pbaranski/testerappbeta/blob/hrm-52-v2-upgrade/jt/ta52-release/ta-0.zip?raw=true
	- https://github.com/pbaranski/testerappbeta/blob/hrm-52-v2-upgrade/jt/ta52-release/ta-1.zip?raw=true
	- https://github.com/pbaranski/testerappbeta/blob/hrm-52-v2-upgrade/jt/ta52-release/ta-2.zip?raw=true
	- urls: https://raw.githubusercontent.com/pbaranski/testerappbeta/main/jt/uz.php
14. Go to unzziper page: http://[app url]/uz.php
	-  if page do not show up you need wait for dns resolution (up to 72h)
15. Click unzip `ta-0` and wait till green header appear with file name 
16. Click unzip `ta-1` and wait till green header appear with file name 
17. Click unzip `ta-2` and wait till green header appear with file name 
18. Close window with uzipper page
19. Close `Online File Manager` page (Warning - indexing new files can take while so bepatient if this view will not work)
20. Go back to `Control Panel` (menu on upper left)
21. Click in section `PREFERENCES` `Account Setting` (last option)
22. Prepare data for installation - open text file on your computer end add there values for:   
    - MySQL user name	= [paste here user name]  
    - MySQL host name	= [paste here host name]  
    - Additionally:   
		- Your database name is MySQL user name + `_testapp`
23. Go to main app (https://app.infinityfree.net/accounts | your app) 
copy URL to your application (Label)
24. Go to your site URL 
25. Go to SETUP APP procedure and use provided data

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
		- for infinityfree hosting: i.e. `sql210.epizy.com`
	- Database Name: i.e testerapp  
		- for infinityfree hosting: `epiz_[your number]_testapp`
	- OrangeHRM Database Username: i.e testerapp 
		- for infinityfree hosting: `epiz_[your number]`
	- OrangeHRM Database User Password: (password from step 4. Create DB i.e. PepNntOp3vNgjaDj) 
		- for infinityfree hosting: password for your `epiz_[your number]`
	- Do not check `Enable Data Encryption`
	- Next - it can take couple minutes  
4. System Check  
	- Next 
	- in case of errors do a screenshot and send to us
5. Instance Creation
	- Organization Name: `TesterApp`
	- Country: `Poland`
	- Language: `English`
	- Tomezone: `Europe/Amsterdam`
	- Next
6. Admin User Creation
	- `Jan Kowalski`
	- emali (any)
	- Admin Username: `superuser`
	- Password: Safe password like: `aA12345!`
	- Next
7. Confirmation
	- Install
8. Installation
	- Wait and then Next
9. Installation Complete
	Launch OrangeHRM
	- Login with provided username and password
10. Config created in!

# Local instalation:
for app name `orangehrm-5.1`
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
    - https://github.com/orangehrm/orangehrm/releases/
    - unpack folder what is inside zip (orangehrm-5.1) to:
      - C:\xampp\htdocs

4. Create DB:
    - In `xampp` for `MySQL` click `Admin` result: phpMyAdmin page opened
    - In `phpMyAdmin` go to `User accounts` tab (on top of screen)
    - In `New` section click `Add user account`
    - In `Add user account` page
      - In `Login Information`: 
        - `User name`: testerapp, 
        - `Password` (click `Generate` and safetly save it) i.e. AWKpmgSb*sMDeMJ)
      - In section `Database for user account` check
        - `Create database with same name and grant all privileges.`
        - `Grant all privileges on wildcard name (username\_%).`
      - Scroll down and click `Go`
        - If error apear check in `User accounts tab` if user with given name exist
        - If exist - create user with different username
      - Ignore `Edit privileges: User account 'testerapp'@'%'`
    - Verify user in `User accounts tab`

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
      - (Ctrl+Shift+P) PREFERENCE Open user Settings (JSON)
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
	- All file mods are placed in `jt` folder in Internal for given release (beside routes what are changed by regex)
    - C:\xampp\htdocs\orangehrm-5.1\src\client\src\core\util\services\api.service.ts
    - C:\xampp\htdocs\orangehrm-5.1\src\vendor\symfony\http-kernel\HttpKernel.php
    - c:/xampp/htdocs/orangehrm-5.1/src/plugins/orangehrmCorePlugin/Controller/Rest/V2/AbstractRestController.php
    - routes.yaml (adding POST where PUT and DELETE)
    - unprotected variables: protected $method; protected $headers = []; protected HttpRequest $httpRequest;
    - logo, favico and copy (see commit regarding this change)

# Upgrading fork
0. New db for testing initialised see: TODO reference to new db steps
1. Download new release package zip https://github.com/orangehrm/orangehrm/releases/
2. Unpack it 
3. Make new branch with jt fork (just copy xamp forlder with repo)
	- copy JT folder to external directory
4. Clean all files
5. Add new orange files
6. Add gitignore files
	- root
	- src/client
	- installer/client
7. Start VSC + Xampp and navigate to localhost site
8. Go over fresh installation
9. Login and verify
10. Add .gitkeep files in:
	- src/cache/
	- src/config/
	- src/log/
11. Commit 
12. Paste config JT files to top directory of app in xamp
13. First pack changes: Branding - README, Html, ico. png
14. Update routes in files `./src/plugins/**/routes.yaml`
	- Replace `PUT` -> `POST, PUT` 
	- Replace POST, POST -> POST
	- Replace (regex on in vsc search .*) \[.?DELETE?.\] -> [POST, DELETE]
	- Add custom route (form jt files) and verify merge
	- Find all `.put('api`
		- add to PUT request additional object, after body: `,{headers:{'x-method': 'PUT'}}`
		- change `put` to `post` in found reuests
15. Second pack changes: Routes updated
16. Merge API changes to main repo
17. Third commit API Changes
19. Locale bug in C:\xampp\htdocs\orangehrm-5.1\src\plugins\orangehrmI18NPlugin\Controller\I18NMessagesController.php
	- Commented if to overrite always local storage
	- ```
	    // if (!$response->isNotModified($request)) {
            $response->setContent($this->getI18NService()->getTranslationMessagesAsJsonString($locale));
            $this->setCommonHeaders($response, 'application/json');
        // }
		```
18. Open C:\xampp\htdocs\orangehrm-5.1\src\client in terminal
    - yarn install
    - yarn build
20. Test
21. Copy JT internal folder for new release and Synch modified files (oudside repo)
22. Add JT folder to repo
23. Prepare release

# Tests
1. In `jt` directory there is tests folder
2. You can run Postman collection
	- update in environments `user`, `pass`, `url` values
3. TODO full POSTMAN collection
4. TODO Full automation tests

# Release
1. Download repo from GH
2. Unzip with nam i.e. `tapp`
3. Open main folder
4. Remove files: 
	- `.gitignore`
	- `src\client\.gitignore`
	- `installer\client.gitignore`
	- whole `jt` directory
5. Zip folders `src\client` + `src\vendor` as `ta-1.zip`
6. Zip folder `src\plugins` as `ta-2.zip`
7. Cut and paste zips in folder `jt` in repo where are placed `zip files`
8. Delete folders from `tapp` what had been zipped:
	- `src\client`
	- `src\vendor`
	- `src\plugins`
9. Zip rest of the `tapp` folder (inside folder `tapp`) as `ta-0.zip`
10. Synchronize it with folder `jt` in repo
11. Push to repo

# TODO
- TODO: Mailing client verification  
- TODO: Updated REST API docs
- TODO: Preparing production repo
- TODO: Remove social icons login window
- TODO: Licence
- TODO: Full tests
