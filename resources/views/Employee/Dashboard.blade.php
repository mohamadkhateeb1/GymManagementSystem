 @extends('Employee.Layouts.app')

 @section('title', 'لوحة تحكم الموظف | Elite Club')

 @section('content')
     <div class="dashboard-wrapper">
         <div class="header">
             <div class="header-titles">
                 <div class="header-eyebrow"><i class="fas fa-crown"></i> Elite Club</div>
                 <div class="header-title">لوحة تحكم المدرب</div>
                 <div class="header-sub">أهلاً بك يا كابتن {{ auth()->guard('employee')->user()->name }}</div>
             </div>
             <div class="header-emblem"><i class="fas fa-medal"></i></div>
         </div>

         <div class="card">
             <div class="panel-head">
                 <h3><i class="fas fa-chart-line"></i> ملخص الأداء</h3>
             </div>
             <div class="empty-state">
                 <div class="empty-icon"><i class="fas fa-chart-line"></i></div>
                 <div class="empty-title">مرحباً بك في لوحة تحكم المدرب</div>
                 <div class="empty-sub">ابدأ بمتابعة اللاعبين المخصصين لك من القائمة الجانبية</div>
             </div>
         </div>
     </div>
 @endsection

 @push('styles')
     <style>
         .dashboard-wrapper {
             max-width: 1200px;
             margin: auto;
         }

         .dashboard-wrapper .header,
         .dashboard-wrapper .card {
             opacity: 0;
             transform: translateY(14px);
             animation: dash-rise .55s cubic-bezier(.2, .7, .2, 1) forwards;
         }

         .dashboard-wrapper .header {
             animation-delay: .05s;
         }

         .dashboard-wrapper .card {
             animation-delay: .15s;
         }

         @keyframes dash-rise {
             to {
                 opacity: 1;
                 transform: translateY(0);
             }
         }

         .header {
             display: flex;
             justify-content: space-between;
             align-items: center;
             gap: 20px;
             margin-bottom: 28px;
             padding: 24px 26px;
             border-radius: 16px;
             border: 1px solid var(--gold-line);
             background:
                 radial-gradient(120% 160% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 50%),
                 var(--surface);
         }

         .header-eyebrow {
             display: inline-flex;
             align-items: center;
             gap: 7px;
             font-size: 12px;
             font-weight: 700;
             letter-spacing: .5px;
             color: var(--gold);
             margin-bottom: 8px;
         }

         .header-title {
             font-size: 26px;
             font-weight: 800;
             color: var(--text);
             line-height: 1.2;
         }

         .header-sub {
             font-size: 15px;
             color: var(--muted);
             margin-top: 6px;
         }

         .header-emblem {
             flex-shrink: 0;
             width: 60px;
             height: 60px;
             display: grid;
             place-items: center;
             font-size: 24px;
             color: var(--gold);
             background: var(--gold-soft);
             border: 1px solid var(--gold-line);
             border-radius: 16px;
         }

         .card {
             background: var(--surface);
             padding: 8px 24px 28px;
             border-radius: 16px;
             border: 1px solid rgba(255, 255, 255, 0.05);
         }

         .panel-head {
             padding: 18px 0;
             border-bottom: 1px solid var(--gold-soft);
             margin-bottom: 8px;
         }

         .panel-head h3 {
             margin: 0;
             display: flex;
             align-items: center;
             gap: 10px;
             font-size: 17px;
             font-weight: 700;
             color: var(--text);
         }

         .panel-head h3 i {
             color: var(--gold);
         }

         /* ===== حالة فارغة ===== */
         .empty-state {
             text-align: center;
             padding: 48px 20px 32px;
             color: var(--muted);
         }

         .empty-icon {
             width: 84px;
             height: 84px;
             margin: 0 auto 20px;
             display: grid;
             place-items: center;
             font-size: 32px;
             color: var(--gold);
             background: var(--gold-soft);
             border-radius: 50%;
             box-shadow: 0 0 0 10px rgba(201, 169, 97, 0.05);
         }

         .empty-title {
             font-size: 21px;
             font-weight: 700;
             color: var(--text);
             margin-bottom: 8px;
         }

         .empty-sub {
             font-size: 14.5px;
             color: var(--muted);
         }

         @media (max-width: 640px) {
             .header {
                 flex-direction: column;
                 align-items: flex-start;
             }

             .header-emblem {
                 display: none;
             }

             .header-title {
                 font-size: 22px;
             }
         }
     </style>
 @endpush
