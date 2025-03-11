# Sequel Bank: the Next Best Thing in Banking

_This is a fake bank website designed to teach cybersecurity learners how to do SQL injections._


## Quick Start:

1. Clone the repository
2. Run `composer install`
3. Run `php artisan migrate`
4. Run `php artisan db:seed`
5. Run `php artisan serve`
6. Open `http://localhost:8000` in your browser

The starter test account is `test@test.com` with the password `password`.
If you don't like this, you can change it in the `users` table or in DatabaseSeeder.php.

### Demo:

(future demo site goes here)

### Notes

To get this to work, I intentionally did not use Laravel's built-in input sanitization.

<!-- feel free to use this code as you please -->

This database is *supposed* to be experimented on, so don't worry if you break it.
The DB resets every day so you don't need to clean up after yourself.


>! Spoiler: these are hints. !<

>! 1. Log in first. It's not on the first page. !<

>! 2. Click around on the account page once you're logged in. !<

>! 3. Pay attention to the URL. !<

>! I'm about to give you a big hint. Be forewarned. !<

>! 4. Click the "View Account" button, and pay attention to the URL. !<

>! I'm about to essentially give away the answer. Last chance. !<

>! 6. Here's one sample URL injection: `/dashboard?account=1%20or%201=1` !<
