<?php

namespace App\Console\Commands;

use App\Models\DietPlan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * 📦 نقل صور الوجبات القديمة من public/uploads/meals إلى قرص storage العام،
 * وتحديث المسارات في قاعدة البيانات حتى لا تنكسر صور الوجبات الموجودة.
 *
 * يُشغَّل مرة واحدة فقط بعد تعديل طريقة الرفع.
 *
 * معاينة:  php artisan meals:migrate-images --dry-run
 * تنفيذ:   php artisan meals:migrate-images
 */
class MigrateMealImages extends Command
{
    protected $signature = 'meals:migrate-images {--dry-run : عرض ما سيحدث دون تنفيذ}';

    protected $description = 'نقل صور الوجبات من public/uploads إلى storage وتحديث مساراتها';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        // الوجبات التي لا يزال مسارها يشير إلى المجلد القديم
        $plans = DietPlan::where('image_path', 'like', 'uploads/meals/%')->get();

        if ($plans->isEmpty()) {
            $this->info('✅ لا توجد صور بحاجة إلى نقل.');
            return self::SUCCESS;
        }

        $this->info("عدد السجلات المتأثرة: {$plans->count()}");
        $this->newLine();

        $moved   = 0;
        $missing = 0;
        $rows    = [];

        // خريطة المسار القديم -> المسار الجديد، حتى تُنقل الصورة المشتركة مرة واحدة
        $map = [];

        foreach ($plans as $plan) {
            $oldPath = $plan->image_path;
            $source  = public_path($oldPath);

            // إن سبق نقل هذه الصورة (نُسخ متعددة تتشارك نفس الملف) نستخدم المسار الجديد مباشرة
            if (isset($map[$oldPath])) {
                if (!$dryRun) {
                    $plan->update(['image_path' => $map[$oldPath]]);
                }
                $rows[] = [$plan->id, $plan->meal_name, 'مرتبطة بصورة منقولة مسبقاً'];
                continue;
            }

            if (!file_exists($source)) {
                $rows[] = [$plan->id, $plan->meal_name, '⚠️ الملف الأصلي مفقود'];
                $missing++;
                continue;
            }

            $newPath = 'meals/' . basename($oldPath);

            if (!$dryRun) {
                Storage::disk('public')->put($newPath, file_get_contents($source));
                $plan->update(['image_path' => $newPath]);
            }

            $map[$oldPath] = $newPath;
            $rows[] = [$plan->id, $plan->meal_name, $dryRun ? "سيُنقل إلى {$newPath}" : "✅ نُقل إلى {$newPath}"];
            $moved++;
        }

        $this->table(['ID', 'الوجبة', 'الحالة'], $rows);

        if ($dryRun) {
            $this->warn('🔍 وضع المعاينة — لم يتم تعديل أي شيء.');
            return self::SUCCESS;
        }

        $this->newLine();
        $this->info("✅ تم نقل {$moved} صورة وتحديث مساراتها.");

        if ($missing > 0) {
            $this->warn("⚠️ {$missing} سجل يشير إلى ملف غير موجود، تم تجاهله.");
        }

        $this->newLine();
        $this->line('يمكنك الآن حذف المجلد القديم يدوياً بعد التأكد من ظهور الصور:');
        $this->line('   public/uploads/meals');

        return self::SUCCESS;
    }
}