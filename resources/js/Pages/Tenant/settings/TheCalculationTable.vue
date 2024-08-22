<script lang="ts" setup>
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseInputGroup from '@/Components/Base/form/InputGroup/BaseInputGroup.vue'
import BaseInputGroupText from '@/Components/Base/form/InputGroup/BaseInputGroupText.vue'
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
</script>

<template>
    <div class="intro-y box col-span-12 @container 2xl:col-span-6">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">
            <h2 class="me-auto text-xl font-bold">{{ $t('orphan_sponsorship') }}</h2>
        </div>

        <div class="col-span-12 overflow-x-auto p-5 lg:overflow-x-hidden">
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
                    <base-td-table rowspan="7"></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table></base-td-table>
                    <base-td-table rowspan="7">
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>الأرمل</base-td-table>
                    <base-td-table>
                        <base-form-input value="0.75"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="0.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>الأرملة</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="0.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>زوج الأرملة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="15000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>زوجة الأرمل</base-td-table>
                    <base-td-table>
                        <base-form-input value="0.75"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="0.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>الجد / الجدة / آخر</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="0.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>أم طفولة مسعفة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0.75"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="0.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-thead-table>
                    <base-th-table>الأولاد أقل من 18 سنة أو المتمدرسين فوق 18 سنة</base-th-table>
                    <base-th-table>المعامل خارج الموسم الدراسي</base-th-table>
                    <base-th-table>المعامل خلال الموسم الدراسي</base-th-table>
                    <base-th-table colspan="3">بدون دخل</base-th-table>
                </base-thead-table>
                <base-tr-table>
                    <base-td-table>رضيع</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>أقل من سن التمدرس</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>الإبتدائي</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1.25"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>المتوسط</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1.5"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0">
                        <!--                <base-form-input></base-form-input>-->
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>الثانوي</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1.75"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متمهن</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table class="border-0 border-e" colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>خارج من الدراسة</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
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
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table rowspan="7"></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="20"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table colspan="2" rowspan="2"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متمهنة</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="25"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>ماكثة في البيت بلا دخل</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="3000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="3000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>ماكثة في البيت بمنحة</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="30"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table colspan="2" rowspan="4"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>عاملة / موظفة عزباء</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="40"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متزوجة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="30"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>مطلقة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
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
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table rowspan="7"></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="30"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table></base-td-table>
                    <base-td-table rowspan="7"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متمهن</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="6000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>بطال</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="10000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>عامل يسكن مع العائلة</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="40"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table rowspan="2"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>عامل يسكن خارج العائلة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="30"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متزوج مع العائلة + أسرته</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="100"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="15000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>متزوج خارج العائلة</base-td-table>
                    <base-td-table>
                        <base-form-input value="0"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="10"></base-form-input>

                            <base-input-group-text> %</base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>حالات خاصة</base-td-table>
                    <base-td-table>المعامل</base-td-table>
                    <base-td-table>الدخل الحقيقي</base-td-table>
                    <base-td-table colspan="3"></base-td-table>
                </base-tr-table>
                <base-tr-table>
                    <base-td-table>معاق (ة)</base-td-table>
                    <base-td-table>
                        <base-form-input value="1"></base-form-input>
                    </base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="10000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                    <base-td-table colspan="2"></base-td-table>
                    <base-td-table>
                        <base-input-group>
                            <base-form-input type="number" value="10000.00"></base-form-input>

                            <base-input-group-text>
                                {{ $t('DA') }}
                            </base-input-group-text>
                        </base-input-group>
                    </base-td-table>
                </base-tr-table>
                <!--        <base-tr-table>-->
                <!--            <base-td-table>مجموع المعاملات</base-td-table>-->
                <!--            <base-td-table>N</base-td-table>-->
                <!--            <base-td-table>معدل الدخل = R/N</base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table>مجموع المساهمات</base-td-table>-->
                <!--            <base-td-table>R</base-td-table>-->
                <!--        </base-tr-table>-->
                <!--        <base-tr-table>-->
                <!--            <base-td-table>مجموع المعاملات</base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table>معدل الدخل =</base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table>مجموع المساهمات</base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--        </base-tr-table>-->
                <!--        <base-tr-table>-->
                <!--            <base-td-table-->
                <!--                >إذا كان المتكفل يسكن مع عائلته يضاف لمعدل الدخل مبلغ العتبة الحدية لعدم الإستفادة-->
                <!--            </base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--            <base-td-table></base-td-table>-->
                <!--        </base-tr-table>-->
            </base-table>
        </div>
    </div>
</template>
