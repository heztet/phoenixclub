# Welcome to Phoenix Club!
Since the Phoneix Club's website was last updated in 2006, I've decided that I'm going to re-work it for HTML5. Basically, I want to make it look aesthetically pleasing and have ways for people to get in contact with our club.

# To Do for v2.3
- [ ] Redesign home page
	- [ ] New theme
	- [ ] Actual content about hillenbrand
- [ ] Fix main page errors about getting content (HTTP/HTTPS issue)
- [ ] Better form validation messages (ex: "You did not have a <field>", "<Field> cannot have <this>")
- [ ] Better grid system for forms (make most of the form elements way smaller for large screens)
- [ ] Page to add senators (for indiv./floor points)
- [ ] End of year feature -> erase points, record whether student had >= a certain amount of points
- [ ] Button to reset floor points
- [X] Newsletter section
- [ ] Newsletter form
- [ ] ~~Save floor/side on failed password for /rollcall~~
- [ ] URL Shortener
- [ ] User management
	- [ ] https://github.com/trafficinc/CodeIgniter-Authit
	- [ ] http://community-auth.com/documentation
	- [ ] http://benedmunds.com/ion_auth/
- [ ] VITAL: FIX CONTACT PAGE

# Why Codeigniter?
Originally I was going to build a Rails app, but Purdue's web servers only support mysql and PHP. I chose Codeigniter because it was the simplest PHP framework to use; I only had to download it and put it in the proper folder.

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<DATABASE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `system/core/Controller.php`, set `$this->output->enable_profiler(FALSE);`
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Rum `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Add a value for `ResetKey` in `phoenix_globals`
