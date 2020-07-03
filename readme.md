## Backend Admin CMS Version 1.2.1
> contains dashboard Administrator CMS, build use CakePHP Version 3.8.9

#### Requirement :
- PHP >= 5.6 (recommend for use php >= 7.x) **currently not supported for php 7.4, still has some warning error.**
- MySQL/MariaDB >= 5.5.3
- SQLite 3
- Apache Server

#### Depedencies :
- [cms-web](https://github.com/CandraRahmawan/cms-web)

#### Login :
- user `candra`, pass `candra`

#### Database import :
- `sql/cms.sql`

#### Configuration :
- copy files `.env.default` into `.env` and adjust your configuration
- create directory `logs` and `tmp`

#### Deployment :
- We use deployment .cpanel.yml, but this is for production only, considering there is no environment. [guide deployment](https://docs.cpanel.net/knowledge-base/web-services/guide-to-git-deployment/)
- For development environment you can use manual upload from FTP, Cpanel File Manager or Git.
- Default deployment production url is `/content-management`

#### Compatible :
> if you use windows then ready to go, if you doesn't use windows you need make permission on directory `logs` and `tmp` (usually using chmod -R 777).


![picture](https://github.com/CandraRahmawan/cms-web/blob/master/admin-dashboard.png)
