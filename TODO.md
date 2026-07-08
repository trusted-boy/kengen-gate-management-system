# TODO - Fix dashboard layout (sidebar overlap + horizontal scroll)

- [ ] Inspect current layout CSS in `resources/views/layouts/app.blade.php` and sidebar markup in `resources/views/layouts/sidebar.blade.php`.
- [x] Refactor the layout CSS in `resources/views/layouts/app.blade.php` to shift content right of the fixed sidebar (no overlap).

- [x] Ensure `body`/main wrapper prevents horizontal overflow (`overflow-x: hidden`) and does not cause viewport width expansion.

- [x] Add responsive behavior for mobile (sidebar slides in/out; content uses left padding/margin correctly).

- [x] Remove any layout-causing side effects (e.g., `body { display:flex; }` if it triggers overflow; ensure main has correct sizing).

- [x] Rebuild frontend (`npm run build`) and manually verify by loading dashboard.


