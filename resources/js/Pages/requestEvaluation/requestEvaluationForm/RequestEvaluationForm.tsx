import React from "react";

import RequestEvaluationFormButtonsBox from "./RequestEvaluationFormButtonsBox";
import PropertyAddress from "./propertyAddress/PropertyAddress";
import PropertyDataForm from "./propertyDataForm/PropertyDataForm";
import PropertyDocuments from "./propertyDocuments/PropertyDocuments";
import RequestSubmittedSuccessfully from "./requestSubmittedSuccessfully/RequestSubmittedSuccessfully";
import UserInfoForm from "./userInfoForm/UserInfoForm";

const RequestEvaluationForm = ({
  step,
  onHandleNextStep,
  onHandlePrevStep,
}) => {
  return (
    <form className="md:w-[590px] w-full flex flex-col items-start gap-8">
      {step === 1 && <UserInfoForm />}
      {step === 2 && <PropertyDataForm />}
      {step === 3 && <PropertyAddress />}
      {step === 4 && <PropertyDocuments />}
      {step === 5 && <RequestSubmittedSuccessfully />}

      {step !== 5 && (
        <RequestEvaluationFormButtonsBox
          step={step}
          onHandleNextStep={onHandleNextStep}
          onHandlePrevStep={onHandlePrevStep}
        />
      )}
    </form>
  );
};

export default RequestEvaluationForm;
