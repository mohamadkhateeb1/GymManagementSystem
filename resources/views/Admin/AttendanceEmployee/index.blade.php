@extends('Admin.layouts.app')

@section('title', 'تقارير حضور الموظفين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
  /* =========================================================
   ELITE CLUB
   ATTENDANCE & EMPLOYEE PRESENCE
   Light / Dark Theme
   ========================================================= */


/* =========================================================
   1. CONTAINER
   ========================================================= */

.attendance-container {
    width: 100%;
    direction: rtl;
    color: var(--text, #202631);
}


/* =========================================================
   2. PAGE HEADER
   ========================================================= */

.attendance-container .page-header {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    width: 100%;
    margin-bottom: 18px;
    padding: 20px 22px;

    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #e4e8ef);
    border-radius: 16px;

    box-shadow:
        0 7px 24px rgba(25, 35, 50, 0.05);
}

.attendance-container .page-header::before {
    content: "";

    position: absolute;

    right: 0;
    top: 18px;
    bottom: 18px;

    width: 4px;

    border-radius: 10px 0 0 10px;

    background: linear-gradient(
        to bottom,
        #e2b14d,
        #ad781c
    );
}

.attendance-container .page-header > div {
    padding-right: 14px;
}

.attendance-container .page-header-title {
    margin: 0 0 5px;

    color: var(--text, #202631);

    font-size: 19px;
    font-weight: 850;

    line-height: 1.5;
}

.attendance-container .page-header span {
    color: var(--muted, #858e9b) !important;

    font-size: 12px !important;
    line-height: 1.7;
}


/* =========================================================
   3. ADD MANUAL BUTTON
   ========================================================= */

.btn-add-manual {
    height: 43px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    flex-shrink: 0;

    padding: 0 18px;

    color: #ffffff;

    background: linear-gradient(
        135deg,
        #d8a844,
        #b67f20
    );

    border: 1px solid #bd8b2d;
    border-radius: 10px;

    box-shadow:
        0 6px 15px rgba(184, 130, 31, 0.18);

    font-family: inherit;
    font-size: 12px;
    font-weight: 800;

    cursor: pointer;

    transition: all 0.2s ease;
}

.btn-add-manual:hover {
    transform: translateY(-1px);

    box-shadow:
        0 9px 20px rgba(184, 130, 31, 0.25);

    filter: brightness(1.04);
}

.btn-add-manual i {
    font-size: 11px;
}


/* =========================================================
   4. STATISTICS GRID
   ========================================================= */

.attendance-container .stats-grid {
    display: grid;

    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 15px;

    margin-bottom: 18px;
}


/* =========================================================
   5. STAT CARD
   ========================================================= */

.attendance-container .stat-card-luxury {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    min-height: 105px;

    padding: 20px;

    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #e4e8ef);
    border-radius: 15px;

    box-shadow:
        0 6px 20px rgba(25, 35, 50, 0.045);

    overflow: hidden;

    transition: all 0.2s ease;
}

.attendance-container .stat-card-luxury::before {
    content: "";

    position: absolute;

    right: 0;
    top: 0;
    bottom: 0;

    width: 3px;

    background: #2fbd7c;

    opacity: 0.8;
}

.attendance-container .stat-card-luxury:nth-child(2)::before {
    background: #e0a32f;
}

.attendance-container .stat-card-luxury:hover {
    transform: translateY(-2px);

    border-color: rgba(205, 155, 58, 0.35);

    box-shadow:
        0 10px 25px rgba(25, 35, 50, 0.07);
}


/* =========================================================
   6. STAT INFO
   ========================================================= */

.attendance-container .stat-card-luxury .info h4 {
    margin: 0 0 7px;

    color: var(--muted, #858e9b);

    font-size: 11px;
    font-weight: 750;
}

.attendance-container .stat-card-luxury .info p {
    margin: 0;

    color: var(--text, #202631);

    font-size: 25px;
    font-weight: 900;

    line-height: 1;
}


/* =========================================================
   7. STAT ICON
   ========================================================= */

.attendance-container .stat-card-luxury .icon-box {
    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 13px;

    font-size: 17px;

    border: 1px solid rgba(74, 222, 128, 0.16);
}


/* =========================================================
   8. FILTER PANEL
   ========================================================= */

.attendance-container .filter-panel {
    width: 100%;

    margin-bottom: 18px;
    padding: 20px;

    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #e4e8ef);
    border-radius: 15px;

    box-shadow:
        0 6px 20px rgba(25, 35, 50, 0.04);
}

.attendance-container .filter-grid {
    display: grid;

    grid-template-columns:
        minmax(180px, 1.2fr)
        minmax(160px, 1fr)
        minmax(150px, 1fr)
        minmax(150px, 1fr)
        minmax(180px, auto);

    gap: 13px;

    align-items: end;
}


/* =========================================================
   9. FORM GROUP
   ========================================================= */

.attendance-container .form-group-luxury {
    min-width: 0;
}

.attendance-container .form-group-luxury label {
    display: block;

    margin-bottom: 7px;

    color: var(--text, #454d59);

    font-size: 11px;
    font-weight: 800;
}


/* =========================================================
   10. INPUT
   ========================================================= */

.attendance-container .input-luxury {
    width: 100%;
    height: 43px;

    padding: 0 13px;

    color: var(--text, #252b35);

    background: var(--input-bg, #fbfcfd);

    border: 1px solid var(--border, #dfe4eb);
    border-radius: 9px;

    outline: none;

    font-family: inherit;
    font-size: 11px;
    font-weight: 650;

    transition: all 0.2s ease;
}

.attendance-container .input-luxury:hover {
    border-color: #cba04d;
}

.attendance-container .input-luxury:focus {
    background: var(--surface, #ffffff);

    border-color: #c79637;

    box-shadow:
        0 0 0 3px rgba(199, 150, 55, 0.10);
}

.attendance-container .input-luxury::placeholder {
    color: #a1a8b2;
}


/* =========================================================
   11. SELECT
   ========================================================= */

.attendance-container select.input-luxury {
    appearance: none;
    -webkit-appearance: none;

    cursor: pointer;

    padding-left: 34px;

    background-image:
        linear-gradient(45deg, transparent 50%, #9aa2ae 50%),
        linear-gradient(135deg, #9aa2ae 50%, transparent 50%);

    background-position:
        calc(100% - 17px) 18px,
        calc(100% - 12px) 18px;

    background-size: 5px 5px;

    background-repeat: no-repeat;
}

.attendance-container select.input-luxury option {
    color: #202631;
    background: #ffffff;
}


/* =========================================================
   12. FILTER BUTTON
   ========================================================= */

.btn-submit-filter {
    height: 43px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 0 17px;

    color: #ffffff;

    background: linear-gradient(
        135deg,
        #d3a03d,
        #b47d1f
    );

    border: 1px solid #bc8929;
    border-radius: 9px;

    box-shadow:
        0 5px 13px rgba(181, 128, 31, 0.15);

    font-family: inherit;
    font-size: 11px;
    font-weight: 800;

    cursor: pointer;

    transition: all 0.2s ease;
}

.btn-submit-filter:hover {
    transform: translateY(-1px);

    box-shadow:
        0 8px 17px rgba(181, 128, 31, 0.22);
}


/* =========================================================
   13. CLEAR FILTER
   ========================================================= */

.btn-clear-filter {
    height: 43px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 14px;

    color: #606977;

    background: #f6f7f9;

    border: 1px solid #dfe3e8;
    border-radius: 9px;

    text-decoration: none;

    font-family: inherit;
    font-size: 11px;
    font-weight: 750;

    white-space: nowrap;

    cursor: pointer;

    transition: all 0.2s ease;
}

.btn-clear-filter:hover {
    color: #a67821;

    background: #fff9ed;

    border-color: #dfc583;
}


/* =========================================================
   14. TABLE PANEL
   ========================================================= */

.attendance-container .panel-luxury {
    width: 100%;

    padding: 8px;

    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #e4e8ef);
    border-radius: 16px;

    box-shadow:
        0 7px 24px rgba(25, 35, 50, 0.05);

    overflow: hidden;
}


/* =========================================================
   15. TABLE
   ========================================================= */

.attendance-container .luxury-table {
    width: 100%;

    min-width: 760px;

    border-collapse: separate;
    border-spacing: 0;

    color: var(--text, #303744);

    font-size: 11px;
}


/* Header */

.attendance-container .luxury-table thead th {
    height: 48px;

    padding: 0 15px;

    color: #707a89;

    background: var(--table-head, #f7f8fa);

    border-bottom: 1px solid var(--border, #e4e8ef);

    font-size: 10px;
    font-weight: 850;

    text-align: right;
    white-space: nowrap;
}

.attendance-container .luxury-table thead th:first-child {
    border-radius: 0 10px 10px 0;
}

.attendance-container .luxury-table thead th:last-child {
    border-radius: 10px 0 0 10px;
}


/* Body */

.attendance-container .luxury-table tbody tr {
    background: var(--surface, #ffffff);

    transition: background 0.18s ease;
}

.attendance-container .luxury-table tbody tr:hover {
    background: #fffdf8;
}

.attendance-container .luxury-table tbody td {
    height: 59px;

    padding: 8px 15px;

    color: var(--text, #3b4350);

    background: transparent;

    border-bottom: 1px solid var(--border-soft, #edf0f4);

    vertical-align: middle;

    font-weight: 600;
}

.attendance-container .luxury-table tbody tr:last-child td {
    border-bottom: 0;
}


/* Employee name
   Overrides inline color:#fff
*/

.attendance-container .luxury-table tbody td:first-child {
    color: var(--text, #252b35) !important;

    font-weight: 800 !important;
}


/* Date */

.attendance-container .luxury-table tbody td:nth-child(2) {
    color: var(--muted, #6e7785);
}

.attendance-container .luxury-table tbody td:nth-child(2) i {
    color: var(--gold, #c79535) !important;
}


/* =========================================================
   16. STATUS BADGES
   ========================================================= */

.attendance-container .status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 62px;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 10px;
    font-weight: 850;
}


/* Present */

.attendance-container .badge-present {
    color: #12865a;

    background: #e8f8f0;

    border: 1px solid #c4ead8;
}


/* Late */

.attendance-container .badge-late {
    color: #c4871f;

    background: #fff7e3;

    border: 1px solid #eed9a6;
}


/* =========================================================
   17. TIME BOX
   ========================================================= */

.attendance-container .time-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 6px;

    min-width: 82px;

    padding: 7px 10px;

    color: #505966;

    background: #f6f8fa;

    border: 1px solid #e2e6eb;
    border-radius: 8px;

    font-size: 10px;
    font-weight: 800;
}

.attendance-container .time-box i {
    color: #21a96e !important;
}


/* =========================================================
   18. DELETE BUTTON
   ========================================================= */

.attendance-container .btn-action.btn-delete {
    width: 34px;
    height: 34px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    color: #d34a4a;

    background: #fff2f2;

    border: 1px solid #efcccc;
    border-radius: 8px;

    cursor: pointer;

    transition: all 0.18s ease;
}

.attendance-container .btn-action.btn-delete:hover {
    color: #ffffff;

    background: #d44949;

    border-color: #d44949;

    transform: translateY(-1px);
}


/* =========================================================
   19. EMPTY STATE
   ========================================================= */

.attendance-container .luxury-table .empty-state,
.attendance-container .luxury-table tbody tr:has(td[colspan]) {
    background: var(--surface, #ffffff);
}

.attendance-container .luxury-table tbody tr:has(td[colspan]) td {
    color: var(--muted, #858e9b) !important;
}

.attendance-container .luxury-table tbody tr:has(td[colspan]) td i {
    color: var(--gold-line, #d4a441) !important;
}


/* =========================================================
   20. PAGINATION
   ========================================================= */

.attendance-container > div:last-of-type {
    direction: rtl;
}

.attendance-container .pagination {
    display: flex;

    align-items: center;
    justify-content: flex-start;

    gap: 5px;

    margin: 0;
    padding: 0;

    list-style: none;
}

.attendance-container .pagination .page-link {
    min-width: 34px;
    height: 34px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 9px;

    color: #68717f;

    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #dfe4eb);
    border-radius: 8px;

    font-size: 10px;
    font-weight: 750;

    text-decoration: none;

    transition: all 0.18s ease;
}

.attendance-container .pagination .page-link:hover {
    color: #a67821;

    background: #fff9ed;

    border-color: #dfc583;
}

.attendance-container .pagination .active .page-link {
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #d4a23e,
        #b77f21
    );

    border-color: #bd8a2b;
}


/* =========================================================
   21. MODAL OVERLAY
   ========================================================= */

#addManualModal {
    direction: rtl;

    background: rgba(10, 14, 20, 0.62) !important;

    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}


/* =========================================================
   22. MODAL BOX
   ========================================================= */

#addManualModal > div {
    width: min(500px, calc(100vw - 30px)) !important;

    max-height: calc(100vh - 40px);

    overflow-y: auto;

    padding: 24px !important;

    background: #ffffff !important;

    border: 1px solid #e5d3a4 !important;
    border-radius: 17px !important;

    box-shadow:
        0 20px 60px rgba(20, 25, 35, 0.25) !important;

    animation: eliteModalIn 0.2s ease-out;
}

@keyframes eliteModalIn {
    from {
        opacity: 0;
        transform: translateY(10px) scale(0.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}


/* =========================================================
   23. MODAL HEADER
   ========================================================= */

#addManualModal > div > div:first-child {
    margin-bottom: 20px !important;

    padding-bottom: 13px !important;

    border-bottom: 1px solid #eee5d0 !important;
}

#addManualModal h3 {
    color: #252b35 !important;

    font-size: 15px !important;
    font-weight: 850 !important;
}

#addManualModal h3 i {
    color: #bf8b29 !important;
}

#addManualModal > div > div:first-child button {
    color: #89919d !important;

    transition: color 0.18s ease;
}

#addManualModal > div > div:first-child button:hover {
    color: #d04b4b !important;
}


/* =========================================================
   24. MODAL FORM
   ========================================================= */

#addManualModal .form-group-luxury label {
    color: #4b5360;
}

#addManualModal .input-luxury {
    height: 44px;

    color: #252b35;

    background: #fbfcfd;

    border-color: #dfe4eb;
}

#addManualModal .input-luxury:focus {
    background: #ffffff;

    border-color: #c79637;

    box-shadow:
        0 0 0 3px rgba(199, 150, 55, 0.10);
}


/* =========================================================
   25. MODAL ACTIONS
   ========================================================= */

#addManualModal .btn-clear-filter {
    height: 40px !important;
}

#addManualModal .btn-submit-filter {
    height: 40px !important;
}


/* =========================================================
   =========================================================
   DARK MODE
   =========================================================
   ========================================================= */


/* =========================================================
   26. DARK - HEADER
   ========================================================= */

[data-theme="dark"] .attendance-container .page-header,
.dark-mode .attendance-container .page-header,
body.dark .attendance-container .page-header {
    background: #121720;

    border-color: #29313d;

    box-shadow:
        0 8px 28px rgba(0, 0, 0, 0.23);
}

[data-theme="dark"] .attendance-container .page-header-title,
.dark-mode .attendance-container .page-header-title,
body.dark .attendance-container .page-header-title {
    color: #f0f2f5;
}

[data-theme="dark"] .attendance-container .page-header span,
.dark-mode .attendance-container .page-header span,
body.dark .attendance-container .page-header span {
    color: #7f8998 !important;
}


/* =========================================================
   27. DARK - STATS
   ========================================================= */

[data-theme="dark"] .attendance-container .stat-card-luxury,
.dark-mode .attendance-container .stat-card-luxury,
body.dark .attendance-container .stat-card-luxury {
    background: #121720;

    border-color: #29313d;

    box-shadow:
        0 8px 26px rgba(0, 0, 0, 0.20);
}

[data-theme="dark"] .attendance-container .stat-card-luxury:hover,
.dark-mode .attendance-container .stat-card-luxury:hover,
body.dark .attendance-container .stat-card-luxury:hover {
    border-color: rgba(210, 158, 55, 0.30);

    background: #141a23;
}

[data-theme="dark"] .attendance-container .stat-card-luxury .info h4,
.dark-mode .attendance-container .stat-card-luxury .info h4,
body.dark .attendance-container .stat-card-luxury .info h4 {
    color: #808a99;
}

[data-theme="dark"] .attendance-container .stat-card-luxury .info p,
.dark-mode .attendance-container .stat-card-luxury .info p,
body.dark .attendance-container .stat-card-luxury .info p {
    color: #f0f2f5;
}


/* =========================================================
   28. DARK - FILTER
   ========================================================= */

[data-theme="dark"] .attendance-container .filter-panel,
.dark-mode .attendance-container .filter-panel,
body.dark .attendance-container .filter-panel {
    background: #121720;

    border-color: #29313d;

    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.20);
}

[data-theme="dark"] .attendance-container .form-group-luxury label,
.dark-mode .attendance-container .form-group-luxury label,
body.dark .attendance-container .form-group-luxury label {
    color: #c6ccd5;
}

[data-theme="dark"] .attendance-container .input-luxury,
.dark-mode .attendance-container .input-luxury,
body.dark .attendance-container .input-luxury {
    color: #e1e5eb;

    background: #181e27;

    border-color: #323b48;
}

[data-theme="dark"] .attendance-container .input-luxury:hover,
.dark-mode .attendance-container .input-luxury:hover,
body.dark .attendance-container .input-luxury:hover {
    border-color: #9d762e;
}

[data-theme="dark"] .attendance-container .input-luxury:focus,
.dark-mode .attendance-container .input-luxury:focus,
body.dark .attendance-container .input-luxury:focus {
    background: #1b222b;

    border-color: #c79738;

    box-shadow:
        0 0 0 3px rgba(199, 151, 56, 0.10);
}

[data-theme="dark"] .attendance-container select.input-luxury option,
.dark-mode .attendance-container select.input-luxury option,
body.dark select.input-luxury option {
    color: #e6e9ee;
    background: #181e27;
}


/* =========================================================
   29. DARK - CLEAR BUTTON
   ========================================================= */

[data-theme="dark"] .btn-clear-filter,
.dark-mode .btn-clear-filter,
body.dark .btn-clear-filter {
    color: #b7bec8;

    background: #1a2029;

    border-color: #323b48;
}

[data-theme="dark"] .btn-clear-filter:hover,
.dark-mode .btn-clear-filter:hover,
body.dark .btn-clear-filter:hover {
    color: #dfaa43;

    background: rgba(210, 158, 55, 0.08);

    border-color: rgba(210, 158, 55, 0.28);
}


/* =========================================================
   30. DARK - TABLE PANEL
   ========================================================= */

[data-theme="dark"] .attendance-container .panel-luxury,
.dark-mode .attendance-container .panel-luxury,
body.dark .attendance-container .panel-luxury {
    background: #121720;

    border-color: #29313d;

    box-shadow:
        0 9px 28px rgba(0, 0, 0, 0.24);
}


/* =========================================================
   31. DARK - TABLE
   ========================================================= */

/*
   مهم جداً:
   هذا الجزء يحل مشكلة الصفوف البيضاء التي ظهرت
   عندك في جدول اللاعبين.
*/

[data-theme="dark"] .attendance-container .luxury-table,
[data-theme="dark"] .attendance-container .luxury-table tbody,
[data-theme="dark"] .attendance-container .luxury-table tbody tr,
[data-theme="dark"] .attendance-container .luxury-table tbody td,
.dark-mode .attendance-container .luxury-table,
.dark-mode .attendance-container .luxury-table tbody,
.dark-mode .attendance-container .luxury-table tbody tr,
.dark-mode .attendance-container .luxury-table tbody td,
body.dark .attendance-container .luxury-table,
body.dark .attendance-container .luxury-table tbody,
body.dark .attendance-container .luxury-table tbody tr,
body.dark .attendance-container .luxury-table tbody td {
    background: #121720 !important;
}

[data-theme="dark"] .attendance-container .luxury-table thead th,
.dark-mode .attendance-container .luxury-table thead th,
body.dark .attendance-container .luxury-table thead th {
    color: #8d97a6;

    background: #191f28 !important;

    border-bottom-color: #2d3642;
}

[data-theme="dark"] .attendance-container .luxury-table tbody td,
.dark-mode .attendance-container .luxury-table tbody td,
body.dark .attendance-container .luxury-table tbody td {
    color: #cbd1da !important;

    border-bottom-color: #29313d;
}

[data-theme="dark"] .attendance-container .luxury-table tbody tr:hover td,
.dark-mode .attendance-container .luxury-table tbody tr:hover td,
body.dark .attendance-container .luxury-table tbody tr:hover td {
    background: rgba(210, 158, 55, 0.045) !important;
}


/* Employee name */

[data-theme="dark"] .attendance-container .luxury-table tbody td:first-child,
.dark-mode .attendance-container .luxury-table tbody td:first-child,
body.dark .attendance-container .luxury-table tbody td:first-child {
    color: #edf0f5 !important;
}


/* Date */

[data-theme="dark"] .attendance-container .luxury-table tbody td:nth-child(2),
.dark-mode .attendance-container .luxury-table tbody td:nth-child(2),
body.dark .attendance-container .luxury-table tbody td:nth-child(2) {
    color: #aeb6c1 !important;
}


/* =========================================================
   32. DARK - STATUS
   ========================================================= */

[data-theme="dark"] .attendance-container .badge-present,
.dark-mode .attendance-container .badge-present,
body.dark .attendance-container .badge-present {
    color: #43d89a;

    background: rgba(25, 157, 100, 0.10);

    border-color: rgba(25, 157, 100, 0.24);
}

[data-theme="dark"] .attendance-container .badge-late,
.dark-mode .attendance-container .badge-late,
body.dark .attendance-container .badge-late {
    color: #e2aa42;

    background: rgba(210, 158, 55, 0.09);

    border-color: rgba(210, 158, 55, 0.24);
}


/* =========================================================
   33. DARK - TIME
   ========================================================= */

[data-theme="dark"] .attendance-container .time-box,
.dark-mode .attendance-container .time-box,
body.dark .attendance-container .time-box {
    color: #c5cbd4;

    background: #1a2029;

    border-color: #303946;
}


/* =========================================================
   34. DARK - DELETE
   ========================================================= */

[data-theme="dark"] .attendance-container .btn-action.btn-delete,
.dark-mode .attendance-container .btn-action.btn-delete,
body.dark .attendance-container .btn-action.btn-delete {
    color: #ff7272;

    background: rgba(210, 65, 65, 0.09);

    border-color: rgba(210, 65, 65, 0.23);
}

[data-theme="dark"] .attendance-container .btn-action.btn-delete:hover,
.dark-mode .attendance-container .btn-action.btn-delete:hover,
body.dark .attendance-container .btn-action.btn-delete:hover {
    color: #ffffff;

    background: #c94545;

    border-color: #c94545;
}


/* =========================================================
   35. DARK - EMPTY
   ========================================================= */

[data-theme="dark"] .attendance-container .luxury-table tbody tr:has(td[colspan]),
.dark-mode .attendance-container .luxury-table tbody tr:has(td[colspan]),
body.dark .attendance-container .luxury-table tbody tr:has(td[colspan]) {
    background: #121720 !important;
}

[data-theme="dark"] .attendance-container .luxury-table tbody tr:has(td[colspan]) td,
.dark-mode .attendance-container .luxury-table tbody tr:has(td[colspan]) td,
body.dark .attendance-container .luxury-table tbody tr:has(td[colspan]) td {
    color: #7e8897 !important;
}


/* =========================================================
   36. DARK - PAGINATION
   ========================================================= */

[data-theme="dark"] .attendance-container .pagination .page-link,
.dark-mode .attendance-container .pagination .page-link,
body.dark .attendance-container .pagination .page-link {
    color: #b8c0ca;

    background: #181e27;

    border-color: #303946;
}

[data-theme="dark"] .attendance-container .pagination .page-link:hover,
.dark-mode .attendance-container .pagination .page-link:hover,
body.dark .attendance-container .pagination .page-link:hover {
    color: #dfaa43;

    background: rgba(210, 158, 55, 0.08);

    border-color: rgba(210, 158, 55, 0.28);
}


/* =========================================================
   37. DARK - MODAL
   ========================================================= */

[data-theme="dark"] #addManualModal > div,
.dark-mode #addManualModal > div,
body.dark #addManualModal > div {
    background: #171d26 !important;

    border-color: rgba(210, 158, 55, 0.30) !important;

    box-shadow:
        0 25px 70px rgba(0, 0, 0, 0.55) !important;
}

[data-theme="dark"] #addManualModal h3,
.dark-mode #addManualModal h3,
body.dark #addManualModal h3 {
    color: #eef1f5 !important;
}

[data-theme="dark"] #addManualModal > div > div:first-child,
.dark-mode #addManualModal > div > div:first-child,
body.dark #addManualModal > div > div:first-child {
    border-bottom-color: #303946 !important;
}

[data-theme="dark"] #addManualModal .form-group-luxury label,
.dark-mode #addManualModal .form-group-luxury label,
body.dark #addManualModal .form-group-luxury label {
    color: #c5cbd4;
}

[data-theme="dark"] #addManualModal .input-luxury,
.dark-mode #addManualModal .input-luxury,
body.dark #addManualModal .input-luxury {
    color: #e5e8ed;

    background: #11161e;

    border-color: #323b48;
}

[data-theme="dark"] #addManualModal .input-luxury:focus,
.dark-mode #addManualModal .input-luxury:focus,
body.dark #addManualModal .input-luxury:focus {
    background: #151b24;

    border-color: #c79738;
}

[data-theme="dark"] #addManualModal select.input-luxury option,
.dark-mode #addManualModal select.input-luxury option,
body.dark #addManualModal select.input-luxury option {
    color: #e5e8ed;
    background: #171d26;
}


/* =========================================================
   38. MOBILE
   ========================================================= */

@media (max-width: 1100px) {

    .attendance-container .filter-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .attendance-container .filter-grid > div:last-child {
        grid-column: span 2;
    }
}


@media (max-width: 750px) {

    .attendance-container .page-header {
        align-items: stretch;

        flex-direction: column;

        padding: 18px;
    }

    .attendance-container .page-header > div {
        padding-right: 10px;
    }

    .btn-add-manual {
        width: 100%;
    }

    .attendance-container .stats-grid {
        grid-template-columns: 1fr;
    }

    .attendance-container .filter-grid {
        grid-template-columns: 1fr;
    }

    .attendance-container .filter-grid > div:last-child {
        grid-column: span 1;
    }

    .attendance-container .panel-luxury {
        padding: 6px;
    }
}


@media (max-width: 500px) {

    .attendance-container .page-header-title {
        font-size: 17px;
    }

    .attendance-container .page-header span {
        font-size: 11px !important;
    }

    .attendance-container .stat-card-luxury {
        min-height: 92px;
        padding: 16px;
    }

    .attendance-container .stat-card-luxury .info p {
        font-size: 22px;
    }

    .attendance-container .stat-card-luxury .icon-box {
        width: 42px;
        height: 42px;
    }

    #addManualModal > div {
        width: calc(100vw - 24px) !important;

        padding: 18px !important;
    }
}
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper attendance-container">
        <div style="margin-bottom: 18px;">
            <x-flash-message />
        </div>

        <div class="page-header">
            <div>
                <h2 class="page-header-title">تقارير حضور وانصراف المدربين</h2>
                <span style="color: var(--muted); font-size: 13px;">تتبع ومراقبة الأداء الزمني وساعات العمل الفعلية للموظفين
                    والمدربين</span>
            </div>
            <button class="btn-add-manual" onclick="toggleModal('addManualModal')">
                <i class="fas fa-plus"></i> تسجيل حضور يدوي موظف
            </button>
        </div>

        <div class="stats-grid">
            <div class="stat-card-luxury">
                <div class="info">
                    <h4>حاضرين اليوم</h4>
                    <p>{{ $stats['total_present'] }}</p>
                </div>
                <div class="icon-box" style="background: rgba(74, 222, 128, 0.1); color: var(--success);">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-card-luxury">
                <div class="info">
                    <h4>حالات التأخير اليوم</h4>
                    <p>{{ $stats['total_late'] }}</p>
                </div>
                <div class="icon-box" style="background: rgba(251, 191, 36, 0.1); color: var(--warning);">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
        </div>

        <div class="filter-panel">
            <form action="{{ route('admin.attendance.employees.index') }}" method="GET">
                <div class="filter-grid">
                    <div class="form-group-luxury">
                        <label>الموظف / المدرب</label>
                        <select name="employee_id" class="input-luxury">
                            <option value="">كل الموظفين</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-luxury">
                        <label>الحالة</label>
                        <select name="status" class="input-luxury">
                            <option value="">كل الحالات</option>
                            <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>حاضر (Present)
                            </option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>متأخر (Late)</option>
                        </select>
                    </div>

                    <div class="form-group-luxury">
                        <label>من تاريخ</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="input-luxury">
                    </div>

                    <div class="form-group-luxury">
                        <label>إلى تاريخ</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="input-luxury">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-submit-filter" style="flex: 1;">
                            <i class="fas fa-filter"></i> فلترة
                        </button>
                        <a href="{{ route('admin.attendance.employees.index') }}" class="btn-clear-filter">إعادة تعيين</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel-luxury">
            <div style="overflow-x: auto;">
                <table class="luxury-table">
                    <thead>
                        <tr>
                            <th>اسم الموظف / المدرب</th>
                            <th>تاريخ اليوم</th>
                            <th>حالة الحضور</th>
                            <th style="text-align: center;">وقت الحضور</th>
                            <th style="text-align: center;">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td style="font-weight: 700; color: #fff;">{{ $log->employee->name }}</td>
                                <td><i class="far fa-calendar-alt"
                                        style="margin-left: 6px; color: var(--gold);"></i>{{ $log->attendance_date->format('Y-m-d') }}
                                </td>
                                <td>
                                    @if ($log->status == 'present')
                                        <span class="status-badge badge-present">حاضر</span>
                                    @elseif($log->status == 'late')
                                        <span class="status-badge badge-late">متأخر</span>
                                    @else
                                        <span class="status-badge badge-present">{{ $log->status }}</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <span class="time-box"><i class="far fa-clock"
                                            style="color: var(--success);"></i>{{ $log->recorded_at ? $log->recorded_at->format('H:i A') : '---' }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.attendance.employees.destroy', $log->id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا السجل نهائياً؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="حذف السجل"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 50px; color: var(--muted);">
                                    <i class="fas fa-clipboard-user fa-2x"
                                        style="display: block; margin-bottom: 12px; color: var(--gold-line);"></i>
                                    لا توجد سجلات حضور مطابقة للفلاتر المحددة.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div style="margin-top: 15px;">
            {{ $logs->links() }}
        </div>
    </div>

    <div id="addManualModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center;">
        <div
            style="background: var(--surface); border: 1px solid var(--gold-line); border-radius: 16px; width: 500px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--gold-soft); padding-bottom: 10px;">
                <h3 style="margin: 0; color: #fff; font-size: 16px;"><i class="fas fa-user-plus"
                        style="color:var(--gold); margin-left: 8px;"></i>تسجيل قيد حضور يدوي</h3>
                <button onclick="toggleModal('addManualModal')"
                    style="background:none; border:none; color:var(--muted); cursor:pointer; font-size: 18px;"><i
                        class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('admin.attendance.employees.store') }}" method="POST">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div class="form-group-luxury">
                        <label>اختر الموظف / المدرب</label>
                        <select name="employee_id" class="input-luxury" required>
                            <option value="">اختر موظف...</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-luxury">
                        <label>تاريخ الحضور</label>
                        <input type="date" name="attendance_date" value="{{ date('Y-m-d') }}"
                            max="{{ date('Y-m-d') }}" class="input-luxury" required>
                    </div>
                    <div class="form-group-luxury">
                        <label>وقت الحضور</label>
                        <input type="time" name="recorded_at" class="input-luxury" required>
                    </div>
                    <div class="form-group-luxury">
                        <label>حالة التواجد</label>
                        <select name="status" class="input-luxury" required>
                            <option value="present">حاضر في الوقت (Present)</option>
                            <option value="late">متأخر عن الوردية (Late)</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px; justify-content: flex-end;">
                        <button type="button" onclick="toggleModal('addManualModal')" class="btn-clear-filter"
                            style="padding: 8px 16px;">إلغاء</button>
                        <button type="submit" class="btn-submit-filter" style="padding: 8px 24px;">حفظ السجل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
