# laravel-skebby

This is an unofficial package for integrating skebby sms gateway with laravel projects.

### Requirements

- php >= 7.0
- php curl extension

### Installation

you can install it using below composer command

`composer require jobayerccj/skebby`

### How to use

1. After installing package, write `use jobayerccj\Skebby\Skebby;` where you want to use it

2. Then create a new instance for that class like `$skebby = new Skebby;`

3. After that, update required information using following methods

       $skebby->set_username('skebby_username');
       $skebby->set_password('skebby_password');
       $skebby->set_method('send_sms_classic');
       $skebby->set_text('text for your sms');
       $skebby->set_sender('ICT Euro Limited');
       
       $recipients = array('+39..........');
       $skebby->set_recipients($recipients);

4. At last, use this method to send your sms `$sending_status = $skebby->send_sms();` `$sending_status` will show sending status(success, failed) whether it's failed or successful. If failed, then reason behind it, If successful, then will show sms id & remaining balance with status info.

   There are few other methods for helping you like `get_credit_info()` which will show your account's latest credit data.

