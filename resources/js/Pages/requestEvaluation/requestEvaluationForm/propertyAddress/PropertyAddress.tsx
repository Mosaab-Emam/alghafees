import React from "react";
import { useDispatch, useSelector } from "react-redux";
import { updateFormField } from "../../../../app/slices/rateRequestFormSlice";
import RequestEvaluationFormTextArea from "../RequestEvaluationFormTextArea";

const PropertyAddress = () => {
  const dispatch = useDispatch();
  const formData = useSelector((state) => state.rateRequestForm);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    dispatch(updateFormField({ field: name, value }));
  };

  return (
    <section className="w-full h-[661px] flex flex-col items-start gap-8">
      <RequestEvaluationFormTextArea
        name="location"
        label="عنوان العقار"
        placeholder="ادخل عنوان العقار محل التقييم كالتالي ( منطقه - الحي - المدينه ) "
        value={formData.location}
        onChange={handleInputChange}
      />
    </section>
  );
};

export default PropertyAddress;
