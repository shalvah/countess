# countess

Realtime site visitors count using Pusher Channels


[View tutorial]()

## Prerequisites
- PHP >= 7.1.3
- Composer
- A [Pusher account](https://pusher.com/signup) and [Pusher app credentials](http://dashboard.pusher.com/)

## Getting started
Clone the project and install dependencies:

```bash
git clone https://github.com/shalvah/countess
cd countess
composer install
```

Copy the `.env.dist` file to a `.env` file. Add your Pusher app credentials to this file:
```
PUSHER_APP_ID=your-app-id
PUSHER_KEY=your-app-key
PUSHER_SECRET=your-app-secret
PUSHER_CLUSTER=your-app-cluster
```

## Built With

* [Pusher](https://pusher.com/) - APIs to enable devs building realtime features
* [Symfony](http://symfony.com)
