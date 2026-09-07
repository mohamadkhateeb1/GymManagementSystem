<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SideEmployee extends Component
{
    public $navGroups;

    public function __construct()
    {
        // القيمة الافتراضية [] لحماية الكود إن كان ملف الإعداد غير موجود أو فارغ
        $this->navGroups = $this->prepareItems(config('sideEmployee', []));
    }

    protected function prepareItems($items)
    {
        // حماية: إذا لم تكن البيانات مصفوفة نرجع مصفوفة فارغة لتجنب خطأ foreach
        if (!is_array($items)) {
            return [];
        }

        // جلب المستخدم من جارد الموظف أولاً (Multi-Guard) حتى تكون الفلترة على صلاحيات الموظف
        $user = Auth::guard('employee')->user() ?? Auth::guard('admin')->user() ?? Auth::user();

        foreach ($items as $key => $item) {

            // فحص الصلاحية إن كانت مطلوبة في العنصر
            if (isset($item['ability'])) {
                // إذا لم يوجد مستخدم أو لا يملك الصلاحية، احذف العنصر وتجاوزه
                if (!$user || !$user->can($item['ability'])) {
                    unset($items[$key]);
                    continue;
                }
            }

            // فحص العناصر الفرعية (sub-menu) إن وجدت لتطبيق نفس الشروط عليها
            if (isset($item['items']) && is_array($item['items'])) {
                $items[$key]['items'] = $this->prepareItems($item['items']);
            }
        }

        return $items;
    }

    public function render()
    {
        return view('components.side-employee');
    }
}