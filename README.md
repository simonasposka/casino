### Kill apache on port :80 sometimes randomly starting
sudo lsof -i -P -n | grep 80
kill -9 process_id
