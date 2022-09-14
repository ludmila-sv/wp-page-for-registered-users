1) New users can be approved via the plugin WP approve users. Settings: /wp-admin/options-general.php?page=wp-approve-user
Users are managed here /wp-admin/users.php?action=wpau_update&count=1

2) New page status "For registered users" is added.
NB. While editing a page, you need to press "Save", not "Publish" button to save changes and preserve the status. If you press "Publish" the status will become "published".

3) Status check is added into the default page template page.php.
If a page has the "For registered users" status, new file page-login.php is included/ It contains register and login forms. The file is a short version of the wp-login.php file from the root folder.

NB! Some functions from page-login.php should be executed BEFORE headers are sent, so get_header(); is put AFTER the point where page-login.php is included.
get_header() is also inserted into page-login.php in appropriate place.
