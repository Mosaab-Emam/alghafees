import React from "react";
import { useDispatch, useSelector } from "react-redux";
import { updateFormField } from "../../../../app/slices/rateRequestFormSlice";
import {
  useGetEntitiesQuery,
  useGetTypesQuery,
  useGetUsagesQuery,
} from "../../../../query";
import RequestEvaluationFormInput from "../RequestEvaluationFormInput";
import RequestEvaluationFormSelectInput from "../RequestEvaluationFormSelectInput";
import RequestEvaluationFormTextArea from "../RequestEvaluationFormTextArea";

const PropertyDataForm = () => {
  const dispatch = useDispatch();
  const formData = useSelector((state) => state.rateRequestForm);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    dispatch(updateFormField({ field: name, value }));
  };

  return (
    <section className="w-full h-full flex flex-col items-start gap-8">
      <RequestEvaluationFormSelectInput
        name="type_id"
        label="نوع العقار محل التقييم"
        placeholder="اختر نوع العقار "
        query={useGetTypesQuery}
        value={formData.type_id}
        onChange={handleInputChange}
      />

      <RequestEvaluationFormTextArea
        name="real_estate_details"
        label="تفاصيل العقار"
        value={formData.real_estate_details}
        onChange={handleInputChange}
        placeholder="ادخل تفاصيل العقار هنا"
      />

      <RequestEvaluationFormSelectInput
        name={"entity_id"}
        label="الجهه الموجه اليها التقييم"
        placeholder="اختر الجهه"
        query={useGetEntitiesQuery}
        value={formData.entity_id}
        onChange={handleInputChange}
      />

      <div className="w-full flex md:flex-row flex-col  items-center self-stretch gap-[20px] ">
        <RequestEvaluationFormInput
          type="number"
          label="العمر"
          name="real_estate_age"
          placeholder="ادخل العمر بعدد السنوات هنا"
          value={formData.real_estate_age}
          onChange={handleInputChange}
        />
        <RequestEvaluationFormInput
          type="number"
          name="real_estate_area"
          label="المساحة"
          placeholder="ادخل المساحة بوحدة م2"
          value={formData.real_estate_area}
          onChange={handleInputChange}
        />
      </div>

      <RequestEvaluationFormSelectInput
        name={"usage_id"}
        label="استعمال العقار"
        placeholder="اختر نوع الاستعمال"
        query={useGetUsagesQuery}
        value={formData.usage_id}
        onChange={handleInputChange}
      />
    </section>
  );
};

export default PropertyDataForm;
