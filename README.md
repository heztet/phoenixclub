# Welcome to Phoenix Club!
Since the Phoneix Club's website was last updated in 2006, I've decided that I'm going to re-work it for HTML5. Basically, I want to make it look aesthetically pleasing and have ways for people to get in contact with our club.

# To Do for v1.1
- [X] Check that students aren't already checked into event
- [X] Fade out error/success messages when checking in students
- [X] Fix student views (eg, when the student id is `index.php/12345678` instead of `index.php/012345678`)
- [ ] Add an easy way to start a new year for events
- [ ] Fix `/index.php` not having the correct site links

# Why Codeigniter?
Originally I was going to build a Rails app, but Purdue's web servers only support mysql and PHP. I chose Codeigniter because it was the simplest PHP framework to use; I only had to download it and put it in the proper folder.

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<DATABASE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `system/core/Controller.php`, set `$this->output->enable_profiler(FALSE);`
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`