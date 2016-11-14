set :stages,        %w(sandbox prod)
set :default_stage, "sandbox"
set :stage_dir,     "app/config/deploy"

task :lexik_translations do
  capifony_pretty_print "--> Translations"
  result = capture("cd #{latest_release} && php #{symfony_console} lexik:translations:import --cache-clear --globals --env=prod")
  print result
  capifony_puts_ok
end

task :app_notifications do
  capifony_pretty_print "--> App notifications"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:app_notification:send --env=prod")
  print result
  capifony_puts_ok
end

task :transaction_expire do
  capifony_pretty_print "--> Transaction expire"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:transaction:expire  --env=prod")
  print result
  capifony_puts_ok
end

task :subscriptions_auto_renewing do
  capifony_pretty_print "--> Subscription auto renew"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:subscriptions:auto-renewing --env=prod")
  print result
  capifony_puts_ok
end

task :subscription_expire do
  capifony_pretty_print "--> Subscription Expire"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:subscription:expire --env=prod")
  print result
  capifony_puts_ok
end

task :transaction_temp_expire do
  capifony_pretty_print "--> Transaction expire"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:transaction_temp:expire  --env=prod")
  print result
  capifony_puts_ok
end

task :js_routing do
  capifony_pretty_print "--> Js routing update"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:js-routing:dump  --env=prod")
  capifony_puts_ok
end

task :currencies_update do
  capifony_pretty_print "--> Currencies"
  result = capture("cd #{latest_release} && php #{symfony_console} currency:exchange:update  --env=prod")
  print result
  capifony_puts_ok
end

task :fortuno do
  capifony_pretty_print "--> Sync fortuno"
  result = capture("cd #{latest_release} && php #{symfony_console} fortuno:paymethods:sync --env=prod")
  print result
  capifony_puts_ok
end

task :offer_sync do
  capifony_pretty_print "--> Offer sync"
  result = capture("cd #{latest_release} && php #{symfony_console} shop:offer:sync  --env=prod")
  print result
  capifony_puts_ok
end

task :copy_node do
  capifony_pretty_print "--> Copy Node"
  result = capture("cd #{latest_release} && php #{symfony_console} xsolla:paymethods:sync  --env=prod")
  print result
  capifony_puts_ok
end

task :xsolla_sync do
  capifony_pretty_print "--> Copy Node"
  result = capture("cd #{latest_release} && php #{symfony_console} xsolla:paymethods:sync --env=prod")
  print result
  capifony_puts_ok
end

task :symfony_custom do
  capifony_pretty_print "--> Symfony custom #{str_command}"
  result = capture("cd #{latest_release} && php #{symfony_console} #{str_command} --env=prod")
  print result
  capifony_puts_ok
end

task :app_paymethods_add do
  capifony_pretty_print "--> Add Pay Methods to Articles in App Shops, in countries...-\n"
  result = capture("cd #{latest_release} && php #{symfony_console} app:paymethods:add #{ENV['appId']} #{ENV['providerName']} #{ENV['countryId']} #{ENV['debug']} --env=prod")
  print result
  capifony_puts_ok
end

task :app_fakedata_populate do
  capifony_pretty_print "--> Add fake data to database...-\n"
  result = capture("cd #{latest_release} && php #{symfony_console} app:fakedata:populate #{ENV['clientId']} #{ENV['howMany']} #{ENV['appId']} #{ENV['debug']} #{ENV['forcePayment']} --env=prod")
  print result
  capifony_puts_ok
end

task :increase_assets_version do
  capifony_pretty_print "--> Updating assets version"
  run "if [ -f #{shared_path}/app/config/parameters.yml ]; then sed -i.bak 's/\\(assets_version:[[:space:]]*\\)[[:digit:]]*/\\1#{release_name}/' #{shared_path}/app/config/parameters.yml; fi"
  capifony_puts_ok
#  capifony_pretty_print "--> Updating assets"
#    result = capture("cd #{latest_release} && php #{symfony_console} symfony:assetic:dump --env=prod")
#    print result
#    capifony_puts_ok
end

task :nginx_call_routes_with_cache do
  capifony_pretty_print "--> Nginx call routes with cache"
  result = capture("cd #{latest_release} && php #{symfony_console} nginx:call:routes_with_cache --env=prod")
  print result
  capifony_puts_ok
end

after "symfony:assetic:dump", "increase_assets_version"
after "deploy:migrations", "lexik_translations"
after "deploy:migrations", "js_routing"
after "deploy:migrations", "nginx_call_routes_with_cache"
after "deploy:migrations", "deploy:cleanup"


require 'capistrano/ext/multistage'