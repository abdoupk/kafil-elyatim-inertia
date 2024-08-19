<script lang="ts" setup>
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
</script>

<template>
    <div class="box p-5">
        <base-table bordered>
            <base-thead-table>
                <base-th-table>أفراد الأسرة</base-th-table>
                <base-th-table>المعامل</base-th-table>
                <base-th-table>الدخل الحقيقي للأجير و لمن يتقاضى منحة</base-th-table>
                <base-th-table>نسبة المساهمة في الدخل العائلي</base-th-table>
                <base-th-table>المساهمة الإفتراضية في الدخل إن كان بطال</base-th-table>
                <base-th-table>مساهمة الدخل</base-th-table>
            </base-thead-table>
            <base-tr-table>
                <base-td-table>المتكفل الرئيسي</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الأرمل</base-td-table>
                <base-td-table>0.75</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>0.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الأرملة</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>0.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>زوج الأرملة</base-td-table>
                <base-td-table>0</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>15000.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>زوجة الأرمل</base-td-table>
                <base-td-table>0.75</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>0.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الجد / الجدة / آخر</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>0.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>أم طفولة مسعفة</base-td-table>
                <base-td-table>0.75</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>0.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-thead-table>
                <base-th-table>الأولاد أقل من 18 سنة أو المتمدرسين فوق 18 سنة</base-th-table>
                <base-th-table>المعامل خارج الموسم الدراسي</base-th-table>
                <base-th-table>المعامل خلال الموسم الدراسي</base-th-table>
                <base-th-table colspan="3">بدون دخل</base-th-table>
            </base-thead-table>
            <base-tr-table>
                <base-td-table>رضيع</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>أقل من سن التمدرس</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الإبتدائي</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1.25</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>المتوسط</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1.5</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الثانوي</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1.75</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متمهن</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>خارج من الدراسة</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الإناث فوق 18 سنة</base-td-table>
                <base-td-table>المعامل</base-td-table>
                <base-td-table>الدخل الحقيقي منحة +تقاعد+راتب</base-td-table>
                <base-td-table>نسبة المساهمة في الدخـــــل</base-td-table>
                <base-td-table>المساهمة الإفتراضية للبطالة</base-td-table>
                <base-td-table>المساهمة في الدخل</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>جامعية</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>20%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متمهنة</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>25%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>ماكثة في البيت بلا دخل</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>3000.00</base-td-table>
                <base-td-table>3000</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>ماكثة في البيت بمنحة</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>30%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>عاملة / موظفة عزباء</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>40%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متزوجة</base-td-table>
                <base-td-table>0</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>30%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>مطلقة</base-td-table>
                <base-td-table>0</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>الذكور فوق 18 سنة</base-td-table>
                <base-td-table>المعامل</base-td-table>
                <base-td-table>الدخل الحقيقي منحة +راتب</base-td-table>
                <base-td-table>نسبة المساهمة في الدخـــــل</base-td-table>
                <base-td-table>المساهمة الإفتراضية للبطال</base-td-table>
                <base-td-table>المساهمة في الدخل</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>جامعي</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>30%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متمهن</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>6000.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>بطال</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>10000.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>عامل يسكن مع العائلة</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>40%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>عامل يسكن خارج العائلة</base-td-table>
                <base-td-table>0</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>30%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متزوج مع العائلة + أسرته</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>100%</base-td-table>
                <base-td-table>15000.00</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>متزوج خارج العائلة</base-td-table>
                <base-td-table>0</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>10%</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>حالات خاصة</base-td-table>
                <base-td-table>المعامل</base-td-table>
                <base-td-table>الدخل الحقيقي</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>معاق (ة)</base-td-table>
                <base-td-table>1</base-td-table>
                <base-td-table>10000.00</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>10000.00</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>مجموع المعاملات</base-td-table>
                <base-td-table>N</base-td-table>
                <base-td-table>معدل الدخل = R/N</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>مجموع المساهمات</base-td-table>
                <base-td-table>R</base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table>مجموع المعاملات</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>معدل الدخل =</base-td-table>
                <base-td-table></base-td-table>
                <base-td-table>مجموع المساهمات</base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
            <base-tr-table>
                <base-td-table
                    >إذا كان المتكفل يسكن مع عائلته يضاف لمعدل الدخل مبلغ العتبة الحدية لعدم الإستفادة
                </base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
                <base-td-table></base-td-table>
            </base-tr-table>
        </base-table>
    </div>
</template>
