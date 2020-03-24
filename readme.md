## Backend Admin CMS Version 1.1.0
> contains dashboard Administrator CMS, build use CakePHP Version 3.8.9

#### Requirement :
- PHP >= 5.6 (recommend for use php >= 7.x) **currently not supported for php 7.4, still has some warning error.**
- MySQL/MariaDB >= 5.5.3
- SQLite 3
- Apache Server

#### Depedencies :
- [cms-web](https://bitbucket.org/candra_rahmawan/cms-web/src/master/)

#### Login :
- user `candra`, pass `candra`

#### Database import :
- `sql/cms.sql`

#### Configuration :
- copy files `.env.default` into `.env` and adjust your configuration
- create directory `logs` and `tmp`

#### Deployment :
- we use deployment .cpanel.yml, but this is for production only, considering there is no environment. [guide deployment](https://docs.cpanel.net/knowledge-base/web-services/guide-to-git-deployment/)
- for development you can use manual upload from FTP or git.
- default deployment production url is `/content-management`

#### Compatible :
> if you use windows then ready to go, if you doesn't use windows you need make permission on directory `logs` and `tmp` (usually using chmod -R 777).
