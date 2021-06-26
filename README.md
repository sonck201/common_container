# docker_cc

## Reference

### SSL for server
- https://letsencrypt.org/getting-started/
- https://certbot.eff.org/lets-encrypt/centosrhel7-nginx
- https://snapcraft.io/docs/installing-snap-on-centos

### SSL for container
- https://hub.docker.com/r/jwilder/nginx-proxy
- https://github.com/nginx-proxy/acme-companion
- https://docs.idalko.com/exalate/pages/viewpage.action?pageId=49154328
- https://hub.docker.com/r/jrcs/letsencrypt-nginx-proxy-companion
- https://github.com/starikovs/docker-compose-3-letsencrypt-nginx-proxy-companion/blob/master/docker-compose.yml

### Transcrypt

```bash
# https://github.com/elasticdog/transcrypt
transcrypt -c aes-256-cbc -p $PASSWORD
```

### Databases

```bash
# Export
mysqldump -u [username] -p [database name] > [database name].sql

# Export with gzip
mysqldump -u [user] -p [db_name] | gzip > [filename_to_compress.sql.gz]
mysqldump -u root -p tkhind | grip > tkhind.sql.gz

# Import
mysql -u [username] -p newdatabase < [database name].sql

# Import with gzip
gunzip < [compressed_filename.sql.gz]  | mysql -u [user] -p[password] [databasename]
```

### Firewalld

```bash
$ sudo yum install firewalld
$ sudo systemctl start firewalld
$ sudo systemctl enable firewalld
$ sudo systemctl status firewalld

$ sudo firewall-cmd --zone=public --add-port=2222/tcp --permanent
$ sudo firewall-cmd --reload
```

```bash
# Check Port Status
$ netstat -na | grep 2222
$ lsof -i -P |grep http

# Check Port Status in iptables
$ iptables-save | grep 2222

# Add the port
$ vim /etc/services
service-name  port/protocol  [aliases ...]   [# comment]

$ vim /etc/services
testport        2222/tcp   # Application Name

# Open firewall ports
$ firewall-cmd --zone=public --add-port=2222/tcp --permanent
success

$ firewall-cmd --reload
success

$ iptables-save | grep 2222
-A IN_public_allow -p tcp -m tcp --dport 2222 -m conntrack --ctstate NEW -j ACCEPT

# Check newly added port status
$ lsof -i -P |grep http
httpd     6595   root    4u  IPv6  43709      0t0  TCP *:80 (LISTEN)
httpd     6595   root    6u  IPv6  43713      0t0  TCP *:2222 (LISTEN)

$ netstat -na |grep 2222
tcp6       0      0 :::2222                :::*                    LISTEN
```

### Generate htpasswd

- <http://aspirine.org/htpasswd_en.html>
