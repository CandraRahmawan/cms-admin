Backend Admin CMS Version 1.1.0
> contains dashboard Administrator CMS, build use CakePHP Version 3.8.9

Requirement :
- PHP >= 5.6
- MySQL >= 5.5.3
- MariaDB >= 5.5
- SQLite 3

Depedencies :
- cms-web https://bitbucket.org/candra_rahmawan/cms-web/src/master/

Login :
- user `candra`, pass `candra`

Database import :
- `sql/cms.sql`

Configuration :
- rename `.env.default` file into `.env` and adjust your configuration

Deployment :
- we use deployment .cpanel.yml, but this is for production only, considering there is no environment. [guide deployment](https://docs.cpanel.net/knowledge-base/web-services/guide-to-git-deployment/)
- for development you can use manual upload from FTP or git.
- default deployment production url is `/content-management`
