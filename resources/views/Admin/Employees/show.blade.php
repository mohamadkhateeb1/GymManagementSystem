@extends('Admin.layouts.app')

@section('title', 'ملف الموظف | Elite Club')

@section('styles')
<style>

/* =========================================================
   ELITE CLUB — EMPLOYEE PROFILE
   ========================================================= */

.employee-page {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    direction: rtl;
}


/* =========================================================
   HEADER
   ========================================================= */

.employee-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 22px;
}

.employee-page-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.employee-page-title-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(184, 146, 62, .20);
    border-radius: 11px;

    background: var(--sidebar-active);
    color: var(--gold-dark);

    font-size: 17px;
}

.employee-page-title-text h1 {
    margin: 0;

    color: var(--text);

    font-size: 20px;
    font-weight: 900;
}

.employee-page-title-text p {
    margin: 4px 0 0;

    color: var(--muted);

    font-size: 11px;
}


/* =========================================================
   MAIN PROFILE CARD
   ========================================================= */

.employee-profile-card {
    overflow: hidden;

    border: 1px solid var(--border);
    border-radius: 16px;

    background: var(--surface);

    box-shadow: var(--shadow-sm);
}


/* =========================================================
   PROFILE TOP
   ========================================================= */

.employee-profile-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;

    padding: 24px 26px;

    border-bottom: 1px solid var(--border-soft);

    background:
        linear-gradient(
            180deg,
            var(--surface-2),
            var(--surface)
        );
}

.employee-profile-info {
    display: flex;
    align-items: center;

    gap: 15px;
}

.employee-avatar {
    width: 64px;
    height: 64px;

    flex: 0 0 64px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );

    color: #fff;

    font-size: 23px;

    box-shadow:
        0 7px 18px rgba(184, 146, 62, .16);
}

.employee-name {
    margin: 0;

    color: var(--text);

    font-size: 19px;
    font-weight: 900;
}

.employee-specialization {
    margin: 6px 0 0;

    color: var(--muted);

    font-size: 11px;
}

.employee-email {
    margin-top: 5px;

    color: var(--muted);

    font-size: 10.5px;
}


/* =========================================================
   STATUS
   ========================================================= */

.employee-status {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 8px 12px;

    border: 1px solid rgba(184, 146, 62, .18);
    border-radius: 8px;

    background: rgba(184, 146, 62, .06);

    color: var(--gold-dark);

    font-size: 10px;
    font-weight: 800;

    white-space: nowrap;
}

.employee-status-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: var(--gold);
}


/* =========================================================
   INFORMATION SECTION
   ========================================================= */

.employee-information {
    padding: 25px 26px;
}

.employee-section-title {
    display: flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 15px;

    color: var(--text);

    font-size: 13px;
    font-weight: 900;
}

.employee-section-title::before {
    content: "";

    width: 3px;
    height: 17px;

    border-radius: 99px;

    background:
        linear-gradient(
            180deg,
            var(--gold-light),
            var(--gold-dark)
        );
}


/* =========================================================
   DATA GRID
   ========================================================= */

.employee-data-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 12px;
}

.employee-data-box {
    min-height: 72px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    padding: 13px 15px;

    border: 1px solid var(--border);

    border-radius: 10px;

    background: var(--surface-2);

    transition: .2s ease;
}

.employee-data-box:hover {
    border-color: rgba(184, 146, 62, .28);

    background: var(--surface);
}

.employee-data-label {
    display: flex;
    align-items: center;

    gap: 7px;

    margin-bottom: 7px;

    color: var(--muted);

    font-size: 10px;
    font-weight: 700;
}

.employee-data-label i {
    color: var(--gold);

    font-size: 10px;
}

.employee-data-value {
    color: var(--text);

    font-size: 12px;
    font-weight: 700;

    word-break: break-word;
}


/* =========================================================
   2FA STATUS
   ========================================================= */

.employee-2fa {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    font-size: 11px;
    font-weight: 800;
}

.employee-2fa.active {
    color: #23845b;
}

.employee-2fa.inactive {
    color: #b34b4b;
}


/* =========================================================
   FOOTER
   ========================================================= */

.employee-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 18px 26px;

    border-top: 1px solid var(--border-soft);

    background: var(--surface-2);
}

.employee-footer-note {
    color: var(--muted);

    font-size: 10px;
}

.employee-edit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-width: 145px;

    padding: 10px 18px;

    border: 1px solid var(--gold-dark);

    border-radius: 8px;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );

    color: #fff;

    font-size: 11px;
    font-weight: 800;

    text-decoration: none;

    box-shadow:
        0 5px 14px rgba(184, 146, 62, .14);

    transition: .2s ease;
}

