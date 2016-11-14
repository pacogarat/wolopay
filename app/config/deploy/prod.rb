set :application, "wolopay"
set :domain,      "#{application}.com"
set :deploy_to,   "/furanet/sites/#{domain}/web/htdocs/deploy"
set :app_path,    "app"
set :user,        "deployer"
set :use_sudo,    false
set :port,        4939
set :branch,      "master"
ssh_options[:port] = port
set :symfony_console, "bin/console"
set :log_path,    "var/logs"
set :cache_path,  "var/cache"
set :interactive_mode, false

set :repository,  "ssh://jenkins@192.168.80.215:4939/c:/shared/wolopay.git/"
set :scm,         :git

set :deploy_via, :rsync_with_remote_cache
ssh_options[:forward_agent] = true

role :web,        domain, :port => port                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true, :port => port       # This may be the same as your `Web` server

set  :keep_releases,  5

set :use_composer, true
# set :update_vendrors, true
set :dump_assetic_assets, true

# Be more verbose by uncommenting the following line
#logger.level = Logger::MAX_LEVEL

set :shared_files,        ["app/config/parameters.yml"]
set :shared_children,     ["var/logs", "web/uploads", "sessions", "var/sessions", "var/logs", "var/translations_dynamic","node_app", "app/config/jwt"]

