# Welcome to Phoenix Club!
This is the repo for the Purdue Hillenbrand Hall Phoenix Club website.

# To Do for v2.3
- [X] Add destroy_newsletters to reset year
- [X] End of semester feature -> erase points, record whether student had >= a certain amount of points
- [ ] Page to add senators (for indiv./floor points)
- [ ] Better form validation messages (ex: "You did not have a <field>", "<Field> cannot have <this>")
- [ ] Use `global_helper` for password comparing (currently open to SQL injections)
- [ ] Refactoring and consistent coding:
	- [ ] Remove '_helper' from `$this->load->helper()`
	- [ ] Remove IsCurrent column for students
	- [ ] Properly use `$this->db->dbprefix()` ([example](https://stackoverflow.com/questions/16021367/adding-table-prefix-to-join-in-codeigniter))
- [ ] User management options:
	- [ ] https://github.com/trafficinc/CodeIgniter-Authit
	- [ ] http://community-auth.com/documentation
	- [ ] http://benedmunds.com/ion_auth/
- [ ] Better grid system for forms (make most of the form elements way smaller for large screens)
- [ ] ~~Redesign home page (maybe enable [Canva integration](https://www.canva.com/))~~ no longer needed
- [X] Fix main page errors about getting content (HTTP/HTTPS issue)
- [X] Button to reset floor points
- [X] Newsletter section
- [X] Newsletter form
- [ ] ~~URL Shortener~~ no longer needed
- [X] VITAL: FIX CONTACT PAGE
- [X] VITAL: Fix SimpleHeader for Contact/Leaderboard
- [X] VITAL: Fix PhoenixClub link on home page (and slogan)

# Why Codeigniter?
Originally I was going to build a Rails app, but Purdue's web servers only support mysql and PHP. I chose Codeigniter because it was the simplest PHP framework to use.

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<WEBSITE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `system/core/Controller.php`, set `$this->output->enable_profiler(FALSE);`
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Rum `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Add a value for `ResetYearKey`, `ResetSemesterKey`, `ResetFloorKey`, and `RollcallKey` in `phoenix_globals`
