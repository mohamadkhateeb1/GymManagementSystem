{{--
    🔄 نافذة تجديد الاشتراك الموحّدة — تُستخدم بكل صفحات الأدمن.
    تُدرَج مرّة وحدة بأسفل أي صفحة فيها زر/أزرار "تجديد"، وتُفتَح عبر:
        openRenewModal(membershipId, currentPlanTypeId)

    ⚠️ المتغيّر $planTypes يجب تمريره من الكنترولر لأي صفحة تستخدم هالنافذة.
--}}

<div id="renewSubscriptionModal" class="renew-modal">
    <div class="renew-modal-content">
        <div class="renew-modal-header">
            <h4><i class="fas fa-rotate" style="color: var(--gold);"></i> تجديد الاشتراك</h4>
            <span class="renew-close-modal" onclick="closeRenewModal()">&times;</span>
        </div>

        <form id="renewSubscriptionForm" method="POST">
            @csrf
            <div class="renew-modal-body">

                <div class="renew-field-group">
                    <label class="renew-field-label">اختر الباقة (يمكن تغيير نوع الاشتراك بالكامل)</label>
                    <select name="plan_type_id" id="renewPlanTypeSelect" class="renew-field-input" required>
                        <option value="">-- اختر الباقة --</option>
                        @forelse ($planTypes ?? [] as $planType)
                            <option value="{{ $planType->id }}">
                                {{ $planType->name }} — {{ $planType->duration_days }} يوم — {{ number_format($planType->price, 2) }}
                            </option>
                        @empty
                            <option value="" disabled>لا توجد باقات مفعّلة حالياً</option>
                        @endforelse
                    </select>
                </div>

                <p class="renew-field-hint">
                    سيبدأ الاشتراك الجديد من تاريخ اليوم، وسيُحتسب سعره حسب الباقة المختارة.
                </p>

                <button type="submit" class="renew-btn-submit">تأكيد التجديد</button>
            </div>
        </form>
    </div>
</div>

<style>
    .renew-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 20, 30, .55);
        backdrop-filter: blur(6px);
    }

    .renew-modal.open {
        display: flex;
    }

    .renew-modal-content {
        width: 100%;
        max-width: 460px;
        background: var(--surface, #fff);
        border: 1px solid var(--border, #e4e8ef);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(20, 25, 35, .25);
    }

    .renew-modal-header {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--border, #e4e8ef);
        background: var(--surface-2, #fafbfc);
    }

    .renew-modal-header h4 {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text, #202631);
        font-size: 16px;
        font-weight: 800;
    }

    .renew-close-modal {
        color: var(--text-soft, #4b5563);
        cursor: pointer;
        font-size: 22px;
        font-weight: bold;
        line-height: 1;
    }

    .renew-close-modal:hover {
        color: var(--danger, #d94b4b);
    }

    .renew-modal-body {
        padding: 22px;
    }

    .renew-field-group {
        margin-bottom: 14px;
    }

    .renew-field-label {
        display: block;
        margin-bottom: 7px;
        color: var(--text, #202631);
        font-size: 13.5px;
        font-weight: 700;
    }

    .renew-field-input {
        width: 100%;
        min-height: 44px;
        padding: 9px 12px;
        border: 1px solid var(--border, #e4e8ef);
        border-radius: 9px;
        outline: none;
        background: var(--surface-2, #fafbfc);
        color: var(--text, #202631);
        font-family: inherit;
        font-size: 13.5px;
    }

    .renew-field-input:focus {
        border-color: var(--gold, #c9a961);
        background: var(--surface, #fff);
    }

    .renew-field-hint {
        margin: -6px 0 16px;
        color: var(--text-soft, #4b5563);
        font-size: 12px;
        line-height: 1.7;
    }

    .renew-btn-submit {
        width: 100%;
        min-height: 46px;
        border: 0;
        border-radius: 10px;
        color: #fff;
        background: linear-gradient(135deg, var(--gold-light, #d7bd7b), var(--gold-dark, #8f6d2d));
        font-family: inherit;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .renew-btn-submit:hover {
        filter: brightness(1.06);
    }
</style>

<script>
    /**
     * 🔄 فتح نافذة التجديد الموحّدة.
     * @param {number} membershipId - معرّف الاشتراك (Membership) المطلوب تجديده
     * @param {number|null} currentPlanTypeId - معرّف الباقة الحالية، لتحديدها مسبقاً بالقائمة (اختياري)
     */
    function openRenewModal(membershipId, currentPlanTypeId) {
        const form = document.getElementById('renewSubscriptionForm');
        form.action = '{{ route("subscriptions.renew", ["id" => "__ID__"]) }}'.replace('__ID__', membershipId);

        const select = document.getElementById('renewPlanTypeSelect');
        if (currentPlanTypeId) {
            select.value = currentPlanTypeId;
        } else {
            select.value = '';
        }

        document.getElementById('renewSubscriptionModal').classList.add('open');
    }

    function closeRenewModal() {
        document.getElementById('renewSubscriptionModal').classList.remove('open');
    }

    window.addEventListener('click', function (event) {
        if (event.target === document.getElementById('renewSubscriptionModal')) {
            closeRenewModal();
        }
    });
</script>