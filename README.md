# Test Paymefy

## Requirements

· docker & docker compose ( >= v19.03.0)

· php8.0

· composer

## Setup

· Clone this repo
```bash
$   git clone git@github.com:ahernandezmiro/paymefy_test.git
```
· Run composer
```bash
$   composer install
```
· Run docker-compose to start the database container
```bash
$   docker-compose up
```

## Usage

```bash
php application.php <csv,xml,db>
```