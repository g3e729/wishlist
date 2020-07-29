## Installation

- clone
- composer install
- configure mailjet credentials on .env file

## Site Feature

- / : home and login page
- /register : register page
- /view/{code} : public wishlist access

Logged

- /wishlists : user's participated wishlists
- /wishlists/{wishlist} : wishlist details page
  - owner
    - can edit wishlist
    - can remove wishlist
    - add wish/item
    - update wish/item
    - remove wish/item
    - invite users to be part of the wishlist [adds to invites table. run `php artisan send:invites` to send all invites]
    - remove participants
  - participant
    - can take item [sends email to you to notify you have chosen an item from the wishlist]
    - update taken item to purchased/unpurchased
    - remove assigned item
- /my-wishlists : view all user's wishlists
- /to-buy/list : list of all assigned wishes or items
  - update taken item to purchased/unpurchased
  - remove assigned item

## Emails
- send notification to your email upon choosing wish items : triggers upon clicking take item from items list
- send invitation : triggers when running `php artisan send:invites`
