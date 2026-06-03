<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Side extends Component
{
    public $navGroups;

    public function __construct()
    {
        // تم إضافة [] كقيمة افتراضية لحماية الكود في حال كان ملف side غير موجود أو فارغ
        $this->navGroups = $this->prepareItems(config('side', []));
    }

    protected function prepareItems($items)
    {
        // حماية: إذا كانت البيانات القادمة ليست مصفوفة، نرجع مصفوفة فارغة لتجنب خطأ foreach
        if (!is_array($items)) {
            return [];
        }

        // جلب المستخدم الحالي من الجارد الصحيح (لأنك تستخدم Multi-Guard)
        $user = Auth::guard('admin')->user() ?? Auth::guard('employee')->user() ?? Auth::user();

        foreach ($items as $key => $item) {
            
            // فحص الصلاحية إذا كانت مطلوبة في العنصر
            if (isset($item['ability'])) {
                // إذا لم يوجد مستخدم أو لا يملك الصلاحية، احذف العنصر وتجاوزه
                if (!$user || !$user->can($item['ability'])) {
                    unset($items[$key]);
                    continue; 
                }
            }
            
            // فحص العناصر الفرعية (sub-menu) إذا كانت موجودة داخل العنصر لتطبيق نفس الشروط عليها
            if (isset($item['items']) && is_array($item['items'])) {
                $items[$key]['items'] = $this->prepareItems($item['items']);
            }
        }
        
        return $items;
    }

    public function render()
    {
        return view('components.side');
    }
}