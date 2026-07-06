# TODO

## Completed
- ✅ Normalized `resources/views/dashboard.blade.php` to use `@extends('layouts.app')` + `@section('content')` instead of `<x-app-layout>`.
- ✅ Cleared compiled views (`php artisan view:clear`).
- ✅ Verified `dashboard` route exists (`php artisan route:list`).
- ✅ Verified dashboard view has no PHP syntax errors (`php -l`).

## Remaining
- ⬜ Run a quick end-to-end browser check for: `/dashboard` and report exports (`/reports/pdf`, `/reports/excel`).
- ⬜ If any other pages use `<x-app-layout>`, normalize them similarly for consistency.

