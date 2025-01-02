import { useDispatch, useSelector } from "react-redux";
import { updateFormField } from "../../../../app/slices/rateRequestFormSlice";
import { SelectItem } from "../../../../types";
import RequestEvaluationFormInput from "../RequestEvaluationFormInput";
import RequestEvaluationFormSelectInput from "../RequestEvaluationFormSelectInput";
import RequestEvaluationFormTextArea from "../RequestEvaluationFormTextArea";

export default function UserInfoForm({ goals }: { goals: Array<SelectItem> }) {
    const dispatch = useDispatch();
    const formData = useSelector((state) => state.rateRequestForm);

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        dispatch(updateFormField({ field: name, value }));
    };

    return (
        <section className="w-full h-full flex flex-col items-start gap-8">
            <RequestEvaluationFormInput
                type="text"
                label="الاسم بالكامل"
                name="name"
                value={formData.name}
                onChange={handleInputChange}
                placeholder="ادخل اسمك بالكامل هنا"
            />

            <div className="w-full md:flex-row flex-col flex items-center self-stretch gap-[20px]">
                <RequestEvaluationFormInput
                    type="tel"
                    label="رقم الجوال"
                    name="mobile"
                    value={formData.mobile}
                    onChange={handleInputChange}
                    placeholder="ادخل رقم جوالك يبدأ ب 05 هنا"
                />

                <RequestEvaluationFormInput
                    type="email"
                    label="البريد الالكتروني"
                    name="email"
                    value={formData.email}
                    onChange={handleInputChange}
                    placeholder="ادخل بريدك الالكتروني هنا"
                />
            </div>

            <RequestEvaluationFormInput
                type="text"
                label="عنوان طالب التقييم"
                name="address"
                value={formData.address}
                onChange={handleInputChange}
                placeholder="ادخل عنوانك الحالي هنا"
            />

            <RequestEvaluationFormSelectInput
                name="goal_id"
                label="الغرض من التقييم"
                value={formData.goal_id}
                onChange={handleInputChange}
                placeholder="اختر الغرض من التقييم"
                data={goals}
            />

            <RequestEvaluationFormTextArea
                name="notes"
                label="تفاصيل الغرض من التقييم"
                value={formData.notes}
                onChange={handleInputChange}
                placeholder="ادخل تفاصيل الغرض من التقييم الذي تريده"
            />
        </section>
    );
}
