# Snappfood Clone (Backend)

A Laravel 10 backend project inspired by Snappfood, built as a final bootcamp project.

## Overview

This project implements a multi-role food ordering system with separate authentication flows for admins, sellers, and customers.

The UI and seeded data are in Persian (RTL), as the original target audience was Persian-speaking users.

## Roles & Authentication
- **Admin**: Web authentication (session)
- **Seller**: Web authentication (session)
- **Customer**: API authentication (Sanctum)

## Features
- Category and restaurant management (Admin)
- Food and order management (Seller)
- Food listing and ordering via REST API (Customer)
- Multi-guard authentication
- Image upload using Laravel storage
- Localization support (fa / en)

## Tech Stack
- Laravel 10
- PHP 8+
- MySQL
- Laravel Sanctum

## Known Limitations
- Admin panel URL is not linked from the public landing page
- UI and seeded data are primarily in Persian (RTL)
- Project setup instructions are not yet documented

## Routes Overview
- `/admin/login` - Admin authentication
- `/seller/login` - Seller authentication
- `/api/v1/customer/*` - Customer-facing API (Sanctum protected)
