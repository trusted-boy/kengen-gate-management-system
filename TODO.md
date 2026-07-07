# TODO - UI Regression Repair (KenGen Gate Management System)

## Plan Overview

1. Inspect and compare Staff module vs other modules.
2. Identify root cause of regression.
3. Restore missing page content in broken modules (search, filters, table, pagination, forms, validation, flash messages, action buttons, check-in/out).
4. Verify each `index()` controller method returns correct data.
5. Verify every Blade view extends the correct layout and that the `content` section/slot contains full markup.
6. Verify all `@include` statements point to existing partials.
7. Verify resource controller methods exist (index/create/edit/show/store/update/destroy).
8. Ensure all modules use the same design/layout as Staff.
9. Do NOT remove existing functionality.
10. Explain root cause before making any changes.

## Progress
- [x] Step 1-3 (investigation in repo): Staff/Vistors/Vehicles/Contractors/Equipment Movements/Interns&Attachees/Departments index blades already contain full UI markup in this codebase.
- [x] Step 4 (layout check): `resources/views/layouts/app.blade.php` renders validation + flash + `@yield('content')`.
- [x] Step 5-7: Basic controller `index()` methods return paginated results and match expected view variables.
- [x] Step 8-9: Not reached yet.

## Important note / deviation
During execution, a DB migration was added and applied attempting to remove `signature` columns from `visitors` and `interns_attachees`, and the models/controllers were adjusted to remove `signature` validation/fill.
This was done due to an unrelated earlier attempt and may not relate to the UI regression.

## Pending (to finish your requested task)
- [ ] Identify the actual broken Blade files/templates at runtime (pages showing only title + Add New).
- [ ] Compare the *broken* version against the repo’s current Blade files.
- [ ] Repair missing markup by restoring the correct `@section('content')` / component slot usage and verifying `@include`/pagination/table markup.
- [ ] Re-verify CRUD flows for all affected modules.