.employee-edit-button:hover {
    transform: translateY(-1px);

    box-shadow:
        0 8px 18px rgba(184, 146, 62, .20);

    color: #fff;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .employee-page {
        width: 100%;
    }

    .employee-page-header {
        align-items: flex-start;
    }

    .employee-page-title-text h1 {
        font-size: 17px;
    }

    .employee-profile-top {
        align-items: flex-start;

        flex-direction: column;

        padding: 20px;
    }

    .employee-status {
        align-self: flex-start;
    }

    .employee-information {
        padding: 20px;
    }

    .employee-data-grid {
        grid-template-columns: 1fr;
    }

    .employee-card-footer {
        align-items: stretch;

        flex-direction: column;

        padding: 18px 20px;
    }

    .employee-edit-button {
        width: 100%;
    }
}


/* =========================================================
   SMALL MOBILE
   ========================================================= */

@media (max-width: 480px) {

    .employee-page-title-icon {
        width: 40px;
        height: 40px;
    }

    .employee-profile-info {
        align-items: flex-start;
    }

    .employee-avatar {
        width: 55px;
        height: 55px;

        flex-basis: 55px;
    }

    .employee-name {
        font-size: 16px;
    }

    .employee-email {
        font-size: 10px;
    }
}

</style>
@endsection


@section('content')

<div class="employee-page">


    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="employee-page-header">

        <div class="employee-page-title">

            <div class="employee-page-title-icon">
                <i class="fas fa-user-tie"></i>
            </div>

            <div class="employee-page-title-text">

                <h1>
                    ملف الموظف
                </h1>

                <p>
                    عرض معلومات وبيانات الموظف
                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PROFILE CARD
    ====================================================== --}}

    <div class="employee-profile-card">


        {{-- =================================================
             PROFILE HEADER
        ================================================== --}}

        <div class="employee-profile-top">

            <div class="employee-profile-info">

                <div class="employee-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>


                <div>

                    <h2 class="employee-name">
                        {{ $employee->name }}
                    </h2>

                    <div class="employee-specialization">
                        {{ $employee->specialization }}
                    </div>

                    <div class="employee-email">
                        {{ $employee->email }}
                    </div>

                </div>

            </div>


            {{-- STATUS --}}

            <div class="employee-status">

                <span class="employee-status-dot"></span>

                موظف في النظام

            </div>

        </div>


        {{-- =================================================
             INFORMATION
        ================================================== --}}

        <div class="employee-information">

            <div class="employee-section-title">
                المعلومات الأساسية
            </div>


            <div class="employee-data-grid">


                {{-- EMAIL --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-envelope"></i>

                        البريد الإلكتروني

                    </div>

                    <div class="employee-data-value">
                        {{ $employee->email }}
                    </div>

                </div>


                {{-- SPECIALIZATION --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-briefcase"></i>

                        التخصص

                    </div>

                    <div class="employee-data-value">
                        {{ $employee->specialization }}
                    </div>

                </div>


                {{-- 2FA --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-shield-alt"></i>

                        المصادقة الثنائية

                    </div>

                    <div class="employee-data-value">

                        @if($employee->two_factor_confirmed_at)

                            <span class="employee-2fa active">
                                <i class="fas fa-check-circle"></i>
                                مفعلة
                            </span>

                        @else

                            <span class="employee-2fa inactive">
                                <i class="fas fa-times-circle"></i>
                                غير مفعلة
                            </span>

                        @endif

                    </div>

                </div>


                {{-- JOIN DATE --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-calendar-alt"></i>

                        تاريخ الانضمام

                    </div>

                    <div class="employee-data-value">

                        {{ $employee->created_at->format('Y-m-d') }}

                    </div>

                </div>


                {{-- UPDATED --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-history"></i>

                        آخر تحديث

                    </div>

                    <div class="employee-data-value">

                        {{ $employee->updated_at->diffForHumans() }}

                    </div>

                </div>


                {{-- EMPLOYEE ID --}}

                <div class="employee-data-box">

                    <div class="employee-data-label">

                        <i class="fas fa-id-card"></i>

                        رقم الموظف

                    </div>

                    <div class="employee-data-value">

                        #{{ $employee->id }}

                    </div>

                </div>


            </div>

        </div>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="employee-card-footer">

            <div class="employee-footer-note">

                <i class="fas fa-info-circle"></i>

                يمكنك تعديل بيانات الموظف من خلال صفحة التعديل.

            </div>


            <a
                href="{{ route('employees.edit', $employee->id) }}"
                class="employee-edit-button"
            >

                <i class="fas fa-edit"></i>

                تعديل الملف الشخصي

            </a>

        </div>


    </div>

</div>

@endsection