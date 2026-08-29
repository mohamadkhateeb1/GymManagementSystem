@extends('Admin.layouts.app')

@section('title', 'تعديل بيانات الموظف | Elite Club')

@section('styles')

<style>
/* =========================================================
   ELITE CLUB — EDIT EMPLOYEE
   ========================================================= */

.employee-form-wrapper {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    direction: rtl;
}


/* =========================================================
   PAGE HEADER
   ========================================================= */

.employee-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;
}

.employee-heading {
    display: flex;
    align-items: center;

    gap: 12px;

    min-width: 0;
}

.employee-heading-accent {
    width: 4px;
    height: 43px;

    flex: 0 0 4px;

    border-radius: 99px;

    background:
        linear-gradient(
            180deg,
            var(--gold-light),
            var(--gold-dark)
        );
}

.employee-heading-icon {
    width: 43px;
    height: 43px;

    flex: 0 0 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(184, 146, 62, .18);
    border-radius: 11px;

    background: var(--sidebar-active);
    color: var(--gold-dark);

    font-size: 16px;
}

.employee-title {
    color: var(--text);

    font-size: 20px;
    font-weight: 900;

    line-height: 1.3;
}

.employee-title-name {
    color: var(--gold-dark);

    font-weight: 900;
}

html[data-theme="dark"]
.employee-title-name {
    color: var(--gold-light);
}

.employee-subtitle {
    margin-top: 5px;

    color: var(--muted);

    font-size: 11px;
}


/* =========================================================
   BACK
   ========================================================= */

.employee-back {
    min-height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 8px 14px;

    border: 1px solid var(--border);
    border-radius: 9px;

    background: var(--surface);
    color: var(--text-soft);

    font-family: 'Tajawal', sans-serif;

    font-size: 11px;
    font-weight: 700;

    white-space: nowrap;

    transition: .2s ease;
}

.employee-back:hover {
    color: var(--gold-dark);

    border-color: rgba(184, 146, 62, .30);

    background: var(--surface-hover);

    transform: translateY(-1px);
}


/* =========================================================
   CARD
   ========================================================= */

.employee-form-card {
    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 14px;

    background: var(--surface);

    box-shadow: var(--shadow-sm);
}


/* =========================================================
   CARD HEADER
   ========================================================= */

.employee-card-header {
    min-height: 60px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 20px;

    border-bottom: 1px solid var(--border-soft);

    background: var(--surface-2);
}

.employee-card-heading {
    color: var(--text);

    font-size: 13px;
    font-weight: 800;
}

.employee-card-hint {
    color: var(--muted);

    font-size: 10px;
}


/* =========================================================
   BODY
   ========================================================= */

.employee-form-body {
    padding: 25px;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .employee-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .employee-back {
        width: 100%;
    }

    .employee-form-body {
        padding: 18px;
    }

    .employee-title {
        font-size: 17px;
    }
}

@media (max-width: 480px) {

    .employee-heading-icon {
        width: 39px;
        height: 39px;
        flex-basis: 39px;
    }

    .employee-heading-accent {
        height: 39px;
    }

    .employee-card-hint {
        display: none;
    }

    .employee-card-header {
        padding: 0 15px;
    }
}
</style>

@endsection

@section('content')

<div class="employee-form-wrapper">

```
<div class="employee-page-header">

    <div class="employee-heading">

        <div class="employee-heading-accent"></div>

        <div class="employee-heading-icon">
            <i class="fas fa-user-pen"></i>
        </div>

        <div>
            <div class="employee-title">
                تعديل الموظف:
                <span class="employee-title-name">
                    {{ $employee->username }}
                </span>
            </div>

            <div class="employee-subtitle">
                قم بتحديث بيانات الموظف ثم احفظ التغييرات
            </div>
        </div>

    </div>

    <a href="{{ route('employees.index') }}" class="employee-back">
        <i class="fas fa-arrow-right"></i>
        العودة للقائمة
    </a>

</div>


<div class="employee-form-card">

    <div class="employee-card-header">

        <div class="employee-card-heading">
            تحديث بيانات الموظف
        </div>

        <div class="employee-card-hint">
            التعديلات ستُحفظ مباشرة
        </div>

    </div>


    <div class="employee-form-body">

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('Admin.Employees._form')

            <button type="submit" class="employee-submit">
                <i class="fas fa-floppy-disk"></i>
                تحديث بيانات الموظف
            </button>

        </form>

    </div>

</div>
```

</div>

@endsection
