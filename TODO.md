# TODO

## Vehicle Trip Management + Passengers Module
- [ ] Step 1: Inspect existing auth/role & navigation patterns in Blade.
- [ ] Step 2: Add migrations for drivers, vehicle trips, trip passengers, and extend vehicles with odometer + service fields (with FK/indices).
- [ ] Step 3: Implement models + relationships + computed attributes.
- [ ] Step 4: Add FormRequest validation (store/update + check-in/out rules, mileage constraints, status transitions).
- [ ] Step 5: Implement controllers for VehicleTrip CRUD + trip passenger storage.
- [ ] Step 6: Implement Blade views for trip list/create/edit/show + passenger inputs.
- [ ] Step 7: Update routes/web.php with role-protected groups.
- [ ] Step 8: Update DashboardController + dashboard.blade.php widgets (inside/outside, completed today, overdue, totals, top vehicles/drivers, gate stats, service reminders).
- [ ] Step 9: Implement reports routes/controllers/views for mileage/servicing/active/completed/gate & passenger movement.
- [ ] Step 10: Add feature tests for key flows (validation, distance calc, overdue, mileage constraint).
- [ ] Step 11: Run migrations and basic smoke tests.

